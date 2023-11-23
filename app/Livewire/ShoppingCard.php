<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\On; 

class ShoppingCard extends Component
{

    // public function mount(){
    //     dd('si');
    // }
    public function render()
    {
        return view('livewire.shopping-card');
    }

    // #[On('update-card')] 
    // public function addProduct($id){


    // }
}
