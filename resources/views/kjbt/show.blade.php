<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rekod dan Status Tuntutan') }}
        </h2>
    </x-slot>

    {{-- Senarai Tuntutan --}}
    <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 mt-6">
        <div class="flex justify-between items-center mb-6 border-b pb-3 border-gray-300 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                Senarai Tuntutan Jabatan: {{ auth()->check() ? auth()->user()->deptId : 'Tidak Diketahui' }}
            </h3>
            <form method="GET" action="{{ route('kjbt.dashboard') }}" class="flex gap-2">
        <input type="text" name="search" placeholder="Cari nama staff, jabatan atau bulan" 
               value="{{ request('search') }}"
               class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white" />
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Cari</button>
    </form>

    {{-- Butang Muat Turun PDF --}}
        <a href="{{ route('kjbt.export.pdf') }}" 
           class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
            Muat Turun PDF
        </a>
    </div>

        

        <div class="table-responsive overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-left text-gray-600 dark:text-gray-200">
                        <th class="p-2">ID</th>
                        <th class="p-2">No Siri</th>
                        <th class="p-2">Nama Staff</th>
                        <th class="p-2">Kelayakan</th>
                        <th class="p-2">Jumlah Tuntutan</th>
                        <th class="p-2">Bulan</th>
                        <th class="p-2">Baki</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600 text-gray-800 dark:text-white">
                    @forelse ($claims as $claim)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <td class="p-2">{{ $loop->iteration }}</td>
                            <td class="p-2">{{ $claim->staff->staff_no ?? 'No Siri Tiada' }}</td>
                            <td class="p-2">{{ $claim->staff->staff_nama ?? 'Tiada Nama' }}</td>
                            <td class="p-2">{{ $claim->staff->staff_kelayakan ?? 'Tiada Kelayakan' }}</td>
                            <td class="p-2">RM {{ number_format($claim->jumlah_resit, 2) }}</td>
                            <td class="p-2">
                                {{ \Carbon\Carbon::parse($claim->tarikh_resit)->translatedFormat('F Y') }}
                            </td>
                            <td class="p-2">
                                {{ number_format($claim->staff->staff_kelayakan - $claim->jumlah_resit, 2) }}
                            </td>
                            <td class="p-2">
                                @php
                                    $warna = match($claim->status) {
                                        'BAHARU'        => 'bg-yellow-100 text-green-800',
                                        'DISAHKAN'      => 'bg-yellow-100 text-green-800',
                                        'DISEMAK'       => 'bg-blue-100 text-blue-800',
                                        'DILULUSKAN'    => 'bg-green-100 text-green-800',
                                        'TIDAK LENGKAP' => 'bg-red-100 text-red-800',
                                        default         => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $warna }}">
                                    {{ $claim->status }}
                                </span>
                            </td>
                            <td class="p-2 flex items-center space-x-2">
                                {{-- Butang Edit --}}
                                <a href="{{ route('ptj.edit', $claim->id) }}" class="text-green-600 hover:text-green-800">
                                    <i data-lucide="pencil" class="w-5 h-5 text-green-600"></i>
                                </a>

                                {{-- Butang Padam --}}
                                <form action="{{ route('ptj.destroy', $claim->id) }}" method="POST" onsubmit="return confirm('Padam tuntutan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i data-lucide="trash-2" class="w-5 h-5 text-red-600"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                Tiada tuntutan dijumpai.
                            </td>
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
</x-app-layout>
