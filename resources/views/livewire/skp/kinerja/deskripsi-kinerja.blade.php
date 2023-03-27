@push('modals')
    <div class="modal fade" wire:ignore role="dialog" id="deskripsiKinerjaModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Deskripsi RHK Atasan</h5>
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
                                id="kategori-rhk" name="kategori" data-minimum-results-for-search="Infinity">
                                <option value="utama">Tugas Utama</option>
                                <option value="tambahan">Tugas Tambahan</option>
                            </select>
                            <div id="kategori_error"></div>
                        </div>
                        <div class="mb-3">
                            <x-jet-label for="kinerja" value="{{ __('Deskripsi RHK atasan') }}" />
                            <x-jet-input class="form-control {{ $errors->first('deskripsi') != null ? 'is-invalid' : '' }}"
                                id="deskripsi-rhk" name="kinerja" placeholder="Ubah RHK Atasan" />
                            <div id="deskripsi_error"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br form-group">
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
        var id = '<?php echo $this->skp->id; ?>'
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function resetdeskripsiKinerja() {
            $("#kategori-rhk").val('utama').trigger('change')
            $("#deskripsi-rhk").val('').trigger('change')
            Livewire.emit('KinerjaAdded')
        }
        $('#deskripsiKinerjaModal').on('hidden.bs.modal', function(event) {

            resetdeskripsiKinerja()
        })
        $('#deskripsiKinerjaModal').on('show.bs.modal', function(event) {
            var link = $(event.relatedTarget),
                modal = $(this),
                kategori = link.data("kategori"),
                deskripsi_id = link.data("deskripsiid");
            deskripsi = link.data("deskripsi");

            $("#kategori-rhk").val(kategori).trigger('change');


            console.log(kategori, deskripsi)
            $("#deskripsi-rhk").val(deskripsi).trigger('change')
            //SUBMIT FORM
            $("form").submit(function(event) {
                event.stopImmediatePropagation();
                event.preventDefault();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var formData = {
                    _token: CSRF_TOKEN,
                    kategori: $("#kategori-rhk").select2().val(),
                    deskripsi_id: deskripsi_id,
                    deskripsi: $("#deskripsi-rhk").val(),
                };
                $("#error_message").each(function() {
                    $(this).remove()
                })

                $.ajax({
                    type: "POST",
                    url: '/skp/' + id + "/kinerja/" + deskripsi_id + "/",
                    data: formData,
                    dataType: "json",
                    encode: true,
                    error: function(request, status, error) {
                        $.each(request.responseJSON.errors, function(key, item) {
                            $("#" + key + "_error").append(
                                '<div class="invalid-feedback  d-block" role = "alert" id="error_message">' +
                                item + '</div>'
                            )
                        })
                    },
                    success: function(data) {

                        location.reload(true);
                        $('#deskripsiKinerjaModal').modal('toggle');
                    },
                }).done(function(data) {
                    console.log(data);
                })

                return false;
            });
        })
    </script>
@endpush
