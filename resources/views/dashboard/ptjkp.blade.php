<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Pembantu Tadbir Jabatan Khidmat Pengurusan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 space-y-6">

            {{-- Ringkasan Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-dashboard-card title="Jumlah Tuntutan" color="indigo" :value="$jumlahTuntutan" prefix="RM" />
                <x-dashboard-card title="Tuntutan Baharu" color="blue" :value="$tuntutanBaharu" />
                <x-dashboard-card title="Tuntutan Disemak" color="green" :value="$tuntutanDisemak" />
                <x-dashboard-card title="Tuntutan Tidak Lengkap" color="red" :value="$tuntutanTLengkap" />
                <x-dashboard-card title="Tuntutan Diluluskan" color="green" :value="$tuntutanDiluluskan" />
                <x-dashboard-card title="Report" color="green">
    <x-slot name="actions">
        <a href="{{ route('kjbt.show') }}"
           class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Lihat
        </a>
    </x-slot>
</x-dashboard-card>
            </div>

            {{-- Senarai Tuntutan --}}
            {{-- Senarai yang perlu disemak --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Senarai Keseluruhan Tuntutan : {{ auth()->user()->deptId }}</h3>
                    <form method="GET" action="{{ route('ptjkp.dashboard') }}" class="flex gap-2">
        <input type="text" name="search" placeholder="Cari nama staff atau jabatan" 
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
                                <th class="p-2">No siri</th>
                                <th class="p-2">Nama Staff</th>
                                <th class="p-2">Nama Klinik</th>
                                <th class="p-2">No Resit</th>
                                <th class="p-2">Jumlah Resit</th>
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
                                    <td class="p-2">
                                {{ \Carbon\Carbon::parse($claim->tarikh_resit)->translatedFormat('F Y') }}
                            </td>
                                    <td class="p-2">{{ $claim->staff->staff_no ?? 'No siri tiada' }}</td>
                                    <td class="p-2">{{ $claim->staff->staff_nama ?? 'Tiada Nama' }}</td>
                                    <td class="p-2">{{ $claim->nama_klinik }}</td>
                                    <td class="p-2">{{ $claim->no_resit }}</td>
                                    <td class="p-2">RM {{ number_format($claim->jumlah_resit, 2) }}</td>
                                    <td class="p-2">{{ number_format($claim->staff->staff_kelayakan - $claim->jumlah_resit, 2) }}</td>
                                    <td class="p-2">
                                    @php
                                    $warna = match($claim->status) {
                                    'BAHARU' => 'bg-yellow-100 text-green-800',
                                    'DISEMAK PTJKP' => 'bg-blue-100 text-blue-800',
                                    'DISAHKAN KETUA PTJKP' => 'bg-green-100 text-green-800',
                                    'TIDAK LENGKAP' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                    };
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $warna }}">
                                    {{ $claim->status }}
                                </span>
                            </td>
                            <td class="p-2 flex items-center space-x-2">
                                 @if(!$claim->semak_ptjkp)
    <form action="{{ route('ptjkp.tuntutan.semak', $claim->id) }}" method="POST" onsubmit="return confirm('Anda pasti tuntutan sudah disemak dan semua maklumat sudah lengkap?')">
        @csrf
        <button type="submit" class="px-3 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">
            Disemak
        </button>
    </form>
    @endif
    <form action="{{ route('ptjkp.tuntutan.tidakLengkap', $claim->id) }}" method="POST" onsubmit="return confirm('Anda pasti untuk menolak tuntutan yang tidak lengkap?')">
        @csrf
        <button type="submit" class="px-3 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600">
            Tidak Lengkap
        </button>
    </form>
    {{-- -button view --}}
    <a href="{{ route('ptjkp.show', $claim->id) }}" class="px-3 py-1 text-xs bg-gray-500 text-white rounded hover:bg-gray-600">
    <i data-lucide="file-text" class="w-5 h-5 text-blue-600"></i>

</a>
</td>
</tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-4 text-center text-gray-500 dark:text-gray-400">Tiada tuntutan yang perlu disemak.</td>
                                </tr>
                            @endforelse


                            <script type="module">
    import { createIcons, icons } from 'https://unpkg.com/lucide@latest?module';
    createIcons({ icons });
</script>

                        </tbody>
                    </table>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
