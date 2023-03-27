<div>
    <div class="tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg">
        <div class="tw-p-4">
            <div class="tw-flex pb-4 -ml-3">
                <div>
                    <button class="btn ml-2 btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-eye"></i> Filter Kolom
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg tw-py-8 tw-px-8 tw-text-xs tw-text-gray-500">
                        <div class="row">
                            @foreach ($this->columns() as $index => $column)
                                {!! $column->renderVisibilityOption((int) $index) !!}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col form-inline">
                    Per Page: &nbsp;
                    <select wire:model="perPage" class="form-control col-2">
                        <option>10</option>
                        <option>15</option>
                        <option>25</option>
                    </select>
                </div>

                <div class="col">
                    <input wire:model.debounce.700ms="search" class="form-control" type="text"
                        placeholder="Search...">
                </div>
            </div>
        </div>

        @include('livewire.partials.alert')
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable-sortable table-md tw-border-1">
                <tr>
                    @foreach ($this->columns() as $column)
                        {!! $column->renderHeader($sortColumn, $sortDirection) !!}
                    @endforeach

                    <th class="text-center" style="width: 128px;">Aksi</th>
                </tr>


                @foreach ($this->data->getCollection() as $item)
                    @foreach ($this->columns() as $column)
                        {!! $column->renderCell($item) !!}
                    @endforeach
                    <td>
                        <button wire:click="showSkpGuru('{{ $item->getKey() }}')"
                            class="btn btn-xs btn-icon mr-1 btn-primary">
                            <i class="fa fa-eye icon-nm"></i>
                        </button>
                    </td>
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
                Menampilkan {{ $this->data->firstItem() }} hingga {{ $this->data->lastItem() }} dari
                {{ $this->data->total() }}
                entri
            </div>
            {!! $this->pagination !!}
        </div>
    </div>
</div>
