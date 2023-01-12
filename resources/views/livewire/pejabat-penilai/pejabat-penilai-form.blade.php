<div class="tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg">
    <div class="card card-custom gutter-b example example-compact">
        @if ($this->operation == 'show')
            <div class="card-header">
                <h1 class="card-title">User Detail {{ $this->pejabatPenilai->getKey() }}</h1>
            </div>
        @endif
        <div class="card-body">
            <form class="form" wire:submit.prevent='save'>
                <div class="mb-3">
                    <x-jet-label for="nama" value="{{ __('Nama') }}" />
                    <x-jet-input id="nama" type="text"
                        class="{{ 'form-control ' . ($errors->first('data.nama') != null ? 'is-invalid' : '') }}"
                        wire:model="data.nama" name="data.nama" :value="old('nama')" autofocus
                        placeholder="Masukkan nama" />
                    @error('data.nama')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                @error('data.email')
                    <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <x-jet-label for="nip" value="{{ __('NIP') }}" />
                    <x-jet-input id="nip" type="text"
                        class="{{ 'form-control ' . ($errors->first('data.nip') != null ? 'is-invalid' : '') }}"
                        wire:model="data.nip" name="data.nip" :value="old('nip')" placeholder="Masukkan NIP" />
                    @error('data.nip')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="pekerjaan" value="{{ __('Pekerjaan') }}" />
                    <x-jet-input id="pekerjaan" type="text"
                        class="{{ 'form-control ' . ($errors->first('data.pekerjaan') != null ? 'is-invalid' : '') }}"
                        wire:model="data.pekerjaan" name="data.pekerjaan" :value="old('pekerjaan')" placeholder="Masukkan Pekerjaan" />
                    @error('data.pekerjaan')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="unit_kerja" value="{{ __('Unit Kerja') }}" />
                    <x-jet-input id="unit_kerja" type="text"
                        class="{{ 'form-control ' . ($errors->first('data.unit_kerja') != null ? 'is-invalid' : '') }}"
                        wire:model="data.unit_kerja" name="data.unit_kerja" :value="old('unit_kerja')"
                        placeholder="Masukkan unit kerja" />
                    @error('data.unit_kerja')
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
                <div class="mb-3">
                    <x-jet-label for="atasan" value="{{ __('Atasan') }}" />
                    <select
                        class="form-control select2 {{ $errors->first('data.atasan') != null ? 'is-invalid' : '' }}"
                        name="atasan" id="atasan"
                        data-placeholder="Pilih atasan" wire:model='data.atasan' :value="{{ $this->data['atasan'] }}">
                        <option></option>
                        @foreach ($this->atasan as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('data.atasan')
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
