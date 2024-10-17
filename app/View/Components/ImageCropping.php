<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImageCropping extends Component
{

    public string $route;
    public string $img;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route="",$img="")
    {
        $this->route = $route;
        $this->img = $img;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.image-cropping');
    }
}
