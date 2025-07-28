<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kemaskini Tuntutan') }}
        </h2>
    </x-slot>

    <div class="py-10 flex justify-center">
        <form method="POST" action="{{ route('ptj.update', $claim->id) }}" enctype="multipart/form-data" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg w-full max-w-2xl">
            @csrf
            @method('PUT')

            <!-- No Siri Staff -->
             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="staff_no" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Siri Staff</label>
                    <select name="staff_no" id="staff_no" class="form-select w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
                        <option value="">-- Pilih No Staff --</option>
        @foreach ($staffs as $staff)
            <option value="{{ $staff->staff_no }}" @if($claim->staff_no == $staff->staff_no) selected @endif>
                {{ $staff->staff_no }} - {{ $staff->staff_nama }}
            </option>
        @endforeach
    </select>
</div>


                <!-- Nama Klinik -->
                <div>
                    <label for="nama_klinik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Klinik</label>
                    <input type="text" name="nama_klinik" id="nama_klinik" value="{{ $claim->nama_klinik }}" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
                </div>
            </div>

            <!-- No Resit -->
            <div>
                <label for="no_resit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Resit</label>
                <input type="text" name="no_resit" id="no_resit" value="{{ $claim->no_resit }}" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
            </div>

            <!-- Jumlah Resit -->
            <div>
                <label for="jumlah_resit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Resit (RM)</label>
                <input type="number" step="0.01" name="jumlah_resit" id="jumlah_resit" value="{{ $claim->jumlah_resit }}" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
            </div>

            <!-- Bulan -->
            <div>
                <label for="bulan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bulan</label>
                <select name="bulan" id="bulan" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
                    <option value="">-- Pilih Bulan --</option>
                    @foreach(['Januari','Februari','Mac','April','Mei','Jun','Julai','Ogos','September','Oktober','November','Disember'] as $bulan)
                        <option value="{{ $bulan }}" @if($claim->bulan == $bulan) selected @endif>{{ $bulan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Gambar Resit -->
            <div>
                <label for="resit_path" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar Resit (jika ada)</label>
                <input type="file" name="resit_path" id="resit_path" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200">
                @if ($claim->resit_path)
                    <p class="text-sm mt-2 dark:text-gray-400">Fail sedia ada: <a href="{{ asset('storage/'.$claim->resit_path) }}" target="_blank" class="text-blue-500 underline">Lihat Resit</a></p>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="btn btn-primary bg-blue-600 text-white hover:bg-blue-700 rounded-md py-2 px-4">
                    Kemaskini Tuntutan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
