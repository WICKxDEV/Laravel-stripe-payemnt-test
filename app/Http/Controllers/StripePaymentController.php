<?php 

namespace App\Http\Controllers;

use illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class StripePaymentController extends Controller
{
    /**
     * success response method
     * 
     * @return \Illuminate\Http\Response
     */
    public function stripe(): View 
    {
        return view('stripe');
    }

    /**
     * success response method.
     * 
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request): RedirectResponse
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
            "amount" => 10 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "amount" => 10 * 100,
            "description" => "Test payment from WICKxDev"
        ]);
        
        return back()
            ->with('success', 'Payment Successful!');
    }
}