<x-jet-action-section>
    <x-slot name="title">
        {{ __('Browser Sessions') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Atur and keluar dari sesi yang aktif pada browser atau perangkat lain.') }}
    </x-slot>

    <x-slot name="content">
        <div class="tw-max-w-xl tw-text-sm tw-text-gray-600">
            {{ __('Jika dibutuhkan, Anda mungkin perlu keluar dari semua sesi browser pada perangkat anda. Beberapa sesi terbaru Anda ditampilkan dibawah; Bagaimanapun, daftar tersebut mungkin tidak lengkap. Jika anda merasa akun anda telah disusupi, anda harus mengubah password anda.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="tw-mt-5 tw-space-y-6">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="tw-flex tw-items-center">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="tw-w-8 tw-h-8 tw-text-gray-500">
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="tw-w-8 tw-h-8 tw-text-gray-500">
                                    <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                </svg>
                            @endif
                        </div>

                        <div class="tw-ml-3">
                            <div class="tw-text-sm tw-text-gray-600">
                                {{ $session->agent->platform() ? $session->agent->platform() : __('Unknown') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Unknown') }}
                            </div>

                            <div>
                                <div class="tw-text-xs tw-text-gray-500">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="tw-text-green-500 tw-font-semibold">{{ __('Perangkat saat ini') }}</span>
                                    @else
                                        {{ __('Aktifitas terakhir') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="tw-flex tw-items-center tw-mt-5">
            <x-jet-button wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Keluar dari sesi browser lain') }}
            </x-jet-button>

            <x-jet-action-message class="tw-ml-3" on="loggedOut">
                {{ __('Done.') }}
            </x-jet-action-message>
        </div>

        <!-- Log Out Other Devices Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                {{ __('Keluar Dari Sesi Browser Lainnya') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Tolong memasukkan kata sandi anda sebagai konfirmasi bahwa anda ingin mengeluarkan sesi browser anda dariseluruh perangkat.') }}

                <div class="tw-mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="tw-mt-1 tw-block tw-w-3/4"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-jet-input-error for="password" class="tw-mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    {{ __('Batal') }}
                </x-jet-secondary-button>

                <x-jet-button class="tw-ml-3"
                            wire:click="logoutOtherBrowserSessions"
                            wire:loading.attr="disabled">
                    {{ __('Keluar dari sesi browser lain') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
