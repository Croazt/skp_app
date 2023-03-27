@push('modals')
    <div class="modal fade" wire:ignore role="dialog" id="tambahRencanaKinerjaModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilh Rencana Kinerja SKP</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="kinerjaAtasanForm">
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
                            <x-jet-label for="kinerja" value="{{ __('Detail Kinerja') }}" />
                            <select
                                class="tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm form-control select2"
                                id="deskripsi" name="kinerja" data-placeholder="Pilih/Tambahkan rencana kinerja">
                            </select>
                            <div id="deskripsi_error"></div>
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="kinerja" class="tw-text-center" value="{{ __('Detail Kinerja') }}" />
                            <div class="table-responsive" id='detail-kinerja-table'>
                                <table class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex">
                                    <thead class="text-center">
                                        <tr>
                                            {!! $this->renderHeader('RENCANA KINERJA') !!}
                                            {!! $this->renderHeader('ASPEK') !!}
                                            {!! $this->renderHeader('INDIKATOR KINERJA INDIVIDU') !!}
                                            {!! $this->renderHeader('BUTIR KEGIATAN TERKAIT') !!}
                                            {!! $this->renderHeader('OUTPUT KEGIATAN TERKAIT') !!}
                                            {!! $this->renderHeader('ANGKA KREDIT') !!}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="deskripsi_error"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer br form-group">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="kinerjaAtasanForm" class="btn btn-primary">Simpan perubahan</button>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('scripts')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var skpId = '<?php echo $this->skpGuru->skp_id; ?>'
        var id = '<?php echo $this->skpGuru->id; ?>'
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function resettambahRencanaKinerjaModal() {
            $("#kategori").val('utama').trigger('change')
        }
        $('#tambahRencanaKinerjaModal').on('hidden.bs.modal', function(event) {
            resettambahRencanaKinerjaModal()
        })
        $('#tambahRencanaKinerjaModal').on('show.bs.modal', function(event) {

            var res = [];
            $("#deskripsi").select2({
                ajax: {
                    url: '/skp/' + skpId + "/skp-guru/" + id + "/detail-kinerja",
                    type: "GET",
                    dataType: 'json',
                    delays: 250,
                    data: function(params) {
                        return {
                            kategori: $("#kategori").select2().val(),
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        res = response
                        return {
                            results: $.map(response, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.deskripsi
                                };
                            })
                        };
                    },
                    cache: true
                }
            })

            $('#deskripsi').on('change', function() {
                data = res.filter(obj => {
                    return obj.id == $(this).val()
                })
                if (data.length > 0) {
                    renderDetail(data[0])
                }
            })

            function renderDetail(data) {
                $('#detail-kinerja-table tbody').children().remove()
                $('#detail-kinerja-table tbody').append(
                    '<tr><td rowspan="3">' + data.deskripsi + '</td>' +
                    '<td class="tw-font-extrabold tw-align-middle">Kualitas</td>' +
                    '<td class="tw-align-middle">' + data.indikator_kualitas + '</td>' +
                    '<td rowspan="3">' + data.butir_kegiatan + '</td>' +
                    '<td rowspan="3">' + data.output_kegiatan + '</td>' +
                    '<td class="text-center tw-align-middle" rowspan="3">' + data.angka_kredit + '</td></tr>' +
                    '<tr><td class="tw-font-extrabold tw-align-middle">Kuantitas</td>' +
                    '<td class="tw-align-middle">' + data.indikator_kuantitas + '</td></tr>' +
                    '<tr><td class="tw-font-extrabold tw-align-middle">Waktu</td>' +
                    '<td class="tw-align-middle">' + data.indikator_waktu + '</td></tr>'
                )
            }
            //SUBMIT FORM
            $("form").submit(function(event) {
                event.stopImmediatePropagation();
                event.preventDefault();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var formData = {
                    _token: CSRF_TOKEN,
                    detail_kinerja_id: $("#deskripsi").select2().val(),
                };
                $("#error_message").each(function() {
                    $(this).remove()
                })

                $.ajax({
                    type: "POST",
                    url: '/skp-guru/' + id + "/add-rencana",
                    data: formData,
                    dataType: "json",
                    encode: true,
                    error: function(request, status, error) {
                        console.log("error", status);
                        $.each(request.responseJSON, function(key, item) {
                            $("#" + key + "_error").append(
                                '<div class="invalid-feedback  d-block" role = "alert" id="error_message">' +
                                item + '</div>'
                            )
                        })
                    },
                    success: function(data) {
                        $('#tambahRencanaKinerjaModal').modal('toggle');
                    },
                }).done(function(data) {
                    console.log(data);
                    Livewire.emit('kinerjaGuruAdded')
                })

                return false;
            });
        })
    </script>
@endpush
