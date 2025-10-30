<x-app-layout :headerRideImage="asset('storage/' . $ride->image_url)">
    @vite('resources/js/rides-edit.js')
    <x-slot name="header_ride">
        <h1>Editing {{ $ride->name }}</h1>
        <button id="toggle-visibility-btn"
                data-url="{{ route('rides.toggle-visibility', $ride) }}"
                class="{{ $ride->public ? 'visible' : 'hidden' }}">
            {!! $ride->public ? 'Visible <i class="fa-solid fa-eye"></i>' : 'Hidden <i class="fa-solid fa-eye-slash"></i>' !!}
        </button>
    </x-slot>

    <section>
        <form action="{{ route('rides.update', $ride) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-item">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $ride->name) }}" required>
                    @error('name')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-item">
                    <label for="type_id">Type</label>
                    <select id="type_id" name="type_id" required>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ $ride->type_id == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('type_id')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-item">
                <label for="description">Description</label>
                <textarea id="description" name="description" type="text"
                          required rows="5">{{ old('description', $ride->description) }}</textarea>
                @error('description')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-item">
                <label for="image_url">Image (<i>Leave empty to keep current</i>)</label>
                <input id="image_url" name="image_url" type="file" accept="image/*" style="background-color: #fff">
                @if($ride->image_url)
                    <img src="{{ asset('storage/' . $ride->image_url) }}" alt="{{ $ride->name }}"
                         style="max-width: 200px; border-radius: 5px;">
                @endif
                @error('image_url')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-item">
                    <label for="stat_speed">Speed</label>
                    <input id="stat_speed" name="stat_speed" type="number"
                           value="{{ old('stat_speed', $ride->stat_speed) }}"
                           placeholder="Speed in km/h">
                    @error('stat_speed')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-item">
                    <label for="stat_length">Length</label>
                    <input id="stat_length" name="stat_length" type="number"
                           value="{{ old('stat_length', $ride->stat_length) }}"
                           placeholder="Length in meters">
                    @error('stat_length')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-item">
                    <label for="stat_height">Height</label>
                    <input id="stat_height" name="stat_height" type="number"
                           value="{{ old('stat_height', $ride->stat_height) }}"
                           placeholder="Height in meters">
                    @error('stat_height')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-item">
                    <label for="stat_duration">Duration</label>
                    <input id="stat_duration" name="stat_duration" type="number"
                           value="{{ old('stat_duration', $ride->stat_duration) }}"
                           placeholder="Duration in seconds">
                    @error('stat_duration')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-item">
                    <label for="stat_capacity">Capacity</label>
                    <input id="stat_capacity" name="stat_capacity" type="number"
                           value="{{ old('stat_capacity', $ride->stat_capacity) }}"
                           placeholder="Capacity in p/h">
                    @error('stat_capacity')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <button type="submit">Save</button>
        </form>
    </section>
</x-app-layout>
