<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $plan = 'price_1RJYy5FMriy1hvBPbjyEq6GY')
    {
        return $request->user()

            ->newSubscription('prod_SE108n2SgYwi6u', $plan)

            ->checkout([

                'success_url' => route('success'),

                'cancel_url' => route('home'),

            ]);
    }
}
