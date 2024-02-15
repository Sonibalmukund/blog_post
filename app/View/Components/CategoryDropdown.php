<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryDropdown extends Component
{

    public function render(): View|Closure|string
    {
        return view('components.category-dropdown',[
            'categories'=>\App\Models\Category::all(),
            'currentCategory'=>Category::firstwhere('slug',\request('category'))

        ]);
    }
}
