<x-slot name="header_content">
    <h1>{{ __('Penilaian Perilaku') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('skp.index') }}">SKP</a></div>
        <div class="breadcrumb-item"><a href="{{ route('skp.show', ['skp' => $this->skp]) }}">Detail</a></div>
        <div class="breadcrumb-item"><a
                href="{{ route('skp.show', ['skp' => $this->skp]) }}">{{ $this->skp->getKey() }}</a></div>
    </div>
</x-slot>
@push('styles')
    <style>
        .nav-item .nav-link.active {
            color: var(--primary) !important;
            font-weight: 900;
        }
    </style>
@endpush


<div class="tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg">
    <div class="tw-px-6 tw-pt-8 tw-pb-4 tw-text-center">
        <h1 class="h5 tw-font-black">
            PENILAIAN PERILAKU GURU
        </h1>
        <h1 class="h5 tw-font-bold">
            {{ format_periode($this->skp->periode_awal, $this->skp->periode_akhir) }}
        </h1>
    </div>
    <livewire:penilaian-perilaku.penilaian-perilaku-guru-index :skp="$this->skp" :wire:key="$this->skp->id">
</div>
