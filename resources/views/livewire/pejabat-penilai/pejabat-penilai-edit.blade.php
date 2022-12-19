<x-slot name="header_content">
    <h1>{{ __('Ubah Pejabat Penilai') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('pejabat-penilai.index') }}">Pejabat Penilai</a></div>
        <div class="breadcrumb-item"><a href="{{ route('pejabat-penilai.edit', ['pejabatPenilai'=>$this->pejabatPenilai]) }}">Ubah</a></div>
        <div class="breadcrumb-item"><a href="{{ route('pejabat-penilai.edit', ['pejabatPenilai'=>$this->pejabatPenilai]) }}">{{ $this->pejabatPenilai->getKey() }}</a></div>
    </div>
</x-slot>

@include('livewire.pejabat-penilai.pejabat-penilai-form')