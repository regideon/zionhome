<?php

namespace App\Livewire\Community;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.community')]
class Home extends Component
{
    public function render(): \Illuminate\View\View
    {
        return view('livewire.community.home');
    }
}
