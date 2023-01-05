<script>
    window.addEventListener('showResponseModal', event => {
        console.log('wew')
        $('#response-title').children().remove();
        $('#response-message').children().remove();
        $('#response-modal').modal('show');
        if (!event.detail.success) {
            $('#response-title').append(`
                        <div class="icon-box-error tw-mb-5">
                            <i class="fas fa-x"></i>
                        </div>
                        <h4 class="modal-title tw-text-center tw-text-base">TEDAPAT KESALAHAN!</h4>
                `)
        } else {
            $('#response-title').append(`
                        <div class="icon-box-success tw-mb-5">
                            <i class="fas fa-check"></i>
                        </div>
                        <h4 class="modal-title tw-text-center tw-text-base">SUKSES!</h4>
                `)
        }
        $('#response-message').append('<div>'+event.detail.message+'</div>');
    })
</script>