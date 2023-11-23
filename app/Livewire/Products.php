<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\ProductCategory;

use Livewire\Attributes\On; 

class Products extends Component
{
    public $categories =[], $itemsToShop = [], $selectedCat = [], $selectedCategory =[];
    use WithPagination;

    public function mount(){

    }

    public function render()
    {        

        $products = Product::paginate(12);
        if($this->selectedCategory && count($this->selectedCategory)>0){
            $registers = ProductCategory::whereIn('category_id', array_keys($this->selectedCategory))->get()->toArray();
            $products = Product::where('id',array_column($registers, 'product_id'))->paginate(12);
        }

        $this->categories = Category::all();
        return view('livewire.products',[
            'products'=>$products,
        ]);
    }
    
    #[On('update-cart-from-single')] 
    public function addToShopping($id){
        $this->itemsToShop[] = $id;
        if (!session()->has('cart')) {
            session(['cart' => []]);
        }
        if (!session()->has('productCount-'.$id)) {
            session(['productCount-'.$id => []]);
        }

        $cart = session('cart', []);
        $productCount = session('productCount', []);

        if (in_array($id, $cart)) {
            if (isset($productCount[$id])) {
                $productCount[$id] = $productCount[$id]+1;
            } else {
                $productCount[$id] = 1;
            }
        } else {
            $cart[] = $id;
            $productCount[$id] = 1;
        }
        session(['cart' => $cart, 'productCount' => $productCount]);


        $this->dispatch('product-added', ['message' => 'Producto añadido con éxito.']);
        $this->dispatch('update-cart')->to(CounterCartItems::class);

    }

    public function removeFromShopping($id){
       $index = array_search($id, $this->itemsToShop);
       foreach ($this->itemsToShop as $key => $value) {
            if ($value == $id) {
                unset($this->itemsToShop[$key]);
            }
        }
        $this->dispatch('product-removed', ['message' => 'Productos eliminados con éxito.', 'id'=>$id]);
    }
    public function toggleSelectedCheckbox($id){
        if($this->selectedCat[$id] == true){
            $this->selectedCategory[$id] = true;
        }else{
            $this->selectedCategory[$id] = false;
            unset($this->selectedCategory[$id]);
        }
    }
}
