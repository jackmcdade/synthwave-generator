<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Facades\App\NameGenerator as Names;

class Name extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.name');
    }

    public function mount()
    {
        $this->generate();
    }

    public function generate()
    {
        $this->name = Names::generate();
    }
}
