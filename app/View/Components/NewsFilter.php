<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewsFilter extends Component
{
    public $route;
    public $categories;
    public $filter;
    public $filterCategories;
    /**
     * Create a new component instance.
     */
    public function __construct($route, $categories = [], $filter, $filterCategories = [])
    {
        $this->route = $route;
        $this->categories = $categories;
        $this->filter = $filter;
        $this->filterCategories = $filterCategories;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news-filter');
    }
}
