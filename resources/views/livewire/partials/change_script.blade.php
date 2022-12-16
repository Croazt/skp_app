@push('scripts')
    <script>
        window.initSelect2 = () => {
            $('.select2').select2({
                placeholder: "Select your option",
                tags: true,
            });
            $('.select2').on('change', function(e) {
                localStorage.setItem($(this).attr('name'), $(this).val());
                @this.set('data.' + $(this).attr('name'), $(this).val());
            });
        }
        
        window.initDisable = () => {
            let operation = '<?php echo $this->operation ?>'
            if(operation === "show")
            $('.form-control').prop( "disabled", true );
        }

        $(document).ready(function() {
            initSelect2();
            initDisable();
        })

        document.addEventListener('livewire:load', function() {
            initSelect2();
            initDisable();
        })
        document.addEventListener('LiveWireComponentRefreshed', function() {
            initSelect2()
            initDisable();
        })
        Livewire.on('select2', () => {
            initSelect2();
            initDisable();
        });
    </script>
@endpush
