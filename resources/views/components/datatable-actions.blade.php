<td>
    <div class="tw-align-middle tw-flex tw-flex-row">
        <button wire:click="performAction('show', '{{ $item->getKey() }}')" class="btn btn-xs btn-icon mr-1 btn-primary">
            <i class="fa fa-eye icon-nm"></i>
        </button>

        <button wire:click="performAction('edit', '{{ $item->getKey() }}')" class="btn btn-xs btn-icon mr-1 btn-warning">
            <i class="fa fa-pen icon-nm"></i>
        </button>

        <button class="btn btn-xs btn-icon mr-1 btn-danger dt-delete" data-key="{{ $item->getKey() }}">
            <i class="fa fa-trash icon-nm"></i>
        </button>
    </div>
</td>
