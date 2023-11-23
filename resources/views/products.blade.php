<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="font-family: 'Oswald', sans-serif">
            Our Products
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-4 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl ">
                @livewire('products')
            </div>
        </div>
    </div>
</x-app-layout>