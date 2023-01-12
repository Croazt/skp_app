@push('modals')
    <div class="modal fade" wire:ignore role="dialog" id="kinerjaAtasanModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Rencana Hasil Kinerja</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="kinerjaAtasanForm">
                        <div class="tw-text-center tw-font-extrabold">
                            Isian RHK Atasan
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="kategori" value="{{ __('Kategori') }}" />
                            @php
                                $options = ['utama' => 'Tugas Utama', 'tambahan' => 'Tugas Tambahan'];
                            @endphp
                            <select
                                class="tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm form-control select2"
                                id="kategori" name="kategori" data-minimum-results-for-search="Infinity">
                                <option value="utama">Tugas Utama</option>
                                <option value="tambahan">Tugas Tambahan</option>
                            </select>
                            <div id="kategori_error"></div>
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="kinerja" value="{{ __('Deskripsi RHK atasan') }}" />
                            <select
                                class="tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm form-control select2"
                                id="deskripsi" name="kinerja" data-placeholder="Pilih/Tambahkan RHK Atasan" data-tags=true>
                            </select>
                            <div id="deskripsi_error"></div>
                        </div>
                        <div class="tw-text-center tw-font-extrabold">
                            Isian Detail RHK
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="detail_rencana" value="{{ __('Deskrpisi Detail RHK') }}" />
                            <x-jet-input
                                class="form-control {{ $errors->first('detail_rencana') != null ? 'is-invalid' : '' }}"
                                name="detail_rencana" id="detail_rencana" placeholder="Masukkan detail RKH " />
                            <div id="detail_rencana_error"></div>
                        </div>
                        <div class="mb-3 tw-flex">
                            <div class="tw-w-4/12">
                                <x-jet-label for="angka_kredit" value="{{ __('Tipe Angka Kredit') }}" />
                                <select disabled
                                    class="tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm form-control select2"
                                    id="tipe_angka_kredit" name="tipe_angka_kredit"
                                    data-minimum-results-for-search="Infinity">
                                    <option value="persen">Persentase</option>
                                    <option value="absolut">Absolut</option>
                                </select>
                                <div id="tipe_angka_kredit_error"></div>
                            </div>
                            <div class="tw-w-8/12">
                                <x-jet-label for="angka_kredit" value="{{ __('Angka Kredit') }}" />
                                <x-jet-input type="number"
                                    class="form-control {{ $errors->first('angka_kredit') != null ? 'is-invalid' : '' }}"
                                    name="angka_kredit" id="angka_kredit" placeholder="Masukkan detail IKI Kualitas" />
                                <div id="angka_kredit_error"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="iki_kualitas" value="{{ __('IKI Kualitas') }}" />
                            <x-jet-input
                                class="form-control {{ $errors->first('iki_kualitas') != null ? 'is-invalid' : '' }}"
                                name="iki_kualitas" id="iki_kualitas" placeholder="Masukkan detail IKI Kualitas" />
                            <div id="iki_kualitas_error"></div>
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="iki_kuantitas" value="{{ __('IKI Kuantitas') }}" />
                            <x-jet-input
                                class="form-control {{ $errors->first('iki_kuantitas') != null ? 'is-invalid' : '' }}"
                                name="iki_kuantitas" id="iki_kuantitas" placeholder="Masukkan detail IKI Kuantitas" />
                            <div id="iki_kuantitas_error"></div>
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="iki_waktu" value="{{ __('IKI Waktu') }}" />
                            <x-jet-input class="form-control {{ $errors->first('iki_waktu') != null ? 'is-invalid' : '' }}"
                                name="iki_waktu" id="iki_waktu" placeholder="Masukkan detail IKI Waktu" />
                            <div id="iki_waktu_error"></div>
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="target_output_kualitas" value="{{ __('Target Output Kualitas') }}" />
                            <x-jet-input
                                class="form-control {{ $errors->first('target_output_kualitas') != null ? 'is-invalid' : '' }}"
                                name="target_output_kualitas" id="target_output_kualitas"
                                placeholder="Masukkan target output Kualitas" />
                            <div id="target_output_kualitas_error"></div>
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="target_output_kuantitas" value="{{ __('Target Output Kuantitas') }}" />
                            <x-jet-input
                                class="form-control {{ $errors->first('target_output_kuantitas') != null ? 'is-invalid' : '' }}"
                                name="target_output_kuantitas" id="target_output_kuantitas"
                                placeholder="Masukkan target output Kuantitas" />
                            <div id="target_output_kuantitas_error"></div>
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="target_output_waktu" value="{{ __('Target Output Waktu') }}" />
                            <x-jet-input
                                class="form-control {{ $errors->first('target_output_waktu') != null ? 'is-invalid' : '' }}"
                                name="target_output_waktu" id="target_output_waktu"
                                placeholder="Masukkan target output Waktu" />
                            <div id="target_output_waktu_error"></div>
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="butir_kegiatan" value="{{ __('Butir kegiatan terkait') }}" />
                            <x-jet-input
                                class="form-control {{ $errors->first('butir_kegiatan') != null ? 'is-invalid' : '' }}"
                                name="butir_kegiatan" id="butir_kegiatan"
                                placeholder="Masukkan butir kegiatan terkait" />
                            <div id="butir_kegiatan_error"></div>
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="output_kegiatan" value="{{ __('Output kegiatan terkait') }}" />
                            <x-jet-input
                                class="form-control {{ $errors->first('output_kegiatan') != null ? 'is-invalid' : '' }}"
                                name="output_kegiatan" id="output_kegiatan"
                                placeholder="Masukkan output kegiatan terkait" />
                            <div id="output_kegiatan_error"></div>
                        </div>
                        <div class="mb-3">
                            <div class="tw-flex tw-justify-between">
                                <label class="tw-block tw-font-medium tw-text-sm tw-text-gray-700" for="pekerjaan">Bawaan
                                    untuk jabatan tertentu</label>
                                <x-jet-input type="checkbox"
                                    class="{{ $errors->first('is_default') != null ? 'is-invalid' : '' }}"
                                    name="is_default" id="is_default" placeholder="Masukkan detail IKI Kualitas" />
                            </div>
                            <div id="is_default_error"></div>
                            <select
                                class="tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm form-control select2"
                                id="jabatan" name="jabatan" data-placeholder="Pilih tugas bawaan terhadap jabatan">
                            </select>
                            <div id="is_jabatan_error"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br form-group">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="kinerjaAtasanForm" class="btn btn-primary">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('scripts')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var id = '<?php echo $this->skp->id; ?>'
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function resetKinerjaAtasanModal() {
            $("#kategori").val('utama').trigger('change')
            $("#deskripsi").val('').trigger('change')
            $("#detail_rencana").val('').trigger('change')
            $("#tipe_angka_kredit").val('absolut').trigger('change')
            $("#angka_kredit").val('').trigger('change')
            $("#iki_kuantitas").val('').trigger('change')
            $("#iki_kualitas").val('').trigger('change')
            $("#iki_waktu").val('').trigger('change')
            $("#target_output_kuantitas").val('').trigger('change')
            $("#target_output_kualitas").val('').trigger('change')
            $("#target_output_waktu").val('').trigger('change')
            $("#butir_kegiatan").val('').trigger('change')
            $("#output_kegiatan").val('').trigger('change')
            $('#is_default').prop('checked', false)
            $("#jabatan").val('').trigger('change')
            Livewire.emit('KinerjaAdded')
        }
        $('#kinerjaAtasanModal').on('hidden.bs.modal', function(event) {
            resetKinerjaAtasanModal()
        })
        $('#kinerjaAtasanModal').on('show.bs.modal', function(event) {

            //FUNCTION RESET MODAL


            //SELECT KINERJA
            $("#deskripsi").select2({
                ajax: {
                    url: '/skp/' + id + "/kinerja/get",
                    type: "GET",
                    dataType: 'json',
                    delays: 250,
                    data: function(params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: $.map(response, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.text
                                };
                            })
                        };
                    },
                    cache: true
                }
            })
            // SELECT JABATAN
            $("#jabatan").select2({
                ajax: {
                    url: '/skp/' + id + "/kinerja/get-jabatan",
                    type: "GET",
                    dataType: 'json',
                    delays: 250,
                    data: function(params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: $.map(response, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.text
                                };
                            })
                        };
                    },
                    cache: true
                }

            });
            $('#kategori').on('change', function(){
                if($(this).val() == 'tambahan'){
                    $('#tipe_angka_kredit').val('absolut').trigger('change')
                    return
                }
                $('#tipe_angka_kredit').val('persen').trigger('change')
            })
            //SET JABATAN DISABLED
            if (!$('#is_default').is(':checked')) {
                $('#jabatan').prop('disabled', true)
            }
            $('#is_default').on('change', function() {
                $('#jabatan').prop('disabled', !$(this).is(':checked'))
                if (!$(this).is(':checked')) {
                    $('#jabatan').val('').trigger('change')
                }
            })
            //SUBMIT FORM
            $("form").submit(function(event) {
                event.stopImmediatePropagation();
                event.preventDefault();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var formData = {
                    _token: CSRF_TOKEN,
                    kategori: $("#kategori").select2().val(),
                    deskripsi: $("#deskripsi").select2().val(),
                    detail_rencana: $("#detail_rencana").val(),
                    tipe_angka_kredit: $("#tipe_angka_kredit").select2().val(),
                    angka_kredit: $("#angka_kredit").val(),
                    iki_kuantitas: $("#iki_kuantitas").val(),
                    iki_kualitas: $("#iki_kualitas").val(),
                    iki_waktu: $("#iki_waktu").val(),
                    target_output_kuantitas: $("#target_output_kuantitas").val(),
                    target_output_kualitas: $("#target_output_kualitas").val(),
                    target_output_waktu: $("#target_output_waktu").val(),
                    butir_kegiatan: $("#butir_kegiatan").val(),
                    output_kegiatan: $("#output_kegiatan").val(),
                    is_default: ($('#is_default').is(':checked') ? 1 : 0),
                    jabatan: $("#jabatan").select2().val(),
                };
                $("#error_message").each(function() {
                    $(this).remove()
                })

                $.ajax({
                    type: "POST",
                    url: '/skp/' + id + "/kinerja",
                    data: formData,
                    dataType: "json",
                    encode: true,
                    error: function(request, status, error) {
                        console.log(request.responseJSON.errors);
                        $.each(request.responseJSON.errors, function(key, item) {
                            $("#" + key + "_error").append(
                                '<div class="invalid-feedback  d-block" role = "alert" id="error_message">' +
                                item + '</div>'
                            )
                        })
                    },
                    success: function(data) {
                        $('#kinerjaAtasanModal').modal('toggle');
                    },
                }).done(function(data) {
                    console.log(data);
                })

                return false;
            });
        })
    </script>
@endpush
