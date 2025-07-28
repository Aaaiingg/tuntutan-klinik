<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Maklumat Tuntutan') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-gray-800 text-white p-6 rounded-xl shadow-lg mt-10">
        <div>
            <p><strong>Nama Staff:</strong> {{ $claim->nama_staff }}</p>
            <p><strong>Nama Klinik:</strong> {{ $claim->nama_klinik }}</p>
            <p><strong>No Resit:</strong> {{ $claim->no_resit }}</p>
            <p><strong>Bulan Tuntutan:</strong> {{ $claim->bulan }}</p>
            <p><strong>Jabatan:</strong> {{ $claim->user->department->name ?? 'tiada Jabatan' }}</p>
        </div>

        <div>
            <p><strong>Jumlah Semasa:</strong> RM {{ number_format($claim->jumlah_semasa, 2) }}</p>
            <p><strong>Jumlah Diambil:</strong> RM {{ number_format($claim->jumlah_diambil, 2) }}</p>
            <p><strong>Baki:</strong> RM {{ number_format($claim->baki, 2) }}</p>
            <p>
                <strong>Status:</strong> 
                <span class="inline-block px-3 py-1 text-sm rounded 
                    @if($claim->status == 'DILULUSKAN') bg-green-200 text-green-800 
                    @elseif($claim->status == 'TIDAK LENGKAP') bg-red-200 text-red-800 
                    @elseif($claim->status == 'DISEMAK') bg-blue-200 text-blue-800 
                    @else bg-gray-200 text-gray-800 @endif">
                    {{ $claim->status }}
                </span>
            </p>
        </div>
    </div>

    @php
    $resits = explode(',', $claim->resit_path);
@endphp

@if($resits)
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($resits as $resit)
            <img 
                src="{{ asset('storage/' . trim($resit)) }}" 
                alt="Resit Tuntutan" 
                class="rounded-lg border border-gray-600 max-w-full"
            >
        @endforeach
    </div>
@endif



    <div class="mt-6">
        <a href="{{ url()->previous() }}" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">← Kembali</a>
    </div>
</div>
</x-app-layout>
