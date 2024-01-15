<x-guest-layout>
    <!-- Session Status -->
    <div class="flex justify-center my-5">
        <img src="{{ asset('assets/admin/logo.png') }}" alt="" srcset="">
    </div>
    <b><h2 class="text-center mt-4 mb-4 font-weight-bold text-xl">Admin Page</h2></b>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ml-3 w-100">
                {{ __('Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
