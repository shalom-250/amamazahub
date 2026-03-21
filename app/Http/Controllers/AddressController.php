<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Address;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $addresses = $request->user()->addresses()->orderByDesc('isDefault')->latest()->get();
        return Inertia::render('AddressBook', [
            'addresses' => $addresses
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = $request->user();
        
        // If this is the first address, auto-make it default
        $isFirst = $user->addresses()->count() === 0;

        $user->addresses()->create([
            'type' => $validated['type'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'isDefault' => $isFirst,
        ]);

        return redirect()->back();
    }

    public function set_default(Request $request, Address $address)
    {
        if ($address->user_id !== $request->user()->id) {
            abort(403);
        }

        // Un-default existing ones
        $request->user()->addresses()->update(['isDefault' => false]);
        
        // Set this new one to default
        $address->update(['isDefault' => true]);

        return redirect()->back();
    }

    public function destroy(Request $request, Address $address)
    {
        if ($address->user_id === $request->user()->id) {
            $address->delete();
        }
        return redirect()->back();
    }
}
