<?php

namespace App\Http\Livewire\Concerns;

use App\Http\Livewire\Concerns\ComponentDataRepository;
use App\Http\Livewire\Concerns\Extensions\HasSelectedRows;
use App\Http\Livewire\Concerns\Extensions\ManageColumnVisibility;
use App\Http\Livewire\Concerns\Extensions\PerformDatatableActions;
use App\Http\Livewire\Concerns\Extensions\ProcessingPaginatedData;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

abstract class DatatableComponent extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use HasSelectedRows;
    use ManageColumnVisibility;
    use PerformDatatableActions;
    use ProcessingPaginatedData;
    // use ResolveCurrentAdmin;


    /**
     * Handle the `boot` lifecycle event hook.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException|\ErrorException
     */
    public function boot(): void
    {
        // $this->confirmAuthorization();

        app(ComponentDataRepository::class)->load($this);

        // Initialize column visibilities
        $this->columns();

        // Initialize datatable's data
        $this->refresh();
    }

    /**
     * Confirm Admin authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $table = $this->newQuery()->getModel()->getTable();
        $permission = 'cms.'.$table.'.viewAny';

        if (!$this->getCurrentAdminProperty()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    /**
     * Defines the base route name for current datatable component.
     *
     * @return string
     */
    abstract public function getBaseRouteName(): string;

    /**
     * Retrieve the current livewire component's unique id.
     *
     * @return string
     */
    public function getComponentId(): string
    {
        return (string) $this->id;
    }

    /**
     * Handle the `updated` lifecycle event hook.
     */
    public function updated(): void
    {
        $this->currentPage = 1;
        $this->refresh();
    }
}
