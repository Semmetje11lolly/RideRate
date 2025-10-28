<x-app-layout>
    <x-slot name="script">
        ''
    </x-slot>
    <x-slot name="header">
        Rides
    </x-slot>

    <section>
        <form action="{{ route('rides.index') }}" method="get">
            <div class="form-row">
                <div class="form-item-horizontal">
                    <label for="type">Sort:</label>
                    <select id="sort" name="sort">
                        <option value="asc" {{ request('sort') == "asc" ? 'selected' : '' }}>A-Z</option>
                        <option value="desc" {{ request('sort') == "desc" ? 'selected' : '' }}>Z-A</option>
                    </select>
                </div>
                <div class="form-item-horizontal">
                    <label for="type">Type:</label>
                    <select id="type" name="type">
                        <option value="">All types</option>
                        @foreach($types as $type)
                            <option
                                value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item-horizontal">
                    <input id="search" name="search" type="text" value="{{ request('search') }}"
                           placeholder="Search for...">
                </div>
                <button type="submit">Search <i class="fa-solid fa-magnifying-glass"></i></button>
                <div class="form-item-horizontal">
                    <a href="{{ route('rides.index') }}">Clear</a>
                </div>
            </div>
        </form>

        @if($rides->count() > 0)
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
            @if($rides->hasPages())
                {{ $rides->links('pagination::simple-riderate') }}
            @endif
        @else
            <section>
                <h2 style="font-size: 1.5rem">We couldn't find any rides with those filters...</h2>
                <p>Please try with other filters or <a href="{{ route('rides.create') }}">Submit a Ride</a> to be added!
                </p>
            </section>
        @endif
    </section>
</x-app-layout>
