<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/app_logobg.png') }}" class="tw-w-24 tw-h-24" alt="" srcset="">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="tw-mb-4 tw-font-medium tw-text-sm tw-text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="nip" value="{{ __('NIP/Email') }}" />
                <x-jet-input id="nip" class="tw-block tw-mt-1 tw-w-full" type="text" name="nip"
                    :value="old('nip')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="tw-block tw-mt-1 tw-w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="role" value="{{ __('Role') }}" />
                <select
                    class="tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm tw-block tw-mt-1 tw-w-full"
                    name="role" id="role">
                    @foreach ($roles as $role)
                        <option>{{ $role }}</option>
                    @endforeach
                </select>
            </div>

            <div class="tw-flex tw-justify-between tw-mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="tw-ml-2 tw-text-sm tw-text-gray-600">{{ __('Ingatkan saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Lupa kata sandi anda?') }}
                    </a>
                @endif
            </div>

            <div class="text-center tw-flex tw-content-center mt-4">
                <x-jet-button class="tw-mx-auto ml-4">
                    {{ __('Masuk') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
