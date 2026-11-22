<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $isAdmin = strtolower($user->role ?? '') === 'admin';

        // Admins pick a user thread via ?user_id=; regular users only load their own thread
        $threadUserId = $isAdmin ? $request->query('user_id') : $user->id;

        if (!$threadUserId) {
            return response()->json([]);
        }

        return Message::with('sender:id,name,role')
            ->where('user_id', $threadUserId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $isAdmin = strtolower($user->role ?? '') === 'admin';

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'user_id' => $isAdmin ? 'required|exists:users,id' : 'nullable',
        ]);

        $msg = Message::create([
            'user_id' => $isAdmin ? $validated['user_id'] : $user->id,
            'sender_id' => $user->id,
            'message' => $validated['message'],
            'is_system' => false,
        ]);

        return response()->json($msg->load('sender:id,name,role'));
    }

    public function threads()
    {
        $user = auth()->user();
        if (strtolower($user->role ?? '') !== 'admin') {
            abort(403);
        }

        $users = User::where(function ($q) {
            $q->whereNull('role')->orWhereRaw('LOWER(role) != ?', ['admin']);
        })->orderBy('name')->get(['id', 'name', 'email']);

        $latestByUser = Message::orderByDesc('created_at')
            ->get()
            ->unique('user_id')
            ->keyBy('user_id');

        return response()->json($users->map(function ($u) use ($latestByUser) {
            $last = $latestByUser->get($u->id);
            return [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'last_message' => $last?->message,
                'last_is_system' => (bool) ($last?->is_system ?? false),
                'last_time' => $last?->created_at?->diffForHumans(),
            ];
        }));
    }
}