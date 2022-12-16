<?php

namespace App\View\Components;

use App\Models\Skp;
use Illuminate\View\Component;

class SkpHead extends Component
{
    public string $perencanaan;
    public string $penilaian;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $perencanaan, string $penilaian)
    {
        $this->perencanaan = $perencanaan;
        $this->penilaian = $penilaian;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.skp.head');
    }
}
