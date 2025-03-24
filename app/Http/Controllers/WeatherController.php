<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function showWeather(Request $request)
    {
        // Get the city from query parameter, default to 'New York' if not provided
        $city = $request->query('city', 'New York'); 

        // Ensure the API key and URL are correctly set in the .env file
        $apiKey = env('WEATHER_API_KEY');
        $apiUrl = env('WEATHER_API_URL');

        // Check if the API key and URL are defined
        if (!$apiKey || !$apiUrl) {
            return response()->json(['error' => 'API configuration missing'], 500);
        }

        // Construct the API request URL
        $fullApiUrl = "{$apiUrl}?q={$city}&appid={$apiKey}&units=metric";

        // Fetch weather data from the API
        $response = Http::get($fullApiUrl);

        if ($response->failed()) {
            return response()->json(['error' => 'Weather data not available'], 500);
        }

        // Return weather data to the view
        return view('weather', ['weather' => $response->json()]);
    }
}