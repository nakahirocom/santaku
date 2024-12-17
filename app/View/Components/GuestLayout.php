<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;

class GuestLayout extends Component
{
    public function render()
    {
        return view('layouts.guest');
    }
}
