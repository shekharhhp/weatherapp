<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService {
    public static function getCurrentWeather($city) {
        $apiKey = env('WEATHER_API_KEY');
        $url = env('WEATHER_API_URL') . "?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($url);
        return $response->successful() ? $response->json() : null;
    }

    public static function getForecast($city) {
        $apiKey = env('WEATHER_API_KEY');
        $url = env('FORECAST_API_URL') . "?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($url);
        return $response->successful() ? $response->json() : null;
    }
}