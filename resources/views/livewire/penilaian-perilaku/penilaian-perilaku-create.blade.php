<x-slot name="header_content">
    <h1>{{ __('Buat Penilaian') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('penilaian-perilaku.index') }}">Penilaian Perilaku</a></div>
        <div class="breadcrumb-item"><a
                href="{{ route('penilaian-perilaku.guru.create', ['skp' => $skp->id, 'user' => $user->nip]) }}">{{ auth()->user()->nip }}</a>
        </div>
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
        <ul class="nav nav-tabs" id="myTab" role="tablist"  wire:ignore.self>
            @foreach ($aspekPerilaku as $item)
                <li class="nav-item"  wire:ignore.self>
                    <a wire:ignore.self class="nav-link @if ($loop->first) active @endif"
                        id="{{ strtolower(explode(' ', $item->nama)[0]) }}-tab" data-toggle="tab"
                        href="#{{ strtolower(explode(' ', $item->nama)[0]) }}" role="tab">
                        {{ $item->nama }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content tw-w-full" id="myTabContent" wire:ignore.self>
        @foreach ($aspekPerilaku as $key => $item)
            <div class="tab-pane fade @if ($loop->first) show active @endif tw-w-full"
                id="{{ strtolower(explode(' ', $item->nama)[0]) }}" role="tabpanel"
                aria-labelledby="{{ strtolower(explode(' ', $item->nama)[0]) }}-tab"  wire:ignore.self>
                <div  wire:ignore.self>
                    @include('livewire.penilaian-perilaku.penilaian-perilaku-create-table')
                    {{-- <livewire:penilaian-perilaku.penilaian-perilaku-create-table :skp="$skp" :user="$user"
                        :tableType="$item->nama" :wire:key="$item->nama"> --}}
                </div>
                <div class=" tw-w-full tw-text-center">
                    @if (!$loop->last)
                        @if (!$loop->first)
                            <button class="btn-nav btn btn-warning"
                                id="{{ strtolower(explode(' ', $aspekPerilaku[$key - 1]->nama)[0]) }}-tab"
                                href="#{{ strtolower(explode(' ', $aspekPerilaku[$key - 1]->nama)[0]) }}">Sebelumnya</button>
                        @else
                            <button class="btn btn-secondary">Batal</button>
                        @endif
                        <button class="btn-nav btn btn-primary"
                            id="{{ strtolower(explode(' ', $aspekPerilaku[$key + 1]->nama)[0]) }}-tab"
                            href="#{{ strtolower(explode(' ', $aspekPerilaku[$key + 1]->nama)[0]) }}">Selanjutnya</button>
                    @else
                        <button wire:click="save" class="btn btn-primary" type="button">Simpan</button>
                    @endif
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
