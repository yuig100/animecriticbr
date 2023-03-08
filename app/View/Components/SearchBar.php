<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SearchBar extends Component
{
    public $placeholder;

    public function __construct($placeholder = 'Search')
    {
        $this->placeholder = $placeholder;
    }

    public function render(): View
    {
        return view('components.search-bar');
    }
}
