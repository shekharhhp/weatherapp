<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .weather-container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        .error { color: red; }
        .forecast { display: flex; justify-content: center; gap: 10px; margin-top: 20px; }
        .forecast-item { padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Weather Dashboard</h2>

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <div class="weather-container">
        <h3>Weather in {{ $city ?? 'Unknown' }}</h3>
        <p>Temperature: {{ $weather['main']['temp'] ?? 'N/A' }}°C</p>
        <p>Condition: {{ $weather['weather'][0]['description'] ?? 'N/A' }}</p>
        <p>Humidity: {{ $weather['main']['humidity'] ?? 'N/A' }}%</p>
        <p>Wind Speed: {{ $weather['wind']['speed'] ?? 'N/A' }} m/s</p>
    </div>

    @if(!empty($forecast['list']))
        <h3>5-Day Forecast</h3>
        <div class="forecast">
            @foreach($forecast['list'] as $index => $data)
                @if($index % 8 == 0)  {{-- Show data every 24 hours (8 * 3-hour intervals) --}}
                    <div class="forecast-item">
                        <p>{{ \Carbon\Carbon::parse($data['dt_txt'])->format('D, d M') }}</p>
                        <p>{{ $data['main']['temp'] }}°C</p>
                        <p>{{ $data['weather'][0]['description'] }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    <br>
    <form method="GET" action="/weather">
        <input type="text" name="city" placeholder="Enter City" required>
        <button type="submit">Get Weather</button>
    </form>
</body>
</html>