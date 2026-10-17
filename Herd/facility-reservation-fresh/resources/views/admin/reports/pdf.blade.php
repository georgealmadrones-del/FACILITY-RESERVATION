<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reservation Activity Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #111; }
        .header p { margin: 4px 0; color: #666; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f8f9fa; font-size: 11px; text-transform: uppercase; }
        .badge { padding: 3px 6px; font-size: 10px; font-weight: bold; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>School Facility & Equipment Reservation Management System</h2>
        <p>Official System Activity & Reservation Report</p>
        <p>Generated on: {{ now()->format('M d, Y h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Requester</th>
                <th>Resource Item</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $res)
                <tr>
                    <td>{{ $res->user->name ?? 'N/A' }}</td>
                    <td>
                        {{ $res->facility->name ?? $res->equipment->name ?? 'N/A' }}
                        @if($res->quantity > 1) (Qty: {{ $res->quantity }}) @endif
                    </td>
                    <td>{{ $res->start_time }}</td>
                    <td>{{ $res->end_time }}</td>
                    <td>{{ ucfirst($res->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #777;">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>