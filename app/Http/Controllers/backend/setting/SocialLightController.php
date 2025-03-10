<?php

namespace App\Http\Controllers\backend\setting;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SocialLightController extends Controller
{
    /**
     * return view & array
     */
    public function index()
    {
        return view('backend.layout.setting.social-light');
    }


    /**
     * input from a form
     * update env file content
     * used for: updating the social light env properties
     */
    public function socialLightSettingUpdate(Request $request)
    {
        $request->validate([
            'google_client_id' => 'required|string',
            'google_client_secret' => 'required|string',
            // 'google_redirect' => 'required|string',
        ]);
        try {
            $envContent = File::get(base_path('.env'));
            $lineBreak = "\n";
            $envContent = preg_replace([
                '/GOOGLE_CLIENT_ID=(.*)\s/',
                '/GOOGLE_CLIENT_SECRET=(.*)\s/',
                '/GOOGLE_REDIRECT=(.*)\s/',
            ], [
                'GOOGLE_CLIENT_ID=' . '"' . $request->google_client_id . '"' . $lineBreak,
                'GOOGLE_CLIENT_SECRET=' . '"' . $request->google_client_secret . '"' . $lineBreak,
                // 'GOOGLE_REDIRECT=' . '"' . $request->google_redirect . '"' . $lineBreak,
            ], $envContent);

            if ($envContent !== null) {
                File::put(base_path('.env'), $envContent);
            }
            // dd($request->all());
            return back()->with('t-success', 'Updated successfully');
        } catch (Exception $e) {
            return back()->with('t-error', 'Failed to update');
        }
    }
}
