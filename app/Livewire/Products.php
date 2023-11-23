<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\ProductCategory;

class Products extends Component
{
    public $categories =[], $itemsToShop = [], $selectedCat = [], $selectedCategory =[];
    use WithPagination;

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
    public function addToShopping($id){
        $this->itemsToShop[] = $id;
        $this->dispatch('product-added', ['message' => 'Producto añadido con éxito.', 'id'=>$id]);
        //array_push($this->itemsToShop, $id);
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
