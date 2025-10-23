<x-app-layout>
    <x-slot name="header">
        Add a Ride
    </x-slot>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab aliquid aperiam aspernatur atque blanditiis
    consequuntur deserunt dolores et harum id, in itaque laboriosam optio quaerat, quasi quos sed veniam!

    <form action="{{ route('rides.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="name">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required>
        @error('name')
        {{ $message }}
        @enderror

        <label for="description">Description</label>
        <textarea id="description" name="description" type="text" required>{{ old('description') }}</textarea>
        @error('description')
        {{ $message }}
        @enderror

        <label for="type_id">Type</label>
        <select id="type_id" name="type_id" required>
            @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
        @error('type_id')
        {{ $message }}
        @enderror

        <label for="image_url">Image</label>
        <input id="image_url" name="image_url" type="file" accept="image/*" value="{{ old('image_url') }}" required>
        @error('image_url')
        {{ $message }}
        @enderror

        <input type="submit" name="submit" value="Create">
    </form>
</x-app-layout>
