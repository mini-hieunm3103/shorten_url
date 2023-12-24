<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cannot extends Component
{
    /**
     * Create a new component instance.
     */
    public $permission;
    public function __construct($permission)
    {
        $this->permission = $permission;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cannot');
    }
}
