{{-- .../components/datatable-header.blade.php --}}
<x-slot name="header_content">
    <h1>{{ __('Daftar Periode Prestasi Kerja') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('penilaian-perilaku.index') }}">Penilaian Perilaku</a></div>
        <div class="breadcrumb-item"><a
                href="{{  route('penilaian-perilaku.index') }}">Daftar</a>
        </div>
    </div>
</x-slot>

@include('livewire.partials.index')