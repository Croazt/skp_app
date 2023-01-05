<x-slot name="header_content">
    <h1>{{ __('Buat Penilaian') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('skp.index') }}">SKP</a></div>
        <div class="breadcrumb-item"><a href="{{ route('skp.create') }}">Tambah</a></div>
    </div>
</x-slot>

<div class="tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg">
    <style>
        .nav-item .nav-link.active {
            color: var(--primary) !important;
            font-weight: 900;
        }
    </style>
    <div class="tw-w-full tw-flex tw-justify-center tw-py-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach ($aspekPerilaku as $item)
                <li class="nav-item">
                    <a class="nav-link @if ($loop->first) active @endif"
                        id="{{ strtolower(explode(' ', $item->nama)[0]) }}-tab" data-toggle="tab"
                        href="#{{ strtolower(explode(' ', $item->nama)[0]) }}" role="tab">
                        {{ $item->nama }}
                    </a>
                </li>
            @endforeach
            <li wire:click='cetak' class="nav-item tw-cursor-pointer tw-text-center tw-text-white bg-primary">
                <p class="nav-link  tw-text-white"><span class="fas fa-print"></span>&nbsp;Cetak</p>
            </li>
        </ul>
    </div>
    <div class="tab-content tw-w-full" id="myTabContent">
        @foreach ($aspekPerilaku as $key => $item)
            <div class="tab-pane fade @if ($loop->first) show active @endif tw-w-full"
                id="{{ strtolower(explode(' ', $item->nama)[0]) }}" role="tabpanel"
                aria-labelledby="{{ strtolower(explode(' ', $item->nama)[0]) }}-tab">
                <div>
                    <livewire:penilaian-perilaku.penilaian-perilaku-guru-show-table :skp="$skp" :user="$user"
                        :tableType="$item->nama">
                </div>
                <div class=" tw-w-full tw-text-center tw-flex tw-justify-between px-5 tw-mb-5">
                    <div>
                        <button wire:click="back" class="btn btn-secondary">Kembali</button>
                    </div>
                    <div>
                        @if (!$loop->first)
                            <button class="btn-nav btn btn-warning"
                                id="{{ strtolower(explode(' ', $aspekPerilaku[$key - 1]->nama)[0]) }}-tab"
                                href="#{{ strtolower(explode(' ', $aspekPerilaku[$key - 1]->nama)[0]) }}">Sebelumnya</button>
                        @endif
                        @if (!$loop->last)
                            <button class="btn-nav btn btn-primary"
                                id="{{ strtolower(explode(' ', $aspekPerilaku[$key + 1]->nama)[0]) }}-tab"
                                href="#{{ strtolower(explode(' ', $aspekPerilaku[$key + 1]->nama)[0]) }}">Selanjutnya</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @include('livewire.partials.change_script')

    <script>
        $(document).ready(function() {
            $(".btn-nav").click(function() {
                $('.nav a[href="' + $(this).attr("href") + '"]').tab('show');
            });
        });
    </script>
</div>
