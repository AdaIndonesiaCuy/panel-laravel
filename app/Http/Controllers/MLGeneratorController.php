<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Key;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MLGeneratorController extends Controller
{
    public function index()
    {
        $asset_dir = 'css/';

        return view('keygen.ml', ['asset_dir' => $asset_dir]);
    }

    public function generateKeys(Request $request)
    {
        $user = auth()->user();

        // Validate the form data
        $request->validate([
            'duration' => 'required|numeric|in:1,3,7,30,60,90,365',
        ]);

        // Calculate the price based on the selected duration
        $duration = $request->input('duration');
        $price = $this->calculatePrice($duration);

        // Check if the user has enough balance
        if ($user->balance < $price) {
            return redirect()->back()->with('error', 'Insufficient balance to generate key.');
        }

        // Generate a unique key
        $key = $this->generateUniqueKey();

        // Deduct the balance
        $user->balance -= $price;
        $user->spent += $price;
        $user->save();

        // Create a new Key record
        $keyRecord = new Key([
            'game' => 'Mobile Legends', // Update with your actual game name
            'key' => $key,
            'date_generated' => now(),
            'duration' => $duration,
            'max_device' => '3', // You can update this based on your application logic
            'user_id' => $user->id,
            'username' => $user->name,
        ]);

        $keyRecord->save();
        return redirect()->route('keygen.ml')->with('success', 'Key generated successfully!')->with('generatedKey', $keyRecord);
    }

    // Helper method to calculate price based on duration
    private function calculatePrice($duration)
    {
        // Define your price list
        $priceList = [
            1 => 10000,
            3 => 20000,
            7 => 50000,
            30 => 100000,
            60 => 150000,
            90 => 200000,
            365 => 1000000,
        ];

        // Check if the selected duration exists in the price list
        if (array_key_exists($duration, $priceList)) {
            return $priceList[$duration];
        }

        // Default to 0 if duration is not found (you can update this based on your application logic)
        return 0;
    }

    // Helper method to generate a unique key
    private function generateUniqueKey()
    {
        do {
            $key = 'MLBB_' . Str::random(12);
            $keyExists = Key::where('key', $key)->exists();
        } while ($keyExists);
    
        return $key;
    }
}
