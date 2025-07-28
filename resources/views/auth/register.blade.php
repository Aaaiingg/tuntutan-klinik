<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
         <div class="mt-4">
            <x-input-label for="role" :value="__('Peranan')" />
            <select id="role" name="role" required class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">-- Pilih Peranan --</option>
                <option value="ptj">Pembantu Tadbir Jabatan</option>
                <option value="ptjkp">Pembantu Tadbir Khidmat Pengurusan</option>
                <option value="ptk">Pembantu Tadbir Kewangan</option>
                <option value="kptkw">Ketua Pembantu Tadbir Kewangan</option>
                <option value="kptjkp">Ketua Pembantu Tadbir Khidmat Pengurusan</option>
                <option value="kjbt">Ketua Jabatan</option>
                <option value="pkk">Pengarah Kanan jabatan Kewangan</option>
                <option value="pkkp">Pengarah Kanan Jabatan Khidmat Pengurusan</option>

            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Department -->
         <div class="mt-4">
            <x-input-label for="dept_id" :value="__('Jabatan')" />
            <select name="dept_id" id="dept_id" class="block mt-1 w-full rounded">
                <option value="">-- Pilih Jabatan --</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ old('dept_id') == $department->id ? 'selected' : '' }}>
                {{ $department->name }}
            </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('dept_id')" class="mt-2" />
    </div>



        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
