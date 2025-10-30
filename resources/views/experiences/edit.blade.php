<x-app-layout :headerRideImage="asset('storage/' . $experience->image_urls)">
    @vite('resources/js/rides-edit.js')
    <x-slot name="header_ride">
        <h1>Editing Experience for {{ $experience->ride->name }}</h1>
        <button id="toggle-visibility-btn"
                data-url="{{ route('experiences.toggle-visibility', $experience) }}"
                class="{{ $experience->public ? 'visible' : 'hidden' }}">
            {!! $experience->public ? 'Visible <i class="fa-solid fa-eye"></i>' : 'Hidden <i class="fa-solid fa-eye-slash"></i>' !!}
        </button>
    </x-slot>

    <section>
        <h2>Update your review</h2>
        <p>Made a typo? Or changed your mind after riding again? You can edit your experience below.</p>
    </section>

    <section>
        <form action="{{ route('experiences.update', $experience) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-item">
                <label for="text">Review</label>
                <textarea id="text" name="text" required rows="5">{{ old('text', $experience->text) }}</textarea>
                @error('text')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-item">
                <label for="image_urls">Image (<i>Leave empty to keep current</i>)</label>
                <input id="image_urls" name="image_urls" type="file" accept="image/*" style="background-color: #fff">
                @if($experience->image_urls)
                    <img src="{{ asset('storage/' . $experience->image_urls) }}"
                         alt="Experience image"
                         style="max-width: 400px; max-height: 200px; object-fit: cover; border-radius: 5px;">
                @endif
                @error('image_urls')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-item">
                    <label for="rating_theme">Theme Rating</label>
                    <input id="rating_theme" name="rating_theme" type="number"
                           value="{{ old('rating_theme', $experience->rating_theme) }}"
                           placeholder="0-5" min="0" max="5" required>
                    @error('rating_theme')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    <span style="text-decoration: underline var(--color-primary)">Things to consider:</span>
                    <ul>
                        <li>Theme elaboration</li>
                        <li>Story / Narrative</li>
                        <li>Atmosphere & Immersion</li>
                    </ul>
                </div>

                <div class="form-item">
                    <label for="rating_design">Design Rating</label>
                    <input id="rating_design" name="rating_design" type="number"
                           value="{{ old('rating_design', $experience->rating_design) }}"
                           placeholder="0-5" min="0" max="5" required>
                    @error('rating_design')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    <span style="text-decoration: underline var(--color-primary)">Things to consider:</span>
                    <ul>
                        <li>Finishing touches / Quality</li>
                        <li>Layout / Flow</li>
                        <li>Use of space</li>
                    </ul>
                </div>

                <div class="form-item">
                    <label for="rating_ridexp">Ride Experience Rating</label>
                    <input id="rating_ridexp" name="rating_ridexp" type="number"
                           value="{{ old('rating_ridexp', $experience->rating_ridexp) }}"
                           placeholder="0-5" min="0" max="5" required>
                    @error('rating_ridexp')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    <span style="text-decoration: underline var(--color-primary)">Things to consider:</span>
                    <ul>
                        <li>Pacing / Ride course</li>
                        <li>Comfort / Smoothness</li>
                        <li>Intensity / Adrenaline</li>
                    </ul>
                </div>

                <div class="form-item">
                    <label for="rating_guestxp">Guest Experience Rating</label>
                    <input id="rating_guestxp" name="rating_guestxp" type="number"
                           value="{{ old('rating_guestxp', $experience->rating_guestxp) }}"
                           placeholder="0-5" min="0" max="5" required>
                    @error('rating_guestxp')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    <span style="text-decoration: underline var(--color-primary)">Things to consider:</span>
                    <ul>
                        <li>Queue experience</li>
                        <li>Entry/Exit process</li>
                        <li>Repetition value</li>
                    </ul>
                </div>

                <div class="form-item">
                    <label for="rating_creativity">Creativity Rating</label>
                    <input id="rating_creativity" name="rating_creativity" type="number"
                           value="{{ old('rating_creativity', $experience->rating_creativity) }}"
                           placeholder="0-5" min="0" max="5" required>
                    @error('rating_creativity')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    <span style="text-decoration: underline var(--color-primary)">Things to consider:</span>
                    <ul>
                        <li>Special effects</li>
                        <li>Innovation</li>
                        <li>Sound Quality / Music</li>
                    </ul>
                </div>
            </div>

            <button type="submit">Save</button>
        </form>
    </section>
</x-app-layout>
