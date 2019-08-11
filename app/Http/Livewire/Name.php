<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Arr;
use Facades\App\NameGenerator as Names;

class Name extends Component
{
    public $name;
    public $rotation;

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
        $this->rotation = Arr::random(['-3', '-2', '-1', '0', '1', '2', '3']);
    }
}
