<x-slot name="header_content">
    <h1>{{ __('Ubah Penilaian Perilaku') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('penilaian-perilaku.index') }}">Penilaian Perilaku</a></div>
        <div class="breadcrumb-item"><a href="{{ route('penilaian-perilaku.edit',['skp' => $this->skp]) }}">Ubah</a></div>
        <div class="breadcrumb-item"><a href="{{ route('penilaian-perilaku.edit',['skp' => $this->skp]) }}">{{ $this->skp->getKey() }}</a></div>
    </div>
</x-slot>

@include('livewire.skp.skp-form')