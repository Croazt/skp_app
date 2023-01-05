<div>
    {{-- @include('components.datatable-header') --}}
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

                <th class="text-center" style="width: 128px;">Actions</th>
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
                    <td>

                        <div class="tw-align-middle tw-flex tw-flex-row">
                            <button wire:click="showSkpGuru({{ $item->getKey() }})"
                                class="btn btn-xs btn-icon mr-1 btn-primary">
                                <i class="fa fa-eye icon-nm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            @if ($this->data->getCollection()->count() === 0)
                <tr>
                    <td colspan="999">
                        <div class="mt-6 mb-6 text-center">
                            There is no data available in this datatable.
                        </div>
                    </td>
                </tr>
            @endif
        </table>
    </div>

    <div class="card-footer text-center">
        <div class="mb-3">
            Showing {{ $this->data->firstItem() }} to {{ $this->data->lastItem() }} of {{ $this->data->total() }}
            entries
        </div>
        {!! $this->pagination !!}
    </div>
</div>
