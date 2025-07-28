<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Senarai Tuntutan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Senarai Tuntutan</h2>
    <table>
        <thead>
            <tr>
                <th>Bil</th>
                <th>NO Siri</th>
                <th>Nama Staff</th>
                <th>Bulan</th>
                <th>Status</th>
                <th>Tarikh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($claims as $index => $claim)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="p-2">{{ $claim->staff->staff_no ?? 'No Siri Tiada' }}</td>
                    <td class="p-2">{{ $claim->staff->staff_nama ?? 'Tiada Nama' }}</td>
                    <td class="p-2">
                                {{ \Carbon\Carbon::parse($claim->tarikh_resit)->translatedFormat('F Y') }}
                    </td>
                    <td>{{ $claim->status }}</td>
                    <td>{{ $claim->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
