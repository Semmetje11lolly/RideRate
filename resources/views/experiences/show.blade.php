<x-app-layout :headerRideImage="asset('storage/' . $experience->image_urls)">
    <x-slot name="header_ride">
        <div class="experience-stars" style="margin-bottom: 10px">
            @for($i = 0; $i < $experience->average_rating; $i++)
                <i class="fa-solid fa-star"></i>
            @endfor
            @for($i = 0; $i < 5 - $experience->average_rating; $i++)
                <i class="fa-regular fa-star"></i>
            @endfor
        </div>
        <h1>{{ $experience->ride->name }} Experience</h1>
        <div class="experience-user">
            Written by {{ $experience->user->name }}
            <img src="{{ asset('storage/' . $experience->user->image_url) }}" alt="Profile Picture">
        </div>
        @can('experiences-edit', $experience)
            <section>
                <a href="{{ route('experiences.edit', $experience) }}" class="button-transparent">Edit <i
                        class="fa-solid fa-pen"></i></a>
            </section>
        @endcan
    </x-slot>

    <section>
        <h2>Review</h2>
        <p>{{ $experience->text }}</p>
    </section>
    <section>
        <h2>Rating Breakdown</h2>
        <section class="form-row">
            <div class="form-item" style="align-items: center">
                <h3>Theme</h3>
                Based on theme elaboration, story/narrative and more!
                <div class="experience-stars" style="color: var(--color-black)">
                    @for($i = 0; $i < $experience->rating_theme; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                    @for($i = 0; $i < 5 - $experience->rating_theme; $i++)
                        <i class="fa-regular fa-star"></i>
                    @endfor
                </div>
            </div>
            <div class="form-item" style="align-items: center">
                <h3>Design</h3>
                Based on finishing touches, layout/flow, use of space and more!
                <div class="experience-stars" style="color: var(--color-black)">
                    @for($i = 0; $i < $experience->rating_design; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                    @for($i = 0; $i < 5 - $experience->rating_design; $i++)
                        <i class="fa-regular fa-star"></i>
                    @endfor
                </div>
            </div>
            <div class="form-item" style="align-items: center">
                <h3>Ride Experience</h3>
                Based on pacing, comfort / smoothness, intensity and more!
                <div class="experience-stars" style="color: var(--color-black)">
                    @for($i = 0; $i < $experience->rating_ridexp; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                    @for($i = 0; $i < 5 - $experience->rating_ridexp; $i++)
                        <i class="fa-regular fa-star"></i>
                    @endfor
                </div>
            </div>
            <div class="form-item" style="align-items: center">
                <h3>Guest Experience</h3>
                Based on queue experience, entry/exit process and more!
                <div class="experience-stars" style="color: var(--color-black)">
                    @for($i = 0; $i < $experience->rating_guestxp; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                    @for($i = 0; $i < 5 - $experience->rating_guestxp; $i++)
                        <i class="fa-regular fa-star"></i>
                    @endfor
                </div>
            </div>
            <div class="form-item" style="align-items: center">
                <h3>Creativity</h3>
                Based on special effects, innovation, sound quality/music and more!
                <div class="experience-stars" style="color: var(--color-black)">
                    @for($i = 0; $i < $experience->rating_creativity; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                    @for($i = 0; $i < 5 - $experience->rating_creativity; $i++)
                        <i class="fa-regular fa-star"></i>
                    @endfor
                </div>
            </div>
        </section>
    </section>
</x-app-layout>
