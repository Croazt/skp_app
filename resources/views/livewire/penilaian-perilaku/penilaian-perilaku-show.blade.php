<x-slot name="header_content">
    <h1>{{ __('Penilaian Perilaku SKP') }}</h1>
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
    @include('livewire.partials.alert')
    <div class="tw-px-6 tw-pt-8 tw-pb-4 tw-text-center">
        <h1 class="h5 tw-font-black">
            PENILAIAN PERILAKU
        </h1>
        <h1 class="h5 tw-font-bold">
            {{ $this->skp->periode_awal . ' s.d. ' . $this->skp->periode_akhir }}
        </h1>
        @can('Guru')
            @php
                $showRencanakan =
                    !$this->skp
                        ->skpGurus()
                        ->where('user_nip', auth()->user()->nip)
                        ->first() instanceof \App\Models\SkpGuru;
            @endphp
            @if ($showRencanakan)
                <button class="tw-mx-auto btn btn-xs btn-icon mr-1 btn-warning" wire:click="createSkpGuru()">
                    <span class="fa fa-pen icon-nm tw-mr-2"></span>Rencanakan SKP
                </button>
            @else
                <button class="tw-mx-auto btn btn-xs btn-icon mr-1 btn-primary" wire:click="showMySkp()">
                    <span class="fa fa-eye icon-nm tw-mr-2"></span>Lihat SKP Saya
                </button>
            @endif
        @endcan
    </div>
    <livewire:penilaian-perilaku.penilaian-perilaku-guru-index :skp="$this->skp" :wire:key="$this->skp->id">
</div>
