<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Informasi Profil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Anda bisa mengubah email anda dengan menekan tombol simpan.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="tw-col-span-6 sm:tw-col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="tw-mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="tw-rounded-full tw-h-20 tw-w-20 tw-object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="tw-mt-2" x-show="photoPreview" style="display: none;">
                    <span class="tw-block tw-rounded-full tw-w-20 tw-h-20 tw-bg-cover tw-bg-no-repeat tw-bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="tw-mt-2 tw-mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="tw-mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="tw-mt-2" />
            </div>
        @endif

        <!-- Nama -->
        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="nama" value="{{ __('Nama') }}" />
            <x-jet-input disabled id="nama" type="text" class="form-control tw-mt-1 tw-block tw-w-full"
                wire:model.defer="state.nama" autocomplete="nama" />
            <x-jet-input-error for="nama" class="tw-mt-2" />
        </div>

        <!-- nip -->
        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="nip" value="{{ __('NIP') }}" />
            <x-jet-input disabled id="nip" type="text" class="form-control tw-mt-1 tw-block tw-w-full"
                wire:model.defer="state.nip" autocomplete="nip" />
            <x-jet-input-error for="nip" class="tw-mt-2" />
        </div>

        <!-- Email -->
        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="tw-mt-1 tw-block tw-w-full"
                wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="tw-mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                !$this->user->hasVerifiedEmail())
                <p class="tw-text-sm tw-mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="tw-mt-2 font-medium tw-text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
        <!-- pangkat -->
        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="pangkat" value="{{ __('Pangkat') }}" />
            <x-jet-input disabled id="pangkat" type="text" class="form-control tw-mt-1 tw-block tw-w-full"
                wire:model.defer="state.pangkat" autocomplete="pangkat" />
            <x-jet-input-error for="pangkat" class="tw-mt-2" />
        </div>
        <!-- pekerjaan -->
        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="pekerjaan" value="{{ __('Pekerjaan') }}" />
            <x-jet-input disabled id="pekerjaan" type="text" class="form-control tw-mt-1 tw-block tw-w-full"
                wire:model.defer="state.pekerjaan" autocomplete="pekerjaan" />
            <x-jet-input-error for="pekerjaan" class="tw-mt-2" />
        </div>
        <!-- tugas_tambahan -->
        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="tugas_tambahan" value="{{ __('Tugas Tambahan') }}" />
            <x-jet-input disabled id="tugas_tambahan" type="text" class="form-control tw-mt-1 tw-block tw-w-full"
                wire:model.defer="state.tugas_tambahan" autocomplete="tugas_tambahan" />
            <x-jet-input-error for="tugas_tambahan" class="tw-mt-2" />
        </div>
        <!-- unit_kerja -->
        <div class="tw-col-span-6 sm:tw-col-span-4">
            <x-jet-label for="unit_kerja" value="{{ __('Unit Kerja') }}" />
            <x-jet-input id="unit_kerja" type="text" class="form-control tw-mt-1 tw-block tw-w-full"
                wire:model.defer="state.unit_kerja" autocomplete="unit_kerja" />
            <x-jet-input-error for="unit_kerja" class="tw-mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Tersimpan.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Simpan') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
