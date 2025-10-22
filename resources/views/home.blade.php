<x-app-layout>
    <x-slot name="header">
        The place to get real ride experiences from real people
    </x-slot>

    <div class="header-card">
        <p>Read and write comprehensive reviews about rides from theme parks all around the world!</p>
        <a href="{{ route('rides.index') }}" class="button-primary">View all Rides <i
                class="fa-solid fa-angle-right"></i></a>
    </div>

    @foreach($rides as $ride)
        <h2>{{ $ride->name }}</h2>
        <p>{{ $ride->type->name}}</p>
    @endforeach
</x-app-layout>
