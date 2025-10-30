<section>
    <h2>Profile Information</h2>
</section>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="form-row">
        <div class="form-item">
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                          required autocomplete="name"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div class="form-item">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user->email)" required autocomplete="username"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
        </div>
    </div>

    <div class="form-item">
        <label for="image_url">Profile Image <i>(Leave empty to keep current)</i></label>
        <input id="image_url" name="image_url" type="file" accept="image/*" value="{{ old('image_url') }}"
               style="background-color: #fff">
        @error('image_url')
        {{ $message }}
        @enderror
    </div>

    <div class="form-item">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>
</form>
