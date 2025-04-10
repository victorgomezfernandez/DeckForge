<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardModal extends Component
{
    public $card;
    /**
     * Create a new component instance.
     */
    public function __construct($card)
    {
        $this->card = $card;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.card-modal');
    }
}
