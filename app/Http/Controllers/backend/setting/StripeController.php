<?php

namespace App\Http\Controllers\backend\setting;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class StripeController extends Controller
{
     /**
     * return view & array
     */
    public function index()
    {
        return view('backend.layout.setting.stripe');
    }


    /**
     * input from a form
     * update env file content
     * used for: updating the stripe env properties
     */
    public function stripeSettingUpdate(Request $request)
    {
        $request->validate([
            'stripe_pk' => 'required|string',
            'stripe_sk' => 'required|string',
        ]);
        try {
            $envContent = File::get(base_path('.env'));
            $lineBreak = "\n";
            $envContent = preg_replace([
                '/STRIPE_PK=(.*)\s/',
                '/STRIPE_SK=(.*)\s/',
            ], [
                'STRIPE_PK=' .'"'. $request->stripe_pk .'"'. $lineBreak,
                'STRIPE_SK=' .'"'. $request->stripe_sk .'"'. $lineBreak,
            ], $envContent);

            if ($envContent !== null) {
                File::put(base_path('.env'), $envContent);
            }
            return back()->with('t-success', 'Updated successfully');
        } catch (Exception $e) {
            return back()->with('t-error', 'Failed to update');
        }
    }
}
