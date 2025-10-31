<x-app-layout>
    <x-slot name="header">
        Experiences
    </x-slot>
    @if (session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    <section>
        <form action="{{ route('experiences.index') }}" method="get">
            <div class="form-row">
                <div class="form-item-horizontal">
                    <label for="sort">Sort:</label>
                    <select id="sort" name="sort">
                        <option value="desc" {{ request('sort') == "desc" ? 'selected' : '' }}>Newest</option>
                        <option value="asc" {{ request('sort') == "asc" ? 'selected' : '' }}>Oldest</option>
                    </select>
                </div>
                <div class="form-item-horizontal">
                    <label for="ride">Ride:</label>
                    <select id="ride" name="ride">
                        <option value="">All rides</option>
                        @foreach($rides as $ride)
                            <option
                                value="{{ $ride->id }}" {{ request('ride') == $ride->id ? 'selected' : '' }}>{{ $ride->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item-horizontal">
                    <input id="search" name="search" type="text" value="{{ request('search') }}"
                           placeholder="Search for...">
                </div>
                <button type="submit">Search <i class="fa-solid fa-magnifying-glass"></i></button>
                <div class="form-item-horizontal">
                    <a href="{{ route('experiences.index') }}">Clear</a>
                </div>
            </div>
        </form>

        @if($experiences->count() > 0)
            <div class="experiences-grid">
                @foreach($experiences as $experience)
                    <a href="{{ route('experiences.show', $experience->id) }}">
                        <article
                            style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset('storage/' . $experience->image_urls) }});">
                            <div class="experience-user">
                                <img src="{{ asset('storage/' . $experience->user->image_url) }}" alt="Profile Picture">
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
            @if($experiences->hasPages())
                {{ $experiences->links('pagination::simple-riderate-experiences') }}
            @endif
        @else
            <section>
                <h2 style="font-size: 1.5rem">We couldn't find any experiences with those filters...</h2>
                <p>Please try with other filters or <a href="{{ route('experiences.create') }}">Write an Experience</a>
                    for a ride!
                </p>
            </section>
        @endif
    </section>
</x-app-layout>
