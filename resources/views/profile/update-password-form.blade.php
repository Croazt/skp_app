<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Ubah password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Pastikan akun anda menggunakan password acak dan panjang untuk tetap menjaga keamanan akun.') }}
    </x-slot>

    <x-slot name="form">
        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="password_saat_ini" value="{{ __('Password Saat Ini') }}" />
            <x-jet-input id="password_saat_ini" type="password" class="tw-mt-1 tw-block tw-w-full" wire:model.defer="state.password_saat_ini" autocomplete="current-password" />
            <x-jet-input-error for="password_saat_ini" class="tw-mt-2" />
        </div>

        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="password" value="{{ __('Password Baru') }}" />
            <x-jet-input id="password" type="password" class="tw-mt-1 tw-block tw-w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-jet-input-error for="password" class="tw-mt-2" />
        </div>

        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
            <x-jet-input id="password_confirmation" type="password" class="tw-mt-1 tw-block tw-w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-jet-input-error for="password_confirmation" class="tw-mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="tw-mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
