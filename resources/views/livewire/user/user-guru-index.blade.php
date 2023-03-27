{{-- .../components/datatable-header.blade.php --}}
<x-slot name="header_content">
    <h1>{{ __('Daftar Pengguna') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('users.index') }}">Pengguna</a></div>
        <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Daftar</a></div>
    </div>
</x-slot>

<div>
    <div class="tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg">
        @include('components.datatable-header')
        @include('livewire.partials.alert')
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable-sortable table-md tw-border-1">
                <tr>
                    <th style="width: 60px;">
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" class="custom-control-input" id="checkbox-all" wire:model="selectAllRows"
                                wire:click="toggleSelectAllRows">
                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                        </div>
                    </th>

                    @foreach ($this->columns() as $column)
                        {!! $column->renderHeader($sortColumn, $sortDirection) !!}
                    @endforeach

                </tr>


                @foreach ($this->data->getCollection() as $item)
                    <tr>
                        <td>
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" class="custom-control-input" id="checkbox-{{ $item->getKey() }}"
                                    wire:model="selectedRows.{{ $item->getKey() }}" type="checkbox"
                                    name="selectedRows_{{ $item->getKey() }}">
                                <label for="checkbox-{{ $item->getKey() }}" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        @foreach ($this->columns() as $column)
                            {!! $column->renderCell($item) !!}
                        @endforeach
                    </tr>
                @endforeach
                @if ($this->data->getCollection()->count() === 0)
                    <tr>
                        <td colspan="999">
                            <div class="mt-6 mb-6 text-center">
                                Tidak ada data yang tersedia dalam tabel ini.
                            </div>
                        </td>
                    </tr>
                @endif
            </table>
        </div>

        <div class="card-footer text-center">
            <div class="mb-3">
                Menampilkan {{ $this->data->firstItem() }} hingga {{ $this->data->lastItem() }} dari {{ $this->data->total() }}
                entri
            </div>
            {!! $this->pagination !!}
        </div>
    </div>
</div>
