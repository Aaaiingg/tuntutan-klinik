<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <!-- Butang Tambah Staff -->
            <div>
                <a href="{{ route('admin.staff.create') }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Tambah Staff Baru
                </a>
            </div>

            <!-- Senarai Staff -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Senarai Staff</h3>

                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Jawatan</th>
                            <th class="px-4 py-2">Jabatan</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($staffs as $staff)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $staff->staff_nama }}</td>
                                <td class="px-4 py-2">{{ $staff->staff_jawatan }}</td>
                                <td class="px-4 py-2">{{ $staff->departments->name?? '-' }}</td>
                                <td class="px-4 py-2">
                                    @if ($staff->status == 'aktif')
                                        <span class="text-green-600 font-semibold">Aktif</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('admin.staff.edit', $staff->id) }}" 
                                       class="text-blue-500 hover:underline">Kemaskini</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">Tiada staff dijumpai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
