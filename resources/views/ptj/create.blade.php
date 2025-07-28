<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Tuntutan') }}
        </h2>
    </x-slot>

    <div class="py-10 flex justify-center">

        <form method="POST" action="{{ route('ptj.store') }}" enctype="multipart/form-data" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg w-full max-w-2xl">
            @csrf

            <!-- Tarikh Tuntutan -->
<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tarikh Tuntutan</label>
    <p class="mt-1 text-md text-gray-900 dark:text-gray-100 font-semibold">
        {{ \Carbon\Carbon::now()->format('d F Y') }}
    </p>
</div>



            <!-- No siri Staff -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="staff_no" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Siri Staff</label>
                    <select name="staff_no" id="staff_no" class="form-select w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
                        <option value="">-- Pilih No Staff --</option>
        @foreach ($staffs as $staff)
            <option value="{{ $staff->staff_no }}">{{ $staff->staff_no }} - {{ $staff->staff_nama }}</option>
        @endforeach
    </select>
                </div>

                <!-- Nama Klinik -->
                <div>
                    <label for="nama_klinik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Klinik</label>
                    <input type="text" name="nama_klinik" id="nama_klinik" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
                </div>
            </div>

            <!-- Tarikh Resit -->
             <div>
                <label for="tarikh_resit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        Tarikh Resit
    </label>
    <input type="date" name="tarikh_resit" id="tarikh_resit" 
        class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200" 
        required>
    </div>


            <!-- No Resit -->
            <div>
                <label for="no_resit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Resit</label>
                <input type="text" name="no_resit" id="no_resit" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
            </div>


            <!-- Jumlah Resit -->
            <div>
                <label for="jumlah_resit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Resit (RM)</label>
                <input type="number" step="0.01" name="jumlah_resit" id="jumlah_resit" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
            </div>

            <!-- Gambar Resit -->
            <div>
                <label for="resit_path" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar Resit (jika ada)</label>
                <input type="file" name="resit_path[]" id="resit_path" multiple class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200">
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="btn btn-primary bg-blue-600 text-white hover:bg-blue-700 rounded-md py-2 px-4">
                    Hantar Tuntutan
                </button>
            </div>
        </form>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateInput = document.getElementById('tarikh_resit');
        const today = new Date();

        const prevMonthDate = new Date(today.getFullYear(), today.getMonth() - 1, 1); // 1hb bulan sebelumnya
        const year = prevMonthDate.getFullYear();
        const month = String(prevMonthDate.getMonth() + 1).padStart(2, '0');

        const minDate = `${year}-${month}-01`;
        const lastDay = new Date(year, prevMonthDate.getMonth() + 1, 0).getDate();
        const maxDate = `${year}-${month}-${String(lastDay).padStart(2, '0')}`;

        dateInput.min = minDate;
        dateInput.max = maxDate;
    });
</script>

    </div>
</x-app-layout>
