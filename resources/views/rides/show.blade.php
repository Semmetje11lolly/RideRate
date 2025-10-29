<x-app-layout :headerRideImage="asset('storage/' . $ride->image_url)">
    <x-slot name="script">
        ''
    </x-slot>
    <x-slot name="header_ride">
        <h1>{{ $ride->name }}</h1>
        <p>{{ $ride->type->name }}</p>
        @can('admin')
            <section>
                <a href="{{ route('rides.edit', $ride) }}" class="button-transparent">Edit <i
                        class="fa-solid fa-pen"></i></a>
            </section>
        @endcan
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
    <section>
        <h2>Experiences</h2>
        @if($experiences->count() > 0)
            <div class="experiences-grid">
                @foreach($experiences as $experience)
                    <a href="{{ route('experiences.show', $experience->id) }}">
                        <article
                            style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset('storage/' . $experience->image_urls) }});">
                            <div class="experience-user">
                                <img src="{{ url(Auth::user()->image_url) }}" alt="Profile Picture">
                                <p>
                                    <b>{{ $experience->user->name }}</b><br>
                                    {{ $experience->ride->name }}
                                </p>
                            </div>
                            <div class="experience-stars">
                                @for($i = 0; $i < $experience->average_rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @for($i = 0; $i < 5 - $experience->average_rating; $i++)
                                    <i class="fa-regular fa-star"></i>
                                @endfor
                            </div>
                            <p class="experience-text">{{ $experience->text }}</p>
                        </article>
                    </a>
                @endforeach
            </div>
        @else
            <section>
                <h2 style="font-size: 1.5rem">There aren't any experiences for this ride, yet!</h2>
                <p>Be the first to <a href="{{ route('experiences.create') }}">Write an Experience</a>
                    for this ride!
                </p>
            </section>
        @endif
    </section>
</x-app-layout>
