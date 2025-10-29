<x-app-layout>
    <x-slot name="header">
        Write an Experience
    </x-slot>

    <section>
        <h2>Recently experienced a ride?</h2>
        <p>Have you recently ridden an amazing ride and want to let the whole world know? Or was a ride so bad you want
            to warn everybody not to ride it? Write a review for the ride here!</p>
    </section>

    <section>
        <form action="{{ route('experiences.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-item">
                    <label for="ride_id">Ride</label>
                    <select id="ride_id" name="ride_id" required>
                        <option value disabled selected>Choose a ride</option>
                        @foreach($rides as $ride)
                            <option value="{{ $ride->id }}">{{ $ride->name }}</option>
                        @endforeach
                    </select>
                    @error('ride_id')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-item">
                    <h3>Help! I don't see my ride!</h3>
                    <p>Is the ride you want to write an experience for not in the list? Submit a ride to be added <a
                            href="{{ route('rides.create') }}">here</a>!</p>
                </div>
            </div>

            <div class="form-item">
                <label for="text">Review</label>
                <textarea id="text" name="text" type="text"
                          required rows="5">{{ old('text') }}</textarea>
                @error('text')
                {{ $message }}
                @enderror
            </div>

            <div class="form-item">
                <label for="image_urls">Image (<i>This can be an image you took of the ride</i>)</label>
                <input id="image_urls" name="image_urls" type="file" accept="image/*" value="{{ old('image_urls') }}"
                       required style="background-color: #fff">
                @error('image_urls')
                {{ $message }}
                @enderror
            </div>
            <div class="form-row">
                <div class="form-item">
                    <label for="rating_theme">Theme Rating</label>
                    <input id="rating_theme" name="rating_theme" type="number" value="{{ old('rating_theme') }}"
                           placeholder="0-5" min="0" max="5" required>
                    @error('rating_theme')
                    {{ $message }}
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
                    <input id="rating_design" name="rating_design" type="number" value="{{ old('rating_design') }}"
                           placeholder="0-5" min="0" max="5" required>
                    @error('rating_design')
                    {{ $message }}
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
                    <input id="rating_ridexp" name="rating_ridexp" type="number" value="{{ old('rating_ridexp') }}"
                           placeholder="0-5" min="0" max="5" required>
                    @error('rating_ridexp')
                    {{ $message }}
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
                    <input id="rating_guesxp" name="rating_guestxp" type="number" value="{{ old('rating_guestxp') }}"
                           placeholder="0-5" min="0" max="5" required>
                    @error('rating_guestxp')
                    {{ $message }}
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
                           value="{{ old('rating_creativity') }}"
                           placeholder="0-5" min="0" max="5" required>
                    @error('rating_creativity')
                    {{ $message }}
                    @enderror
                    <span style="text-decoration: underline var(--color-primary)">Things to consider:</span>
                    <ul>
                        <li>Special effects</li>
                        <li>Innovation</li>
                        <li>Sound Quality / Music</li>
                    </ul>
                </div>
            </div>

            <button type="submit">Create</button>
        </form>
    </section>
</x-app-layout>
