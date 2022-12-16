<x-slot name="header_content">
    <h1>{{ __('Ubah SKP') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('skp.index') }}">SKP</a></div>
        <div class="breadcrumb-item"><a href="{{ route('skp.edit',['skp' => $this->skp]) }}">Ubah</a></div>
        <div class="breadcrumb-item"><a href="{{ route('skp.edit',['skp' => $this->skp]) }}">{{ $this->skp->getKey() }}</a></div>
    </div>
</x-slot>

@include('livewire.skp.skp-form')