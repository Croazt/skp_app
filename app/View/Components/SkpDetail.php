<?php

namespace App\View\Components;

use App\Models\PejabatPenilai;
use App\Models\User;
use Illuminate\View\Component;

class SkpDetail extends Component
{
    public string $title;
    public PejabatPenilai|User $data;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, PejabatPenilai|User  $data)
    {
        $this->title = $title;
        $this->data = $data;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.skp.detail', ['data' => $this->data]);
    }
}
