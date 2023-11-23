<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
class PaymentMethod extends Component
{
    public function render()
    {
        $destroy = null;
        return view('livewire.payment-method',[
            'intent'=>auth()->user()->createSetupIntent(),
        ]);
    }
    public function addPaymentMethod($payment){ //rep el payment method que ens retorna la api d stripe
        auth()->user()->addPaymentMethod($payment);
        //toastr()->success('Método añadido con éxito');
    }

}
