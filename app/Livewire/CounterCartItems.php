<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 


class CounterCartItems extends Component
{
    public $counter = 0;
    public function mount(){
        $this->addProducts();
    }
    public function render()
    {
        return view('livewire.counter-cart-items');
    }
    
    #[On('update-cart')] 
    public function addProducts(){
        $counterPrd = session('productCount', []);
        $this->counter = collect($counterPrd)->sum();
    }
}
