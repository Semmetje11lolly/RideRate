<x-app-layout>
    <x-slot name="header">
        Rides
    </x-slot>

    <section class="rides-grid">
        @foreach($rides as $ride)
            <article
                style="background-image: linear-gradient(180deg, #00000000 70%, #000000 100%), url({{ asset('storage/' . $ride->image_url) }});">
                <p>{{ $ride->type->name}}</p>
                <h2>{{ $ride->name }}</h2>
            </article>
        @endforeach
    </section>
</x-app-layout>
