<x-slot name="header_content">
    <h1>{{ __('Detail SKP') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('skp.index') }}">SKP</a></div>
        <div class="breadcrumb-item"><a href="{{ route('skp.show',['skp' => $this->skp]) }}">Detail</a></div>
        <div class="breadcrumb-item"><a href="{{ route('skp.show',['skp' => $this->skp]) }}">{{ $this->skp->getKey() }}</a></div>
    </div>
</x-slot>
@push('styles')
    <style>
        .nav-item .nav-link.active{
            color: var(--primary) !important;
            font-weight: 900;
        }
    </style>
@endpush


<div class="tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg">
    @include('livewire.partials.alert')
    <div class="tw-px-6 tw-pt-8 tw-pb-4">
        <h1 class="tw-text-center h5 tw-font-black">
            SKP
        </h1>
        <h1 class="tw-text-center h5 tw-font-bold">
            {{ $this->skp->periode_awal . ' s.d. ' . $this->skp->periode_akhir }}
        </h1>
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
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">SKP Guru</a>
            </li>
        </ul>
    </div>
    <div class="tab-content tw-w-full tw-shadow-inner" id="myTabContent">
        <div class="tab-pane fade show active tw-w-full" id="detail" role="tabpanel" aria-labelledby="home-tab">
            @include('livewire.skp.skp-detail')
        </div>
        <div class="tab-pane fade tw-w-full" id="kinerja" role="tabpanel" aria-labelledby="kinerja-tab">
            <livewire:skp.kinerja.kinerja-index :skp="$this->skp" :wire:key="$this->skp->id">
        </div>
    </div>
</div>
