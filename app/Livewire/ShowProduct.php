<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ShowProduct extends Component
{
    public $product, $selected_img, $showIcon = false; 

    public function mount($id){
        $this->product = Product::find($id);
    }
    public function render()
    {
        return view('livewire.show-product');
    }
    public function addProduct(){
        //$this->addProducts();
        //$this->itemsToShop[] = $this->product->id;
        if (!session()->has('cart')) {
            session(['cart' => []]);
        }
        if (!session()->has('productCount-'.$this->product->id)) {
            session(['productCount-'.$this->product->id => []]);
        }

        $cart = session('cart', []);
        $productCount = session('productCount', []);

        if (in_array($this->product->id, $cart)) {
            if (isset($productCount[$this->product->id])) {
                $productCount[$this->product->id] = $productCount[$this->product->id]+1;
            } else {
                $productCount[$this->product->id] = 1;
            }
        } else {
            $cart[] = $this->product->id;
            $productCount[$this->product->id] = 1;
        }
        session(['cart' => $cart, 'productCount' => $productCount]);
        $this->showIcon = true;
        //$this->dispatch('product-added', ['message' => 'Producto añadido con éxito.']);
        $this->dispatch('update-cart')->to(CounterCartItems::class);
        $this->dispatch('smiley-face');


    }
}
