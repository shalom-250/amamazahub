<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        $methods = $request->user()->paymentMethods()->orderByDesc('isDefault')->latest()->get();
        return Inertia::render('Payments', [
            'paymentMethods' => $methods
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider' => 'required|string|in:MTN,AIRTEL',
            'phone_number' => 'required|string|min:10',
        ]);

        $user = $request->user();
        
        // Auto-make it default if it's the first one
        $isFirst = $user->paymentMethods()->count() === 0;

        $user->paymentMethods()->create([
            'provider' => $validated['provider'],
            'phone_number' => $validated['phone_number'],
            'isDefault' => $isFirst,
        ]);

        return redirect()->back();
    }

    public function set_default(Request $request, PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->user_id !== $request->user()->id) {
            abort(403);
        }

        // Un-default existing ones
        $request->user()->paymentMethods()->update(['isDefault' => false]);
        
        // Set this new one to default
        $paymentMethod->update(['isDefault' => true]);

        return redirect()->back();
    }

    public function destroy(Request $request, PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->user_id === $request->user()->id) {
            $paymentMethod->delete();
        }
        return redirect()->back();
    }
}
