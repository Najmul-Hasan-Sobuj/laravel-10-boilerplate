<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}
    <div class="row g-0 justify-content-center align-items-center">
        <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="card cascading-right" style="background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(30px);">
                <div class="card-body p-5 shadow-5 text-center">
                    <h2 class="fw-bold mb-5">Log In</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row mb-4">
                            <div class="form-outline">
                                <x-input-label class="form-label" for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control form-control-solid" type="email"
                                    name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-outline">
                                <x-input-label class="form-label" for="password" :value="__('Password')" />

                                <x-text-input id="password" class="form-control form-control-solid" type="password"
                                    name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Checkbox -->
                        <div class="row justify-content-between align-items-center">
                            <div class="form-check d-flex justify-content-center align-items-center mb-3">
                                <input class="form-check-input me-2" type="checkbox" value="" id="remember_me"
                                    name="remember" />
                                <label class="form-check-label" for="remember_me">
                                    {{ __('Remember me') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="form-check d-flex justify-content-center align-items-center mb-3">
                                    <h6 class="d-flex justify-content-center align-items-center">
                                        {{ __('Forgot your password?') }}
                                        <a href="{{ route('password.request') }}"
                                            class="btn btn-sm btn-link text-gray fw-bold fs-6">{{ __('Click Here...') }}</a>
                                    </h6>
                                </div>
                            @endif
                        </div>

                        <!-- Submit button -->
                        <x-primary-button class="btn btn-primary btn-block mb-4">
                            {{ __('Log in') }}
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
