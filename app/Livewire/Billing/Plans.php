<?php

namespace App\Livewire\Billing;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Billing'])]
class Plans extends Component
{
    public function upgrade()
    {
        $checkout = auth()->user()
            ->newSubscription('default', config('services.stripe.pro_price_id'))
            ->checkout([
                'success_url' => route('billing.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('billing.cancel'),
            ]);

        // Cashier's own Checkout::redirect() uses the Redirect facade, which
        // Livewire rebinds mid-request to support AJAX-driven redirects —
        // that breaks Checkout::redirect()'s strict RedirectResponse type.
        // Livewire's own $this->redirect() handles this correctly.
        return $this->redirect($checkout->url);
    }

    public function manageBilling()
    {
        if (! auth()->user()->isPro()) {
            return;
        }

        return auth()->user()->redirectToBillingPortal(route('billing'));
    }

    public function render()
    {
        return view('livewire.billing.plans');
    }
}
