<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-extrabold text-pink-950 tracking-tight">
                    My Reservations 💕
                </h2>
                <p class="text-xs text-pink-700/80 mt-0.5 font-medium">Track, monitor, or cancel your active booking requests.</p>
            </div>
            <a href="{{ route('reservations.create') }}" class="px-4 py-2.5 bg-gradient-to-r from-pink-400 via-rose-400 to-purple-400 hover:from-pink-500 hover:to-purple-500 text-white rounded-2xl text-xs font-bold transition shadow-md shadow-pink-300/40 flex items-center space-x-1.5">
                <span>+ New Booking</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-pink-100/60 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Success/Error Message Flash -->
            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-100 border border-emerald-200 text-emerald-900 text-xs font-bold shadow-sm">
                    ✨ {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="p-4 rounded-2xl bg-rose-100 border border-rose-200 text-rose-900 text-xs font-bold shadow-sm">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <!-- Reservations Card Container -->
            <div class="bg-white/90 p-6 sm:p-8 rounded-3xl border border-pink-200 shadow-xl shadow-pink-500/5 backdrop-blur-xl space-y-6">
                <div class="flex justify-between items-center pb-4 border-b border-pink-100">
                    <div class="flex items-center space-x-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-pink-500 animate-pulse"></span>
                        <h3 class="font-extrabold text-base text-pink-950">All Your Booking Requests</h3>
                    </div>
                </div>

                @if(isset($reservations) && $reservations->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-pink-100 text-[11px] font-bold uppercase tracking-wider text-pink-900/70">
                                    <th class="py-3 px-4">Resource</th>
                                    <th class="py-3 px-4">Type</th>
                                    <th class="py-3 px-4">Schedule</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-pink-50 text-sm">
                                @foreach($reservations as $res)
                                    @php
                                        $itemTitle = $res->facility?->name ?? $res->equipment?->name ?? 'Resource Item';
                                        $scheduleFormatted = \Carbon\Carbon::parse($res->start_time)->format('M d, Y g:i A') . ' → ' . \Carbon\Carbon::parse($res->end_time)->format('g:i A');
                                    @endphp
                                    <tr class="hover:bg-pink-50/40 transition">
                                        <td class="py-4 px-4 font-bold text-pink-950">{{ $itemTitle }}</td>
                                        <td class="py-4 px-4">
                                            @if($res->facility_id)
                                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-pink-100 text-pink-700">Facility</span>
                                            @else
                                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-purple-100 text-purple-700">Equipment</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 text-xs text-pink-900/80 font-medium">{{ $scheduleFormatted }}</td>
                                        <td class="py-4 px-4">
                                            <span class="px-3 py-1 text-[11px] font-bold rounded-full border uppercase tracking-wider
                                                {{ $res->status === 'approved' ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : '' }}
                                                {{ $res->status === 'pending' ? 'bg-amber-100 text-amber-800 border-amber-200' : '' }}
                                                {{ $res->status === 'rejected' ? 'bg-rose-100 text-rose-800 border-rose-200' : '' }}
                                                {{ $res->status === 'cancelled' ? 'bg-stone-100 text-stone-700 border-stone-200' : '' }}">
                                                {{ ucfirst($res->status) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            @if(in_array($res->status, ['pending', 'approved']))
                                                <form action="{{ route('reservations.status', $res->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-xl text-xs font-bold border border-rose-200 transition">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-pink-400 font-medium italic">No action</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-12 text-center space-y-2">
                        <div class="w-12 h-12 mx-auto rounded-full bg-pink-100 flex items-center justify-center text-pink-500 font-bold">🌸</div>
                        <p class="text-sm font-bold text-pink-950">No reservations found.</p>
                        <p class="text-xs text-pink-700/70">You haven't submitted any bookings yet. Get started by creating a new one!</p>
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>