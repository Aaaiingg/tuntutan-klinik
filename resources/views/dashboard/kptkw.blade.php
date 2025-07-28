<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard ketua Pembantu Tadbir Kewangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 space-y-6">

            {{-- Ringkasan Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-dashboard-card title="Jumlah Tuntutan" color="indigo" :value="$jumlahTuntutan" prefix="RM" />
                <x-dashboard-card title="Tuntutan Baharu" color="blue" :value="$tuntutanBaharu" />
                <x-dashboard-card title="Tuntutan Disemak" color="green" :value="$tuntutanDisemak" />
                <x-dashboard-card title="Tuntutan Diluluskan" color="green" :value="$tuntutanDilulus" />
            </div>

            {{-- Senarai yang perlu diluluskan --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Senarai Keseluruhan Tuntutan : {{ auth()->user()->deptId }}</h3>
                    <form method="GET" action="{{ route('kptkw.dashboard') }}" class="flex gap-2">
        <input type="text" name="search" placeholder="Cari nama staff, jabatan atau bulan" 
               value="{{ request('search') }}"
               class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white" />
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Cari</button>
    </form>
                </div>

                <div class="table-responsive overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-left text-gray-600 dark:text-gray-200">
                                <th class="p-2">ID</th>
                                <th class="p-2">Jabatan</th>
                                <th class="p-2">Bulan</th>
                                <th class="p-2">Nama Staff</th>
                                <th class="p-2">Nama Klinik</th>
                                <th class="p-2">No Resit</th>
                                <th class="p-2">Jumlah semasa</th>
                                <th class="p-2">Jumlah diambil</th>
                                <th class="p-2">Baki</th>
                                <th class="p-2">Status</th>
                                <th class="p-2">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600 text-gray-800 dark:text-white">
                            @forelse ($claimsToProcess as $claim)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <td class="p-2">{{ $loop->iteration }}</td>
                                    <td class="p-2">{{ $claim->user->department->name ?? 'tiada Jabatan' }}</td>
                                    <td class="p-2">{{ $claim->bulan }}</td>
                                    <td class="p-2">{{ $claim->nama_staff }}</td>
                                    <td class="p-2">{{ $claim->nama_klinik }}</td>
                                    <td class="p-2">{{ $claim->no_resit }}</td>
                                    <td class="p-2">{{ $claim->jumlah_semasa }}</td>
                                    <td class="p-2">{{ $claim->jumlah_diambil }}</td>
                                    <td class="p-2">{{ $claim->baki }}</td>
                                    <td class="p-2">
                                    @php
                                    $warna = match($claim->status) {
                                    'BAHARU' => 'bg-yellow-100 text-green-800',
                                    'DISEMAK' => 'bg-blue-100 text-blue-800',
                                    'DILULUSKAN' => 'bg-green-100 text-green-800',
                                    'TIDAK LENGKAP' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                    };
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $warna }}">
                                    {{ $claim->status }}
                                </span>
                            </td>
                            <td class="p-2 flex items-center space-x-2">
    <form action="{{ route('kptkw.tuntutan.lulus', $claim->id) }}" method="POST" onsubmit="return confirm('Anda pasti ingin meluluskan tuntutan ini?')">
        @csrf
        <button type="submit" class="px-3 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">
            Diluluskan
        </button>
    </form>
    <form action="{{ route('kptkw.tuntutan.tidakLengkap', $claim->id) }}" method="POST" onsubmit="return confirm('Anda pasti ingin menolak tuntutan ini?')">
        @csrf
        <button type="submit" class="px-3 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600">
            Ditolak
        </button>
    </form>
</td>

                                
                            
                        </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-4 text-center text-gray-500 dark:text-gray-400">Tiada tuntutan untuk diluluskan.</td>
                                </tr>
                            @endforelse

                            {{-- -senarai yang telah diluluskan --}}
                            <div class="table-responsive overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-left text-gray-600 dark:text-gray-200">
                                <th class="p-2">ID</th>
                                <th class="p-2">Jabatan</th>
                                <th class="p-2">Bulan</th>
                                <th class="p-2">Nama Staff</th>
                                <th class="p-2">Nama Klinik</th>
                                <th class="p-2">No Resit</th>
                                <th class="p-2">Jumlah semasa</th>
                                <th class="p-2">Jumlah diambil</th>
                                <th class="p-2">Baki</th>
                                <th class="p-2">Status</th>
                                <th class="p-2">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600 text-gray-800 dark:text-white">
                            @forelse ($claimsApproved as $claim)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <td class="p-2">{{ $loop->iteration }}</td>
                                    <td class="p-2">{{ $claim->user->department->name ?? 'tiada Jabatan' }}</td>
                                    <td class="p-2">{{ $claim->bulan }}</td>
                                    <td class="p-2">{{ $claim->nama_staff }}</td>
                                    <td class="p-2">{{ $claim->nama_klinik }}</td>
                                    <td class="p-2">{{ $claim->no_resit }}</td>
                                    <td class="p-2">{{ $claim->jumlah_semasa }}</td>
                                    <td class="p-2">{{ $claim->jumlah_diambil }}</td>
                                    <td class="p-2">{{ $claim->baki }}</td>
                                    <td class="p-2">
                                    @php
                                    $warna = match($claim->status) {
                                    'BAHARU' => 'bg-yellow-100 text-green-800',
                                    'DISEMAK' => 'bg-blue-100 text-blue-800',
                                    'DILULUSKAN' => 'bg-green-100 text-green-800',
                                    'TIDAK LENGKAP' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                    };
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $warna }}">
                                    {{ $claim->status }}
                                </span>
                            </td>
                        </td>
                    </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-4 text-center text-gray-500 dark:text-gray-400">Tiada tuntutan diluluskan.</td>
                                </tr>
                            @endforelse

                            <script type="module">
    import { createIcons, icons } from 'https://unpkg.com/lucide@latest?module';
    createIcons({ icons });
</script>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
