<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat Datang !') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-dashboard-card title="Jumlah Tuntutan" color="indigo" :value="$jumlahTuntutan" prefix="RM" />
                <x-dashboard-card title="Tuntutan Baharu" color="blue" :value="$tuntutanBaharu" />
                <x-dashboard-card title="Bilangan Tuntutan" color="green" :value="$BilTuntutan" />
                <x-dashboard-card title="Pengesahan Ketua Jabatan" color="indigo" :value="$tuntutanKJ" />
                <x-dashboard-card title="Pengesahan Jabatan Khidmat Pengurusan" color="blue" :value=0 />
                <x-dashboard-card title="Pengesahan Jabatan Kewangan" color="blue" :value=0 />
                <x-dashboard-card title="Tuntutan tidak lengkap" color="green" :value="$tuntutanTL" />
                <x-dashboard-card title="Tambah tuntutan baharu" color="green" :value="null">
    <x-slot name="actions">
        <a href="{{ route('ptj.create') }}"
           class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
            + Tambah
        </a>
    </x-slot>
</x-dashboard-card>
<x-dashboard-card title="Rekod dan status Tuntutan" color="green">
    <x-slot name="actions">
        <a href="{{ route('ptj.show') }}"
           class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Lihat
        </a>
    </x-slot>
</x-dashboard-card>

            </div>

        </div>
    </div>
</x-app-layout>
