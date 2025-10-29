<x-app-layout>
    <x-slot name="header">
        Add a Ride
    </x-slot>

    <section>
        <h2>Did we miss your favorite one?</h2>
        <p>Want to write an experience for a ride that doesn't exist on Ride Rate yet? Fill out the form below to submit
            a ride to the Ride Rate Team!<br>
            <i>We aim to review new submissions within a week.</i></p>
    </section>

    <section>
        <form action="{{ route('rides.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-item">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required>
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-item">
                    <label for="type_id">Type</label>
                    <select id="type_id" name="type_id" required>
                        <option value disabled selected>Choose a type</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type_id')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form-item">
                <label for="description">Description</label>
                <textarea id="description" name="description" type="text"
                          required rows="5">{{ old('description') }}</textarea>
                @error('description')
                {{ $message }}
                @enderror
            </div>

            <div class="form-item">
                <label for="image_url">Image (<i>Please select a vertical image</i>)</label>
                <input id="image_url" name="image_url" type="file" accept="image/*" value="{{ old('image_url') }}"
                       required style="background-color: #fff">
                @error('image_url')
                {{ $message }}
                @enderror
            </div>
            <div class="form-row">
                <div class="form-item">
                    <label for="stat_speed">Speed</label>
                    <input id="stat_speed" name="stat_speed" type="number" value="{{ old('stat_speed') }}"
                           placeholder="Speed in km/h">
                    @error('stat_speed')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-item">
                    <label for="stat_length">Length</label>
                    <input id="stat_length" name="stat_length" type="number" value="{{ old('stat_length') }}"
                           placeholder="Length in meters">
                    @error('stat_length')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-item">
                    <label for="stat_height">Height</label>
                    <input id="stat_height" name="stat_height" type="number" value="{{ old('stat_height') }}"
                           placeholder="Height in meters">
                    @error('stat_height')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-item">
                    <label for="stat_duration">Duration</label>
                    <input id="stat_duration" name="stat_duration" type="number" value="{{ old('stat_duration') }}"
                           placeholder="Duration in seconds">
                    @error('stat_duration')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-item">
                    <label for="stat_capacity">Capacity</label>
                    <input id="stat_capacity" name="stat_capacity" type="number" value="{{ old('stat_capacity') }}"
                           placeholder="Capacity in p/h">
                    @error('stat_capacity')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <button type="submit">Create</button>
        </form>
    </section>
</x-app-layout>
