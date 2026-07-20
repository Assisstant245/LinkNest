<?php

namespace App\Livewire\Billing;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Billing'])]
class Plans extends Component
{
    public function upgrade()
    {
        return auth()->user()
            ->newSubscription('default', config('services.stripe.pro_price_id'))
            ->checkout([
                'success_url' => route('billing.success'),
                'cancel_url' => route('billing.cancel'),
            ]);
    }

    public function render()
    {
        return view('livewire.billing.plans');
    }
}
