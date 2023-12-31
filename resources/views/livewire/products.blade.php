<div>
    <div class="flex">
        <div>
        <div class="filtro-panel shadow-2xl">
            <!-- <div class="font-bold text-center py-2 flex items-center">
                <div class="font-bold text-center py-2 flex items-center">Ocultar Filtros</div>
                <span class="material-symbols-outlined cursor-pointer">
                    expand_less
                </span>
            </div> -->
            <div class="flex flex-col">
                <label for="filtro2" class="px-4 py-4" style="font-family: 'Quicksand', sans-serif;">
                    Tipologies
                </label>
                <hr>
                <label class="px-4 py-4" style="font-family: 'Quicksand', sans-serif;">
                    <input type="checkbox" class="rounded-full w-6 h-6 m-2">Todos
                </label>
                @if(count($categories))
                    @foreach($categories as $cat)
                    <label class="px-4 py-4" style="font-family: 'Quicksand', sans-serif;">
                        <input wire:click="toggleSelectedCheckbox({{$cat->id}})" wire:model="selectedCat.{{$cat->id}}" type="checkbox" id="filtro{{$cat->id}}" class="rounded-full w-6 h-6 m-2">{{$cat->name}}
                    </label>
                    @endforeach
                @endif

                
                <label for="filtro2" class="px-4 py-4" style="font-family: 'Quicksand', sans-serif;">
                    Pricing
                </label>
                <hr>

                <div class="price-range mt-10 mb-10" id="price-range">
                    <div class="range-label-left">0€</div>
                    <div class="range-handle" id="range-handle"></div>
                    <div class="range-label-right">500€</div>
                </div>
            </div>
        </div>

        </div>
        <div>
            @if(count($selectedCategory)>0)
            <div class="mr-4 ml-4 flex gap-4">
                @foreach($selectedCategory as $key=>$value)
                    @php
                        $cate = App\Models\Category::find($key);
                    @endphp
                    <div class="flex items-center mt-5 mb-5 bg-blue-800 shadow-xl uppercase font-bold text-white px-2 py-1">
                        <p>{{ $cate->name }}</p>
                        <span class="cursor-pointer ml-4 material-symbols-outlined" wire:click="unsetCategoryFilter({{$key}})">
                            backspace
                        </span>
                    </div>
                @endforeach
            </div>
            @endif
            @if(count($products)>0)
            <div class="flex flex-wrap justify-center gap-5 p-6">
                @foreach($products as $prod)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden min-w-[300px] max-w-[300px]">
                    <a href="{{route('products',['id'=>$prod->id])}}">
                        <div class="p-3 bg-cover bg-center h-64 cursor-pointer" style="background-image:url('{{$prod->image_path}}')">
                            <span class=" ml-2 bg-blue-100 text-blue-800 font-bold mr-2 px-2.5 py-0.5 text-sm rounded dark:bg-blue-900 dark:text-blue-300">{{$prod->price}}€</span>
                        </div>
                    </a>
                    <div class="p-4 flex flex-col">
                        <div class="h-[14rem]">
                        <h2 class="text-xl font-semibold text-gray-800" style="font-family: 'Oswald', sans-serif">{{$prod->title}}</h2>
                        <p class="text-gray-600">{{$prod->description}}</p>
                        <!-- <p class="text-gray-800 font-semibold mt-2">{{$prod->price}}€</p> -->
                        </div>
                        <div class="h-[2.5rem] mt-2 flex items-center {{ count($itemsToShop) > 0 && isset(array_count_values($itemsToShop)[$prod->id]) ? 'justify-between' : 'justify-end' }}">
                            <!-- <button class="bg-blue-300 hover:bg-blue-500 text-white px-2 rounded-lg"> -->
                                @if(in_array($prod->id, $itemsToShop))
                                    <span class="shop-icon material-symbols-outlined text-blue-400 hover:text-blue-700 cursor-pointer" wire:click="removeFromShopping({{$prod->id}})">
                                        remove_shopping_cart
                                    </span>
                                @endif
                                @if(isset(session('productCount', [])[$prod->id]))
                                <div class="flex items-center">
                                    @php
                                        $count = session('productCount', [])[$prod->id] ?? [];
                                        $count = is_array($count) ? 0 : $count;
                                    @endphp
                                    <span class="mr-2">({{$count}})</span>
                                    <span class="shop-icon material-symbols-outlined text-blue-400 hover:text-blue-700 cursor-pointer" wire:click="addToShopping({{$prod->id}})">
                                        shopping_cart
                                    </span>
                                </div>
                                @else
                                    <span class="shop-icon material-symbols-outlined text-blue-400 hover:text-blue-700 cursor-pointer" wire:click="addToShopping({{$prod->id}})">
                                        shopping_cart
                                    </span>
                                @endif
                            <!-- </button> -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <script>
        const priceRange = document.getElementById("price-range");
        const rangeHandle = document.getElementById("range-handle");

        priceRange.addEventListener("click", (event) => {
            const rangeRect = priceRange.getBoundingClientRect();
            const clickX = event.clientX - rangeRect.left;
            const percent = (clickX / rangeRect.width) * 100;

            rangeHandle.style.left = percent + "%";
        });

        document.addEventListener('livewire:initialized', () => {
            @this.on('product-added', (event) => {
                var message = event[0].message;
                toastr.success(message);
            });
        });

        document.addEventListener('livewire:initialized', () => {
            @this.on('product-removed', (event) => {
                var message = event[0].message;
                toastr.success(message);
                // @this.dispatch('update-cart'); 
            });
        });

        // document.addEventListener('livewire:initialized', () => {
        //     @this.on('update-card', (event) => {

        //     });
        // });



        </script>
</div>
