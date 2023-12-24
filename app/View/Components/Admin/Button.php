<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct
    (
        public string $module,
        public string $type,
        public string $action,
        public $data,
    )
    {
        $this->permission = $action.' '.$module;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $permission = $this->permission;
        $data = $this->data;
        return view('components.admin.button',
            [
                'permission' => $permission,
                'data' => $data
            ]
        );
    }
}
