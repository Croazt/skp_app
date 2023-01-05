<x-slot name="header_content">
    <h1>{{ __('Detail SKP') }}</h1>
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
            SKP
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
    <div class="tw-w-full tw-flex tw-justify-center tw-py-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            {{-- {{ $this->tab == "kinerja" ? 'true' : 'false' }} --}}
            <li class="nav-item">
                <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab"
                    aria-controls="detail" aria-selected="true">Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="kinerja-tab" data-toggle="tab" href="#kinerja" role="tab"
                    aria-controls="kinerja" aria-selected="false">Daftar Kinerja</a>
            </li>
            @canany(['Operator', 'Tim Angka Kredit', 'Pengelola Kinerja', 'Kepala Sekolah'])
                <li class="nav-item">
                    <a class="nav-link" id="skp-guru-tab" data-toggle="tab" href="#skp-guru" role="tab"
                        aria-controls="skp-guru" aria-selected="false">SKP Guru</a>
                </li>
            @endcanany
        </ul>
    </div>
    <div class="tab-content tw-w-full tw-shadow-inner" id="myTabContent">
        <div class="tab-pane fade show active tw-w-full" id="detail" role="tabpanel" aria-labelledby="home-tab">
            @include('livewire.skp.skp-detail')
        </div>
        <div class="tab-pane fade tw-w-full" id="kinerja" role="tabpanel" aria-labelledby="kinerja-tab">
            <livewire:skp.kinerja.kinerja-index :skp="$this->skp" :wire:key="$this->skp->id">
        </div>
        <div class="tab-pane fade tw-w-full" id="skp-guru" role="tabpanel" aria-labelledby="skp-guru-tab">
            <livewire:skp-guru.skp-guru-index :skp="$this->skp" :wire:key="$this->skp->id">
        </div>
    </div>
</div>
