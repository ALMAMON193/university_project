<?php

namespace App\Http\Controllers\frontend;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
   public function ChatGpt()
    {
        return view('frontend.app');
    }

    public function ChatGptPost(Request $request)
    {
       $apiKey = config('services.openai.api_key');
        if (!$apiKey) {
            return response()->json(['error' => 'OpenAI API key not configured.'], 500);
        }

        // Validate the prompt
        $request->validate([
            'prompt' => 'required|string|max:2000',
        ]);

        $userPrompt = $request->input('prompt');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $userPrompt],
                ],
                'max_tokens' => 300,
            ]);

            if ($response->successful()) {
                $openAiResponse = $response->json();
                $messageContent = $openAiResponse['choices'][0]['message']['content'] ?? 'No response from OpenAI.';
                return response()->json(['response' => $messageContent]);
            } else {
                return response()->json(['error' => 'Failed to get a response from OpenAI: ' . $response->body()], 500);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
