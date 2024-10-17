<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CropperModal extends Component
{

    public string $id = "";
    public string $title = "";
    public string $subTitle = "";
    public string $imageId = "";
    public string $cropButtonText = "";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id = "modal",
        $title = "Processing your image",
        $subTitle = "Please Select the Desired Area of the Image !",
        $imageId = "image",
        $cropButtonText = "Crop & Save",
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->subTitle = $subTitle;
        $this->imageId = $imageId;
        $this->cropButtonText = $cropButtonText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cropper-modal');
    }
}
