<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formMde extends Component
{
    private string $name;

    private string $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, string $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string|Closure
    {
        return view('components.forms.mde');
    }
}
