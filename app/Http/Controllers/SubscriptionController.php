<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    //create subscription
    public function create(Request $request, $owner_id)
    {
        $validatedData = $request->validate([
            'plan' => 'required|in:monthly,yearly,lifetime',
            'start_date' => 'required|date',
        ]);

        $validatedData['owner_id'] = $owner_id;
        $validatedData['status'] = 'active';
        $validatedData['end_date'] = match ($validatedData['plan']) {
            'monthly' => now()->addMonth(),
            'yearly' => now()->addYear(),
            'lifetime' => null,
        };
        $subscription = Subscription::create($validatedData);
        return response()->json([
            'message' => 'Subscription created successfully',
            'subscription' => $subscription
        ]);
    }
    public function renew(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        $subscription->start_date = now();
        $subscription->end_date = match ($subscription->plan) {
            'monthly' => now()->addMonth(),
            'yearly' => now()->addYear(),
            'lifetime' => null,
        };
        $subscription->save();
        return response()->json([
            'message' => 'Subscription renewed successfully',
            'subscription' => $subscription
        ]);
    }

    

}
