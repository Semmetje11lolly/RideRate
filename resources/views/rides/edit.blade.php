<x-app-layout>
    <x-slot name="script">
        ''
    </x-slot>
    <x-slot name="header">
        Edit Ride
    </x-slot>

    <section>
        <h2>{{ $ride->name }}</h2>
        VISIBILITY BUTTON
    </section>

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

            <button type="submit">Save</button>
        </form>
    </section>
</x-app-layout>
