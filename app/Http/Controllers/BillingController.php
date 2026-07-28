<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Cashier\Cashier;

class BillingController extends Controller
{
    /**
     * Stripe's subscription webhook is what normally keeps the local
     * `subscriptions` table in sync, but locally (and any time webhook
     * delivery lags) that never arrives — Stripe can't reach localhost.
     * As a fallback, sync directly from the Checkout Session the user was
     * just redirected back from, so Pro features unlock immediately.
     */
    public function success(Request $request)
    {
        $user = $request->user();
        $sessionId = $request->query('session_id');

        if ($sessionId && $user) {
            $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId, [
                'expand' => ['subscription.items.data.price'],
            ]);

            if ($session->status === 'complete' && $session->customer === $user->stripe_id && $session->subscription) {
                $this->syncSubscription($user, $session->subscription);
            }
        }

        return redirect()->route('billing')->with('status', "You're now on the Pro plan!");
    }

    protected function syncSubscription(User $user, \Stripe\Subscription $stripeSubscription): void
    {
        $items = $stripeSubscription->items->data;
        $firstItem = $items[0];
        $isSinglePrice = count($items) === 1;

        $subscription = $user->subscriptions()->updateOrCreate([
            'stripe_id' => $stripeSubscription->id,
        ], [
            'type' => 'default',
            'stripe_status' => $stripeSubscription->status,
            'stripe_price' => $isSinglePrice ? $firstItem->price->id : null,
            'quantity' => $isSinglePrice ? ($firstItem->quantity ?? null) : null,
            'trial_ends_at' => $stripeSubscription->trial_end
                ? Carbon::createFromTimestamp($stripeSubscription->trial_end)
                : null,
            'ends_at' => null,
        ]);

        foreach ($items as $item) {
            $subscription->items()->updateOrCreate([
                'stripe_id' => $item->id,
            ], [
                'stripe_product' => $item->price->product,
                'stripe_price' => $item->price->id,
                'quantity' => $item->quantity ?? null,
            ]);
        }
    }
}
