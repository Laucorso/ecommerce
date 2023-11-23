<div>
    <div class="flex gap-4 p-4">
        {{-- Columna izquierda con la imagen principal --}}
        <div class="w-3/5">
            <div class="w-full relative overflow-hidden">
                @if($selected_img == null)
                <a href="{{ $product->image_path }}" data-lightbox="product-image">
                    <img src="{{ $product->image_path }}" alt="Imagen principal" class="w-full h-50 cursor-zoom-in transition-transform transform-gpu hover:scale-150">
                </a>
                @else
                    <img src="{{ $selected_img }}"  class="w-full h-50">
                @endif
                <div class="flex items-center mt-4 gap-2">
                    @foreach(json_decode($product->secondary_images) as $img)
                        <a href="{{ $img }}" data-lightbox="product-image">
                            <img src="{{ $img }}" alt="" wire:click="$set('selected_img', '{{$img}}')" class="w-20 h-20 cursor-pointer">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    
        <div class="w-2/5">
            <h2 class="text-xl font-semibold">{{ $product->title }}</h2>
            <div class="flex items-center justify-between">
                <p class="text-gray-800 font-bold mt-4">{{ $product->price }}€</p>
                <div class="flex items-center gap-4">
                    @if($showIcon)
                        <div id="smiley" class="material-symbols-outlined mt-8">
                            sentiment_satisfied
                        </div>
                    @endif
                    <div class="flex items-center mt-8">
                        <button class="bg-gray-600 text-white px-4 py-2 rounded-l" wire:click="">-</button>
                        @php
                            $count = session('productCount', [])[$product->id] ? session('productCount', [])[$product->id] : 0;
                        @endphp
                        <input type="text" class="w-10 text-center border" value="{{$count}}">
                        <button class="bg-gray-600 text-white px-4 py-2 rounded-r" wire:click="addProduct">+</button>
                    </div>
                </div>
            </div>
            <p class="text-gray-600 mt-8">{{ $product->description }}</p>
          
        </div>
    </div>   
    
    <script src="{{ url('/lightbox/dist/js/lightbox.min.js') }}"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('smiley-face', () => {

                // Agregar un temporizador para ocultar el elemento después de 3 segundos
                setTimeout(function () {
                    document.getElementById('smiley').classList.add('animate-slide-up');
                    @this.set('showIcon', false);
                }, 3000);

            });        
        });
    </script>

</div>
