<div>
    {{-- Do your work, then step back. --}}
    <div class="bg-white rounded shadow-xl py-4 px-2 mt-4 mb-4 mr-16 ml-16">
        <p class="font-bold text-xl">Agregar método de pago</p>

        <div class="flex" wire:ignore>
            <p class="text-gray-600 mr-4 mt-4">Información de tarjeta</p>
            <div class="flex-1 mt-4">
                <input placeholder="Nombre del titular de la tarjeta"  class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="card-holder-name" type="text">
                
                <!-- Stripe Elements Placeholder -->
                <div id="card-element" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></div>
                <span id="card-error-message" class="text-red-600 text-xs"></span>
            </div>
        </div>
        <hr>
        <div class="flex justify-end">
            <x-button id="card-button" class="mt-4" data-secret="{{ $intent->client_secret }}">
                Update Payment Method
            </x-button>
        </div>

    </div>


    <script src="https://js.stripe.com/v3/"></script>
 
    <script>
        const stripe = Stripe("{{env('STRIPE_KEY')}}");
    
        const elements = stripe.elements();
        const cardElement = elements.create('card');
    
        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        
        cardButton.addEventListener('click', async (e) => {

            let clientSecret = cardButton.dataset.secret;

            //CardButton.disabled = true;
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );
            //CardButton.disabled = false;

            if (error) {
                // Display "error.message" to the user...
                let span = document.getElementById('card-error-message');
                span.textContent = error.message;
            } else {
                // The card has been verified successfully...
                @this.addPaymentMethod(setupIntent.payment_method)
                cardHolderName.value ='';
                cardElement.clear();

            }
        });
    </script>
</div>
