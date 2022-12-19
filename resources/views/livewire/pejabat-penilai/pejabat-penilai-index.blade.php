{{-- .../components/datatable-header.blade.php --}}
<x-slot name="header_content">
    <h1>{{ __('Daftar Pejabat Penilai') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('pejabat-penilai.index') }}">Pejabat Penilai</a></div>
        <div class="breadcrumb-item"><a href="{{ route('pejabat-penilai.index') }}">Daftar</a></div>
    </div>
</x-slot>

@include('livewire.partials.index')