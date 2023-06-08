<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formTextarea extends Component
{
    private string $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string|Closure
    {
        return view('components.forms.textarea');
    }
}
