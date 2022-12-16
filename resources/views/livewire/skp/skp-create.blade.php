<x-slot name="header_content">
    <h1>{{ __('Buat SKP') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('skp.index') }}">SKP</a></div>
        <div class="breadcrumb-item"><a href="{{ route('skp.create') }}">Tambah</a></div>
    </div>
</x-slot>

@include('livewire.skp.skp-form')

@push('scripts')
    <script>
        $('.daterange-cus').val('');
    </script>
@endpush
