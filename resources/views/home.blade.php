<x-app-layout>
    <x-slot name="header">
        The place to get real ride experiences from real people
    </x-slot>

    <div class="header-card">
        <p>Read and write comprehensive reviews (experiences) about rides from theme parks all around the world!</p>
        <a href="{{ route('rides.index') }}" class="button-primary">View all Rides <i
                class="fa-solid fa-angle-right"></i></a>
    </div>

    <section>
        <h2>Take a look at these rides!</h2>
        <div class="rides-grid">
            @foreach($rides as $ride)
                <a href="{{ route('rides.show', $ride->slug) }}">
                    <article
                        style="background-image: linear-gradient(180deg, #00000000 70%, #000000 100%), url({{ asset('storage/' . $ride->image_url) }});">
                        <p>{{ $ride->type->name}}</p>
                        <h2>{{ $ride->name }}</h2>
                    </article>
                </a>
            @endforeach
        </div>
    </section>
</x-app-layout>
