<?php

namespace App\View\Components;

use Illuminate\View\Component;


class videocard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $message;
    public $tag;
    public function __construct($message = null, $tag = null)

    {
        $this->message = $message;
        $this->tag = $tag;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.videocard');
    }
}
