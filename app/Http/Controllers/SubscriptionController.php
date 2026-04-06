<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Suscriptionrenewals;

class SubscriptionController extends Controller
{
    //view all subscriptions
    public function index()
    {
        $subscriptions = Subscription::with('owner')->paginate(10);
        return view('admin.subscriptions', compact('subscriptions'));
    }
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
        try {
            $subscription = Subscription::create($validatedData);
            return response()->json([
                'message' => 'Subscription created successfully',
                'subscription' => $subscription
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating subscription'], 500);
        }

        
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
        try {
            $subscription->save();
            Suscriptionrenewals::create([
                'subscription_id' => $subscription->id,
                'renewal_date' => now(),
            ]);
            return response()->json([
                'message' => 'Subscription renewed successfully',
                'subscription' => $subscription
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error renewing subscription'], 500);
        }

    }
    


}
