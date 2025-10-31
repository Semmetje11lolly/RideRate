<x-app-layout>
    <x-slot name="header">
        <h1>Editing {{ $type->name }}</h1>
    </x-slot>

    <section>
        <form action="{{ route('types.update', $type) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-item">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $type->name) }}" required>
                @error('name')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit">Save</button>
        </form>
    </section>
</x-app-layout>
