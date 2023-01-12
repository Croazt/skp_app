<div class="tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg">
    <div class="card card-custom gutter-b example example-compact">
        @if ($this->operation == 'show')
            <div class="card-header">
                <h1 class="card-title">User Detail {{ $user->getKey() }}</h1>
            </div>
        @endif
        <div class="card-body">
            <form class="form" wire:submit.prevent='save'>
                <div class="mb-3">
                    <x-jet-label for="nama" value="{{ __('Nama') }}" />
                    <x-jet-input id="nama" type="text"
                        class="{{ 'form-control ' . ($errors->first('data.nama') != null ? 'is-invalid' : '') }}"
                        wire:model="data.nama" name="data.nama" :value="old('nama')" autofocus placeholder="Masukkan nama"/>
                    @error('data.nama')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" type="email"
                        class="{{ 'form-control ' . ($errors->first('data.email') != null ? 'is-invalid' : '') }}"
                        wire:model="data.email" name="data.email" :value="old('email')" placeholder="Masukkan email"/>
                        @error('data.email')
                            <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                        @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="nip" value="{{ __('NIP') }}" />
                    <x-jet-input id="nip" type="text"
                        class="{{ 'form-control ' . ($errors->first('data.nip') != null ? 'is-invalid' : '') }}"
                        wire:model="data.nip" name="data.nip" :value="old('nip')" placeholder="Masukkan NIP"/>
                    @error('data.nip')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="pekerjaan" value="{{ __('Pekerjaan') }}" />
                    <select
                        class="form-control select2 {{ $errors->first('data.pekerjaan') != null ? 'is-invalid' : '' }}"
                        data-minimum-results-for-search="Infinity" name="pekerjaan" id="pekerjaan"
                        wire:model='data.pekerjaan' data-placeholder="Pilih pekerjaan">
                        <option></option>
                        @foreach ($this->pekerjaan as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('data.pekerjaan')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="unit_kerja" value="{{ __('Unit Kerja') }}" />
                    <x-jet-input id="unit_kerja" type="text"
                        class="{{ 'form-control ' . ($errors->first('data.unit_kerja') != null ? 'is-invalid' : '') }}"
                        wire:model="data.unit_kerja" name="data.unit_kerja" :value="old('unit_kerja')" placeholder="Masukkan unit kerja"/>
                    @error('data.unit_kerja')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="tugas_tambahan" value="{{ __('Tugas Tambahan') }}" />
                    <select
                        class="form-control select2 {{ $errors->first('data.tugas_tambahan') != null ? 'is-invalid' : '' }}"
                        data-minimum-results-for-search="Infinity" name="tugas_tambahan" id="tugas_tambahan"
                        wire:model='data.tugas_tambahan' data-placeholder="Pilih tugas tambahan">
                        <option></option>
                        @foreach ($this->tugasTambahan as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('data.tugas_tambahan')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="pangkat_id" value="{{ __('Pangkat') }}" />
                    <select
                        class="form-control select2 {{ $errors->first('data.pangkat_id') != null ? 'is-invalid' : '' }}"
                        data-minimum-results-for-search="Infinity" name="pangkat_id" id="pangkat_id"
                        data-placeholder="Pilih pangkat" wire:model='data.pangkat_id'>
                        <option></option>
                        @foreach ($this->pangkat as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('data.pangkat_id')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <x-jet-label for="role" value="{{ __('Role') }}" />
                    <select name="roles"
                        class="form-control select2 {{ $errors->first('data.roles') != null ? 'is-invalid' : '' }}"
                        id="select2" multiple="" data-placeholder="Pilih role" wire:model='data.roles'>
                        <option></option>
                        @foreach ($this->roleOptions as $key => $roleOption)
                            <option {{ in_array($roleOption, $this->data['roles']) ? 'selected' : '' }}
                                value="{{ $key }}">{{ $roleOption }}</option>
                        @endforeach
                    </select>
                    @error('data.roles')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group text-center">
                    @if ($this->operation === 'create')
                        <button type="submit" class="btn btn-primary mr-2">
                            Tambahkan
                        </button>
                    @elseif ($this->operation === 'update')
                        <button type="submit" class="btn btn-primary mr-2">
                            Simpan Perubahan
                        </button>
                    @elseif ($this->operation === 'show')
                        <button wire:click="edit()" type="button" class="btn btn-warning mr-2">
                            Ubah Data
                        </button>
                    @endif
                    <button wire:click="backToIndex()" type="button" class="btn btn-secondary">Kembali</button>
                </div>
            </form>
        </div>
    </div>
    @include('livewire.partials.change_script')
</div>
