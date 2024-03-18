<x-admin-guest-layout>
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-image: url({{ asset('admin/assets/media/illustrations/sketchy-1/14.png') }}">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="../../demo1/dist/index.html" class="mb-12">
                <img alt="Logo" src="{{ asset('admin/assets/media/logos/logo-1.svg') }}" class="h-40px" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!--begin::Form-->
                <form class="form w-100" action="{{ route('admin.login') }}" method="POST">
                    @csrf

                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Sign In to Metronic</h1>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <x-metronic.label
                            class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</x-metronic.label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <x-metronic.input type="email" name="email"
                            class="form-control form-control-lg form-control-solid"
                            placeholder="Enter your email address" value="{{ old('email') }}"
                            autocomplete="off"></x-metronic.input>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <x-metronic.label
                                class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</x-metronic.label>
                            <!--end::Label-->
                            <!--begin::Link-->
                            @if (Route::has('admin.password.request'))
                                <a href="{{ route('admin.password.request') }}" class="link-primary fs-6 fw-bolder">
                                    {{ __('Forgot password ?') }}</a>
                            @endif
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <x-metronic.input type="password" name="password"
                            class="form-control form-control-lg form-control-solid" placeholder="Enter your password"
                            autocomplete="off"></x-metronic.input>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                    <x-metronic.label for="remember_me"
                                        class="form-check-label">{{ __('Remember me') }}</x-metronic.label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <x-metronic.button type="submit" class="primary btn-lg w-100 mb-5">
                            <span class="indicator-label"> {{ __('Continue') }}</span>
                        </x-metronic.button>
                        <!--end::Submit button-->
                        <!--begin::Separator-->
                        <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
                        <!--end::Separator-->
                        <!--begin::Google link-->
                        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                            <img alt="Logo" src="{{ asset('admin/assets/media/svg/brand-logos/google-icon.svg') }}"
                                class="h-20px me-3" />Continue with Google</a>
                        <!--end::Google link-->
                        <!--begin::Google link-->
                        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                            <img alt="Logo" src="{{ asset('admin/assets/media/svg/brand-logos/facebook-4.svg') }}"
                                class="h-20px me-3" />Continue with Facebook</a>
                        <!--end::Google link-->
                        <!--begin::Google link-->
                        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
                            <img alt="Logo" src="{{ asset('admin/assets/media/svg/brand-logos/apple-black.svg') }}"
                                class="h-20px me-3" />Continue with Apple</a>
                        <!--end::Google link-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="d-flex flex-center flex-column-auto p-10">
            <!--begin::Links-->
            <div class="d-flex align-items-center fw-bold fs-6">
                <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
                <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
                <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
            </div>
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Authentication - Sign-in-->
</x-admin-guest-layout>
