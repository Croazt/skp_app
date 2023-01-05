<div wire:ignore>
    <select {{ $attributes->except(['options'])->merge(['class' => 'select2']) }}>
        <option value=""></option>
        @foreach ($options as $key => $option)
            <option value="{{ $key }}" wire:key="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>
</div>
@push('scripts')
    <script>
        window.initSelect2 = () => {
            $('.select2').select2({
                placeholder: "Pilih opsi Anda",
                tags: '<?php echo $tag; ?>' === 'true',
            });
            // $('.select2').on('change', function(e) {
            //     localStorage.setItem($(this).attr('name'), $(this).val());
            //     @this.set('data.' + $(this).attr('name'), $(this).val());
            // });
        }
        initSelect2();
    </script>
@endpush
{{-- @pushonce('scripts')
    <script>
        $(document).ready(function() {
            initSelect2();
        })
        initSelect2();

        document.addEventListener('livewire:load', function() {
            initSelect2();
        })
        document.addEventListener('LiveWireComponentRefreshed', function() {
            initSelect2()
        })
        Livewire.on('select2', () => {
            initSelect2();
        });
    </script>
@endpushonce --}}
