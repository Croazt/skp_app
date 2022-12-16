<div class="tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg">
    <div class="card card-custom gutter-b example example-compact">
        @if ($this->operation == 'show' || $this->operation == 'update')
            <div class="tw-px-6 tw-pt-8 tw-pb-4">
                <h1 class="tw-text-center h5 tw-font-black">
                    SKP
                </h1>
                <h1 class="tw-text-center h5 tw-font-bold">
                    {{ $this->skp->periode_awal . ' s.d. ' . $this->skp->periode_akhir }}
                </h1>
            </div>
        @endif
        <div class="card-body">
            <form class="form" wire:submit.prevent='save'>
                <div class="mb-3">
                    <x-jet-label for="periode" value="{{ __('Periode') }}" />
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                        <x-jet-input id="periode" type="text" class="form-control daterange-cus"
                            wire.model='data.periode' name="data.periode" value="{{ $this->data['periode'] }}"
                            placeholder="YYYY-MM-DD - YYYY-MM-DD" />
                    </div>
                    @error('data.periode_awal')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                    @error('data.periode_akhir')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="perencanaan" value="{{ __('Perencanaan') }}" />
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                        <x-jet-input id="perencanaan" type="text" class="form-control daterange-single"
                            wire:model="data.perencanaan" name="data.perencanaan"
                            value="{{ $this->data['perencanaan'] }}" placeholder="YYYY-MM-DD" />
                    </div>
                    @error('data.perencanaan')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="penilaian" value="{{ __('Penilaian') }}" />
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                        <x-jet-input id="penilaian" type="text" class="form-control daterange-single"
                            wire:model="data.penilaian" name="data.penilaian" placeholder="YYYY-MM-DD"
                            value="{{ $this->data['penilaian'] }}" />
                    </div>
                    @error('data.penilaian')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="pejabat_penilai1" value="{{ __('Pejabat Penilai 1') }}" />
                    <select
                        class="form-control select2 {{ $errors->first('data.pejabat_penilai1') != null ? 'is-invalid' : '' }}"
                        data-minimum-results-for-search="{{ count($this->penilai) > 5 ? '' : 'Infinity' }}"
                        name="pejabat_penilai1" id="pejabat_penilai1" data-placeholder="Pilih pejabat penilai"
                        wire:model='data.pejabat_penilai1'>
                        <option></option>
                        @foreach ($this->penilai as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('data.pejabat_penilai1')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="pejabat_penilai2" value="{{ __('Pejabat Penilai 2') }}" />
                    <select
                        class="form-control select2 {{ $errors->first('data.pejabat_penilai2') != null ? 'is-invalid' : '' }}"
                        data-minimum-results-for-search="{{ count($this->penilai) > 5 ? '' : 'Infinity' }}"
                        name="pejabat_penilai2" id="pejabat_penilai2" data-placeholder="Pilih pejabat penilai"
                        wire:model='data.pejabat_penilai2'>
                        <option></option>
                        @foreach ($this->penilai as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('data.pejabat_penilai2')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="pengelola_kinerja" value="{{ __('Pengelola Kinerja') }}" />
                    <select
                        class="form-control select2 {{ $errors->first('data.pengelola_kinerja') != null ? 'is-invalid' : '' }}"
                        data-minimum-results-for-search="{{ count($this->pengelola) > 5 ? '' : 'Infinity' }}"
                        name="pengelola_kinerja" id="pengelola_kinerja" data-placeholder="Pilih pengelola kinerja"
                        wire:model='data.pengelola_kinerja'>
                        <option></option>
                        @foreach ($this->pengelola as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('data.pengelola_kinerja')
                        <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="tim_angka_kredit" value="{{ __('Tim Angka Kredit') }}" />
                    <select
                        class="form-control select2 {{ $errors->first('data.tim_angka_kredit') != null ? 'is-invalid' : '' }}"
                        data-minimum-results-for-search="{{ count($this->timKredit) > 5 ? '' : 'Infinity' }}"
                        name="tim_angka_kredit" id="tim_angka_kredit" data-placeholder="Pilih tim angka kredit"
                        wire:model='data.tim_angka_kredit'>
                        <option></option>
                        @foreach ($this->timKredit as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('data.tim_angka_kredit')
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
                        <button wire:click="tambahKinerja()" type="button" class="btn btn-info mr-2">
                            Tambahkan Kinerja
                        </button>
                    @elseif ($this->operation === 'show')
                        <button wire:click="edit()" type="button" class="btn btn-warning mr-2">
                            Ubah
                        </button>
                        <button wire:click="tambahKinerja()" type="button" class="btn btn-info mr-2">
                            Tambahkan Kinerja
                        </button>
                    @endif
                    <button wire:click="backToIndex()" type="button" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @include('livewire.partials.change_script')
    @push('scripts')
        <script>
            let initDatePicker = () => {
                date = $('.daterange-cus').val().split(' - ')
                if ($('.daterange-cus').val() === moment().format("YYYY-MM-DD") + ' - ' + moment().format("YYYY-MM-DD") ||
                    $(
                        '.daterange-cus').val() === "") {
                    $('.daterange-single').prop('disabled', true)
                }
                $('.daterange-single').daterangepicker({
                    minDate: moment(date[0]).add(1, 'days'),
                    maxDAte: moment(date[1]).add(-1, 'days'),
                    singleDatePicker: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    },
                });
            }

            $('.daterange-cus').daterangepicker({
                minDate: new Date(),
                locale: {
                    format: 'YYYY-MM-DD'
                },
                drops: 'down',
                opens: 'right'
            });

            initDatePicker()
            $('.daterange-single').on('change', function() {
                @this.set($(this).attr('name'), $(this).val());
            });

            $('.daterange-cus').on('change', function() {
                initDatePicker()
                let date = ($(this).val()).split(" - ")
                @this.set($(this).attr('name') + '_awal', date[0]);
                @this.set($(this).attr('name') + '_akhir', date[1]);
            });
        </script>
    @endpush
</div>
