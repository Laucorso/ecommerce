<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ShowProduct extends Component
{
    public $product, $selected_img; 

    public function mount($id){
        $this->product = Product::find($id);
    }
    public function render()
    {
        return view('livewire.show-product');
    }
}
