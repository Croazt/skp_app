@if ($paginator->hasPages())
    @php
        $windows = \Illuminate\Pagination\UrlWindow::make($paginator);
        $slider = null;
        
        foreach ($windows as $window) {
            if (is_array($window) && (!is_array($slider) || count($window) > count($slider))) {
                $slider = $window;
            }
        }
    @endphp
    <nav class="d-inline-block">
        <ul class="pagination mb-0">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <button class="page-link" wire:click="goTo(1)"><i class="fas fa-chevron-left"></i><i
                            class="fas fa-chevron-left"></i></button>
                </li>
                <li class="page-item disabled">
                    <button class="page-link" href="#"><i class="fas fa-chevron-left"></i></button>
                </li>
            @else
                <li class="page-item">
                    <button class="page-link" wire:click="goTo(1)"><i class="fas fa-chevron-left"></i><i
                            class="fas fa-chevron-left"></i></button>
                </li>
                <li class="page-item">
                    <button class="page-link" wire:click="goTo({{ $paginator->currentPage() - 1 }})"><i
                            class="fas fa-chevron-left"></i></button>
                </li>
            @endif

            @foreach ($slider as $page => $url)
                @if ($page === $paginator->currentPage())
                    <li class="page-item active"><button class="page-link" href="#">{{ $page }}<span
                                class="sr-only">(current)</span></button></li>
                @else
                    <li class="page-item">
                        <button class="page-link cursor-pointer" href="#"
                            wire:click.prevent="goTo({{ $page }})">{{ $page }}</button>
                    </li>
                @endif
            @endforeach
            @if (!$paginator->hasMorePages())
                <li class="page-item disabled">
                    <button class="page-link" href="#"><i class="fas fa-chevron-right"></i></button>
                </li>
                <li class="page-item disabled">
                    <button class="page-link" wire:click="goTo({{ $paginator->lastPage() }})"><i
                            class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></button>
                </li>
            @else
                <li class="page-item">
                    <button class="page-link" wire:click="goTo({{ $paginator->currentPage() + 1 }})"><i
                            class="fas fa-chevron-right"></i></button>
                </li>
                <li class="page-item">
                    <button class="page-link" wire:click="goTo({{ $paginator->lastPage() }})"><i
                            class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></button>
                </li>
            @endif
        </ul>
    </nav>
    {{-- 

    @if ($paginator->hasMorePages())
        <button wire:click.prevent="goTo({{ $paginator->currentPage() + 1 }})" type="button"
            class="btn btn-icon btn-sm border-0 btn-light mr-2">
            <i class="ki ki-bold-arrow-next icon-xs"></i>
        </button>
        <button wire:click.prevent="goTo({{ $paginator->lastPage() }})" type="button"
            class="btn btn-icon btn-sm border-0 btn-light mr-2">
            <i class="ki ki-bold-double-arrow-next icon-xs"></i>
        </button>
    @else
        <button type="button" class="btn btn-icon btn-sm border-0 btn-light dt-pagination-btn-disabled mr-2">
            <i class="ki ki-bold-arrow-next icon-xs"></i>
        </button>
        <button type="button" class="btn btn-icon btn-sm border-0 btn-light dt-pagination-btn-disabled mr-2">
            <i class="ki ki-bold-double-arrow-next icon-xs"></i>
        </button>
    @endif
    </div>
    <div class="d-flex flex-wrap dt-pagination-container">
        @if ($paginator->onFirstPage())
            <button wire:click.prevent="goTo(1)" type="button"
                class="btn btn-icon btn-sm border-0 btn-light dt-pagination-btn-disabled mr-2">
                <i class="ki ki-bold-double-arrow-back icon-xs"></i>
            </button>
            <button wire:click.prevent="goTo({{ $paginator->currentPage() - 1 }})" type="button"
                class="btn btn-icon btn-sm border-0 btn-light dt-pagination-btn-disabled mr-2">
                <i class="ki ki-bold-arrow-back icon-xs"></i>
            </button>
        @else
            <button wire:click.prevent="goTo(1)" type="button" class="btn btn-icon btn-sm border-0 btn-light mr-2">
                <i class="ki ki-bold-double-arrow-back icon-xs"></i>
            </button>
            <button wire:click.prevent="goTo({{ $paginator->currentPage() - 1 }})" type="button"
                class="btn btn-icon btn-sm border-0 btn-light mr-2">
                <i class="ki ki-bold-arrow-back icon-xs"></i>
            </button>
        @endif

        @php
            $windows = \Illuminate\Pagination\UrlWindow::make($paginator);
            $slider = null;
            
            foreach ($windows as $window) {
                if (is_array($window) && (!is_array($slider) || count($window) > count($slider))) {
                    $slider = $window;
                }
            }
        @endphp

        @foreach ($slider as $page => $url)
            @if ($page === $paginator->currentPage())
                <button wire:click.prevent="goTo({{ $page }})" type="button"
                    class="btn btn-icon btn-sm border-0 btn-light btn-hover-primary active mr-2">
                    {{ $page }}
                </button>
            @else
                <button wire:click.prevent="goTo({{ $page }})" type="button"
                    class="btn btn-icon btn-sm border-0 btn-light mr-2">
                    {{ $page }}
                </button>
            @endif
        @endforeach


        @if ($paginator->hasMorePages())
            <button wire:click.prevent="goTo({{ $paginator->currentPage() + 1 }})" type="button"
                class="btn btn-icon btn-sm border-0 btn-light mr-2">
                <i class="ki ki-bold-arrow-next icon-xs"></i>
            </button>
            <button wire:click.prevent="goTo({{ $paginator->lastPage() }})" type="button"
                class="btn btn-icon btn-sm border-0 btn-light mr-2">
                <i class="ki ki-bold-double-arrow-next icon-xs"></i>
            </button>
        @else
            <button type="button" class="btn btn-icon btn-sm border-0 btn-light dt-pagination-btn-disabled mr-2">
                <i class="ki ki-bold-arrow-next icon-xs"></i>
            </button>
            <button type="button" class="btn btn-icon btn-sm border-0 btn-light dt-pagination-btn-disabled mr-2">
                <i class="ki ki-bold-double-arrow-next icon-xs"></i>
            </button>
        @endif
    </div> --}}
@endif

<script>
    document.addEventListener('livewire:load', function() {
        $('.dt-delete').click(function(event) {
            if (confirm('Do you really wish to continue?')) {
                let key = $(this).attr('data-key');
                @this.delete(key);
            } else {
                event.preventDefault();
                event.stopPropagation();
            }
        });
        $('.dt-delete-selected').click(function(event) {
            if (confirm('Do you really wish to continue?')) {
                @this.deleteSelected();
            } else {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    })
</script>
