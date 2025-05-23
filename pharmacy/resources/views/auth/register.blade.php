<x-guest-layout>
    <div class="w-full sm:max-w-md my-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <div class="bg-blue-300 text-center p-2 text-xl text-black mb-4">Form Registrasi</div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Username -->
            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Date of Birth -->
            <div class="mt-4">
                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth"
                    :value="old('date_of_birth')" required />
                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-input-label for="gender" :value="__('Gender')" />
                <select id="gender" name="gender"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    required>
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-input-label for="address" :value="__('Address')" />
                <textarea id="address" name="address"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    required>{{ old('address') }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- City -->
            <div class="mt-4">
                <x-input-label for="city" :value="__('City')" />
                <x-select-input id="city" class="block mt-1 w-full" name="city" required>
                    <option value="" {{ old('city') == '' ? 'selected' : '' }}>{{ __('Pilih Kota') }}</option>
                    <option value="Jakarta" {{ old('city') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                    <option value="Surabaya" {{ old('city') == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                    <option value="Bandung" {{ old('city') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                    <option value="Medan" {{ old('city') == 'Medan' ? 'selected' : '' }}>Medan</option>
                    <option value="Semarang" {{ old('city') == 'Semarang' ? 'selected' : '' }}>Semarang</option>
                    <option value="Makassar" {{ old('city') == 'Makassar' ? 'selected' : '' }}>Makassar</option>
                    <option value="Palembang" {{ old('city') == 'Palembang' ? 'selected' : '' }}>Palembang</option>
                    <option value="Batam" {{ old('city') == 'Batam' ? 'selected' : '' }}>Batam</option>
                    <option value="Yogyakarta" {{ old('city') == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                </x-select-input>
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-input-label for="phone_number" :value="__('Contact No')" />
                <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number"
                    :value="old('phone_number')" required />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>

            <!-- PayPal ID -->
            <div class="mt-4">
                <x-input-label for="paypal_id" :value="__('PayPal ID (Optional)')" />
                <x-text-input id="paypal_id" class="block mt-1 w-full" type="text" name="paypal_id"
                    :value="old('paypal_id')" />
                <x-input-error :messages="$errors->get('paypal_id')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Sudah punya akun? Login disini') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Submit') }}
                </x-primary-button>

                <button type="reset"
                    class="ms-4 inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Clear') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
