<x-app-layout :headerRideImage="asset('storage/' . $ride->image_url)">
    <x-slot name="header_ride">
        <h1>{{ $ride->name }}</h1>
        <p>{{ $ride->type->name }}</p>
    </x-slot>

    @php
        $stats = collect([
            ['title' => 'Speed', 'value' => $ride->stat_speed, 'unit' => 'km/h'],
            ['title' => 'Length', 'value' => $ride->stat_length, 'unit' => 'meter'],
            ['title' => 'Height', 'value' => $ride->stat_height, 'unit' => 'meter'],
            ['title' => 'Duration', 'value' => $ride->stat_duration, 'unit' => 'minutes'], // unit alvast 'minutes'
            ['title' => 'Capacity', 'value' => $ride->stat_capacity, 'unit' => 'p/h'],
        ])->filter(fn($stat) => filled($stat['value']))
          ->take(4)
          ->map(function ($stat) {
              if ($stat['title'] === 'Duration') {
                  $minutes = intdiv($stat['value'], 60);
                  $seconds = $stat['value'] % 60;
                  $stat['value'] = "{$minutes}:" . str_pad($seconds, 2, '0', STR_PAD_LEFT);
              }
              return $stat;
          });
    @endphp

    <div class="header-card" style="flex-direction: row; gap: 50px">
        @foreach($stats as $stat)
            <div style="flex: 1">
                <span class="ride-stat-title">{{ $stat['title'] }}</span>
                <span class="ride-stat-number">{{ $stat['value'] }}</span>
                <span class="ride-stat-unit">{{ $stat['unit'] }}</span>
            </div>
        @endforeach
    </div>

    <section>
        <h2>About this ride</h2>
        <p>{{ $ride->description}}</p>
    </section>
</x-app-layout>
