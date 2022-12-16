<div class="{{ $this->showModal ? 'modal show fade tw-block tw-overflow-y-scroll' : 'modal fade tw-hidden' }}"
    tabindex="-1" role="dialog" id="kinerjaAtasanModal" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Rencana Hasil Kinerja</h5>
                <button type="button" class="close" wire:click="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" wire:submit.prevent="tambahKinerjaAtasan" id="kinerjaAtasanForm">
                    <div class="tw-text-center tw-font-extrabold">
                        Isian RHK Atasan
                    </div>
                    {{ $this->getErrorBag() }}
                    <div class="mb-3">
                        <x-jet-label for="kategori" value="{{ __('Kategori') }}" />
                        @php
                            $options = ['utama' => 'Tugas Utama', 'tambahan' => 'Tugas Tambahan'];
                        @endphp
                        <x-select2 class="form-control" id="data.kategori" name="kategori" wire:model='data.kategori'
                            data-minimum-results-for-search="Infinity" :options="$options" tag="false" />
                        @error('data.kategori')
                            <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <x-jet-label for="deskripsi" value="{{ __('Deskripsi RHK atasan') }}" />
                        <x-select2 class="form-control" id="data.deskripsi" name="deskripsi" wire:model='data.deskripsi'
                            :options="$kinerja" tag="true" />
                        @error('data.deskripsi')
                            <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="tw-text-center tw-font-extrabold">
                        Isian Detail RHK
                    </div>
                    <div class="mb-3">
                        <x-jet-label for="detail_rencana" value="{{ __('Deskrpisi Detail RHK') }}" />
                        <x-jet-input
                            class="form-control {{ $errors->first('data.detail_rencana') != null ? 'is-invalid' : '' }}"
                            name="detail_rencana" id="detail_rencana" placeholder="Masukkan detail RKH "
                            wire:model='data.detail_rencana' />
                        @error('data.detail_rencana')
                            <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 tw-flex">
                        <div class="tw-w-4/12">
                            <x-jet-label for="data.angka_kredit" value="{{ __('Tipe Angka Kredit') }}" />
                            <x-select2 class="form-control" id="data.tipe_angka_kredit" name="tipe_angka_kredit"
                                wire:model='data.tipe_angka_kredit' :options="$tipeAngkaKredit" tag="true"
                                data-minimum-results-for-search="Infinity" />
                            @error('data.angka_kredit')
                                <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="tw-w-8/12">
                            <x-jet-label for="data.angka_kredit" value="{{ __('Angka Kredit') }}" />
                            <x-jet-input type="number"
                                class="form-control {{ $errors->first('data.angka_kredit') != null ? 'is-invalid' : '' }}"
                                name="angka_kredit" id="data.angka_kredit" placeholder="Masukkan detail IKI Kualitas"
                                wire:model='data.angka_kredit' />
                            @error('data.angka_kredit')
                                <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <x-jet-label for="data.iki_kualitas" value="{{ __('IKI Kualitas') }}" />
                        <x-jet-input
                            class="form-control {{ $errors->first('data.iki_kualitas') != null ? 'is-invalid' : '' }}"
                            name="iki_kualitas" id="data.iki_kualitas" placeholder="Masukkan detail IKI Kualitas"
                            wire:model='data.iki_kualitas' />
                        @error('data.iki_kualitas')
                            <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <x-jet-label for="data.iki_kuantitas" value="{{ __('IKI Kuantitas') }}" />
                        <x-jet-input
                            class="form-control {{ $errors->first('data.iki_kuantitas') != null ? 'is-invalid' : '' }}"
                            name="iki_kuantitas" id="data.iki_kuantitas" placeholder="Masukkan detail IKI Kuantitas"
                            wire:model='data.iki_kuantitas' />
                        @error('data.iki_kuantitas')
                            <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <x-jet-label for="data.iki_waktu" value="{{ __('IKI Waktu') }}" />
                        <x-jet-input
                            class="form-control {{ $errors->first('data.iki_waktu') != null ? 'is-invalid' : '' }}"
                            name="iki_waktu" id="data.iki_waktu" placeholder="Masukkan detail IKI Waktu"
                            wire:model='data.iki_waktu' />
                        @error('data.iki_waktu')
                            <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <x-jet-label for="data.butir_kegiatan" value="{{ __('Butir kegiatan terkait') }}" />
                        <x-jet-input
                            class="form-control {{ $errors->first('data.butir_kegiatan') != null ? 'is-invalid' : '' }}"
                            name="butir_kegiatan" id="data.butir_kegiatan"
                            placeholder="Masukkan butir kegiatan terkait" wire:model='data.butir_kegiatan' />
                        @error('data.butir_kegiatan')
                            <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <x-jet-label for="data.output_kegiatan" value="{{ __('Output kegiatan terkait') }}" />
                        <x-jet-input
                            class="form-control {{ $errors->first('data.output_kegiatan') != null ? 'is-invalid' : '' }}"
                            name="output_kegiatan" id="data.output_kegiatan"
                            placeholder="Masukkan output kegiatan terkait" wire:model='data.output_kegiatan' />
                        @error('data.output_kegiatan')
                            <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="tw-flex tw-justify-between">
                            <label class="tw-block tw-font-medium tw-text-sm tw-text-gray-700"
                                for="data.pekerjaan">Bawaan untuk jabatan tertentu</label>
                            <x-jet-input type="checkbox"
                                class="{{ $errors->first('data.is_default') != null ? 'is-invalid' : '' }}"
                                name="is_default" id="data.is_default" placeholder="Masukkan detail IKI Kualitas"
                                wire:model='data.is_default' />
                            @error('data.is_default')
                                <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <select class="form-control select2" id="data-pekerjaan" name="pekerjaan"
                                wire:model='data.pekerjaan' :options="$this - > jabatan" data-tags="false"
                                @if (!$this->data['is_default'])
                                disabled
                                @endif >
                                <option value=""></option>
                                @foreach ($this->jabatan as $key => $option)
                                    <option value="{{ $key }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br form-group">
                <button wire:click="closeModal()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click="save()" type="button" class="btn btn-primary">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
{{-- 
@pushonce('scripts')
    <script>
        window.initPekerjaan = () => {
            $('.data-pekerjaan').select2({
                placeholder: "Pilih opsi Anda",
            });
            $('.data-pekerjaan').on('change', function(e) {
                localStorage.setItem($(this).attr('name'), $(this).val());
                @this.set('data.' + $(this).attr('name'), $(this).val());
            });
        }

        $(document).ready(function() {
            initPekerjaan();
        })

        document.addEventListener('livewire:load', function() {
            initPekerjaan();
        })
        document.addEventListener('LiveWireComponentRefreshed', function() {
            initPekerjaan()
        })
        Livewire.on('select2', () => {
            initPekerjaan();
        });
    </script>
@endpushonce --}}
