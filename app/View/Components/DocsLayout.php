<?php

namespace App\View\Components;

use App\Support\Page;
use Illuminate\View\Component;
use Illuminate\View\View;

class DocsLayout extends Component
{
    public $title;
    
    public function __construct($title = null)
    {
        $this->title = $title;
    }
    public function render(): View
    {

        $index = (new Page(app()->getLocale(), 'docs'))->getSidebar();
        $title = $this->title;

        return view('layouts.docs', compact('index', 'title'));
    }
}
