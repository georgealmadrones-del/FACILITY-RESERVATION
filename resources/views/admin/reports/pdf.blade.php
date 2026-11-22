<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation Activity Report</title>
    <style>
        @page {
            margin: 24px 28px;
        }
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            color: #1f2937;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 18px;
            border-bottom: 1px solid #d1d5db;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0 0 4px 0;
            font-size: 16px;
            color: #0f0e47;
        }
        .header .subtitle {
            font-size: 11px;
            color: #4b5563;
            margin: 0 0 2px 0;
        }
        .header .meta {
            font-size: 9px;
            color: #6b7280;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        th {
            background-color: #f3f4f6;
            color: #111827;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: left;
            padding: 7px 6px;
            border: 1px solid #d1d5db;
        }
        td {
            padding: 6px;
            border: 1px solid #e5e7eb;
            vertical-align: top;
            font-size: 9px;
            word-wrap: break-word;
        }
        .sub {
            display: block;
            font-size: 8px;
            color: #4b5563;
            margin-top: 2px;
        }
        .status {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8.5px;
        }
        .status-approved, .status-returned {
            color: #047857;
        }
        .status-pending {
            color: #b45309;
        }
        .status-rejected, .status-cancelled {
            color: #be123c;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>School Facility &amp; Equipment Reservation Management System</h1>
        <p class="subtitle">Official System Activity &amp; Reservation Report</p>
        <p class="meta">Generated on: {{ now()->format('M d, Y h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 18%;">Requester</th>
                <th style="width: 28%;">Resource Item</th>
                <th style="width: 16%;">Start Time</th>
                <th style="width: 16%;">End Time</th>
                <th style="width: 22%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations ?? [] as $r)
                @php
                    $requesterName = $r->user->name
                        ?? $r->requester_name
                        ?? $r->user_name
                        ?? 'Unknown User';

                    $requesterRole = $r->user->role
                        ?? $r->requester_role
                        ?? null;

                    $resourceName = $r->resource_name
                        ?? $r->item_name
                        ?? $r->facility_name
                        ?? $r->equipment_name
                        ?? $r->name
                        ?? data_get($r, 'facility.name')
                        ?? data_get($r, 'equipment.name')
                        ?? data_get($r, 'resource.name');

                    $resourceType = $r->resource_type
                        ?? $r->item_type
                        ?? $r->type
                        ?? (data_get($r, 'facility') ? 'Facility' : (data_get($r, 'equipment') ? 'Equipment' : null));

                    $qty = $r->quantity
                        ?? $r->qty
                        ?? $r->expected_attendees
                        ?? $r->count
                        ?? null;

                    $statusRaw = strtolower((string) ($r->status ?? 'pending'));
                    $statusClass = match ($statusRaw) {
                        'approved', 'returned' => 'status-' . $statusRaw,
                        'pending' => 'status-pending',
                        'rejected', 'cancelled' => 'status-rejected',
                        default => '',
                    };
                @endphp
                <tr>
                    <td>
                        <strong>{{ $requesterName }}</strong>
                        @if(!empty($requesterRole))
                            <span class="sub">{{ ucfirst($requesterRole) }}</span>
                        @endif
                    </td>
                    <td>
                        @if(!empty($resourceName))
                            <strong>{{ $resourceName }}</strong>
                        @else
                            <strong>Booked Resource</strong>
                        @endif

                        @if(!empty($resourceType) || !empty($qty))
                            <span class="sub">
                                @if(!empty($resourceType)){{ ucfirst($resourceType) }}@endif
                                @if(!empty($resourceType) && !empty($qty)) &bull; @endif
                                @if(!empty($qty))Qty: {{ $qty }}@endif
                            </span>
                        @endif

                        @if(!empty($r->purpose))
                            <span class="sub">Purpose: {{ $r->purpose }}</span>
                        @endif
                    </td>
                    <td>{{ $r->start_time }}</td>
                    <td>{{ $r->end_time }}</td>
                    <td>
                        <span class="status {{ $statusClass }}">{{ strtoupper($r->status ?? 'PENDING') }}</span>
                        @if(!empty($r->rejection_reason))
                            <span class="sub">Note: {{ $r->rejection_reason }}</span>
                        @elseif(!empty($r->admin_notes))
                            <span class="sub">Note: {{ $r->admin_notes }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 14px;">No reservation records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>