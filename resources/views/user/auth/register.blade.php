<x-guest-layout>
    {{-- <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form> --}}
    <div class="row g-0 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card cascading-right" style="background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(30px);">
                <div class="card-body p-5 shadow-5 text-center">
                    <h2 class="fw-bold mb-5">Sign Up Now</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-12 mb-4">
                                <div class="form-outline">
                                    <x-input-label class="form-label" for="name" :value="__('Full Name')" />
                                    <x-text-input id="name" class="form-control form-control-solid" type="text"
                                        name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-12 mb-4">
                                <div class="form-outline">
                                    <x-input-label class="form-label" for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control form-control-solid" type="email"
                                        name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <x-input-label class="form-label" for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="form-control form-control-solid" type="password"
                                        name="password" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <x-input-label class="form-label" for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-text-input id="password_confirmation" class="form-control form-control-solid"
                                        type="password" name="password_confirmation" required
                                        autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Checkbox -->
                        <div class="form-check d-flex justify-content-center align-items-center mb-2">
                            <h6 class="d-flex justify-content-center align-items-center">
                                {{ __('Already registered?') }} 
                                <a href="{{ route('login') }}" class="btn btn-sm btn-link text-gray fw-bold fs-6">Log In</a>
                            </h6>
                            {{-- <a class="btn btn-sm btn-link text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a> --}}
                        </div>

                        <!-- Submit button -->
                        <x-primary-button class="btn btn-primary btn-block mb-4">
                            {{ __('Register') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
            <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4"
                alt="" />
        </div>
    </div>
</x-guest-layout>
