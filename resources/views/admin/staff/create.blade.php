<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Staff Baru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">

                <!-- Papar sebarang mesej error -->
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Borang tambah staff -->
                <form action="{{ route('admin.staff.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">No Staff</label>
                        <input type="text" name="staff_no" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nama Staff</label>
                        <input type="text" name="staff_nama" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Jawatan</label>
                        <input type="text" name="staff_jawatan" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Kelayakan</label>
                        <input type="text" name="staff_kelayakan" class="form-input w-full">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Jabatan</label>
                        <select name="dept_id" class="form-select w-full" required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Status</label>
                        <select name="status" class="form-select w-full" required>
                            <option value="aktif">Aktif</option>
                            <option value="tidak_aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('dashboard.admin') }}" class="mr-4 text-gray-600 hover:underline">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan Staff
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
