<x-app-layout>
    <x-slot name="header">
        Profile
    </x-slot>

    <section>
        <h2>My Experiences</h2>
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
        @else
            <section>
                <h2 style="font-size: 1.5rem">You haven't written any experiences, yet!</h2>
                <p>Write your first <a href="{{ route('experiences.create') }}">Experience</a>
                    for a ride!
                </p>
            </section>
        @endif
    </section>

    @include('profile.partials.update-profile-information-form')

    @include('profile.partials.update-password-form')

    <section>
        <h2>Logout</h2>
        <p>Use the button below to logout.</p>
        <form action="{{ route('logout') }}" method="post" style="align-items: center">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </section>
</x-app-layout>
