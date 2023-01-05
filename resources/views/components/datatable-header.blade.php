    <div class="tw-p-4">
        <div class="tw-flex pb-4 -ml-3">
            @can('Operator')
                <a href={{ route($this->getBaseRouteName() . 'create') }} class="-ml- btn btn-primary shadow-none">
                    <span class="fas fa-plus"></span> Buat
                </a>
            @endcan
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
            <a href="#" class="ml-2 btn btn-success shadow-none">
                <span class="fas fa-filter"></span>
            </a>
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
                <input wire:model.debounce.700ms="search" class="form-control" type="text" placeholder="Search...">
            </div>
        </div>
    </div>
