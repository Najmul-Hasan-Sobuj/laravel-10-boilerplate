<x-admin-app-layout :title="'Email-settings Add'">
    <div class="card card-flash">

        <!--begin::Modal body-->
        <div class="card-body scroll-y mx-5 mx-xl-15 my-7">
            <!--begin::Form-->
            <form class="form" action="{{ route('admin.email-settings.store') }}" method="POST">
                @csrf
                <!--begin::Input group-->
                <div class="row">
                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="mail_mailer"
                            class="col-form-label fw-bold fs-6 required">{{ __('Mailer') }}
                        </x-metronic.label>

                        <x-metronic.input id="mail_mailer" type="text" name="mail_mailer" :value="old('mail_mailer')"
                            placeholder="Enter the Mailer" required></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="mail_host"
                            class="col-form-label fw-bold fs-6 required">{{ __('Host') }}
                        </x-metronic.label>

                        <x-metronic.input id="mail_host" type="text" name="mail_host" :value="old('mail_host')"
                            placeholder="Enter the Host" required></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="mail_port"
                            class="col-form-label fw-bold fs-6 required">{{ __('Port') }}
                        </x-metronic.label>

                        <x-metronic.input id="mail_port" type="number" name="mail_port" :value="old('mail_port')"
                            placeholder="Enter the Port" required></x-metronic.input>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="mail_username"
                            class="col-form-label fw-bold fs-6 required">{{ __('Username') }}
                        </x-metronic.label>

                        <x-metronic.input id="mail_username" type="text" name="mail_username" :value="old('mail_username')"
                            placeholder="Enter the Username" required></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="mail_password"
                            class="col-form-label fw-bold fs-6 required">{{ __('Password') }}
                        </x-metronic.label>
                        <x-metronic.password-input id="mail_password" name="mail_password" placeholder="Enter mail password" :value="old('mail_password')" required/>

                        {{-- <x-metronic.input id="mail_password" type="text" name="mail_password" :value="old('mail_password')"
                            placeholder="Enter the Password" required></x-metronic.input> --}}
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="mail_encryption" class="col-form-label fw-bold fs-6 required">
                            {{ __('Mail Encryption ') }}</x-metronic.label>
                        <x-metronic.select-option id="mail_encryption" name="mail_encryption" data-hide-search="true"
                            data-placeholder="Select an option">
                            <option></option>
                        <option value="ssl" {{ old('mail_encryption') == 'ssl' ? 'selected' : '' }}>SSL</option>
                        <option value="tls" {{ old('mail_encryption') == 'tls' ? 'selected' : '' }}>TLS</option>
                        </x-metronic.select-option>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="mail_from_address"
                            class="col-form-label fw-bold fs-6 required">{{ __('From Address') }}
                        </x-metronic.label>

                        <x-metronic.input id="mail_from_address" type="email" name="mail_from_address" :value="old('mail_from_address')"
                            placeholder="Enter the From Address" required></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="mail_from_name"
                            class="col-form-label fw-bold fs-6 required">{{ __('From Name') }}
                        </x-metronic.label>

                        <x-metronic.input id="mail_from_name" type="text" name="mail_from_name" :value="old('mail_from_name')"
                            placeholder="Enter the From Name" required></x-metronic.input>
                    </div>

                    <div class="col-lg-4 mb-7">
                        <x-metronic.label for="status" class="col-form-label required fw-bold fs-6">
                            {{ __('Select a Status ') }}</x-metronic.label>
                        <x-metronic.select-option id="status" name="status" data-hide-search="true"
                            data-placeholder="Select an option">
                            <option></option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </x-metronic.select-option>
                    </div>
                </div>




                <div class="text-center pt-15">
                    <x-metronic.button type="submit" class="primary">
                        {{ __('Submit') }}
                    </x-metronic.button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Modal body-->
    </div>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.email-settings.store') }}">
                @csrf

                <!-- Mailer -->
                <div>
                    <x-input-label for="mail_mailer" :value="__('Mailer')" />
                    <x-text-input id="mail_mailer" class="block mt-1 w-full" type="text" name="mail_mailer"
                        :value="old('mail_mailer')" required autofocus autocomplete="mail_mailer" />
                    <x-input-error :messages="$errors->get('mail_mailer')" class="mt-2" />
                </div>

                <!-- Host -->
                <div>
                    <x-input-label for="mail_host" :value="__('Host')" />
                    <x-text-input id="mail_host" class="block mt-1 w-full" type="text" name="mail_host"
                        :value="old('mail_host')" required autofocus autocomplete="mail_host" />
                    <x-input-error :messages="$errors->get('mail_host')" class="mt-2" />
                </div>

                <!-- Port -->
                <div>
                    <x-input-label for="mail_port" :value="__('Port')" />
                    <x-text-input id="mail_port" class="block mt-1 w-full" type="text" name="mail_port"
                        :value="old('mail_port')" required autofocus autocomplete="mail_port" />
                    <x-input-error :messages="$errors->get('mail_port')" class="mt-2" />
                </div>

                <!-- Username -->
                <div>
                    <x-input-label for="mail_username" :value="__('Username')" />
                    <x-text-input id="mail_username" class="block mt-1 w-full" type="text" name="mail_username"
                        :value="old('mail_username')" required autofocus autocomplete="mail_username" />
                    <x-input-error :messages="$errors->get('mail_username')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="mail_password" :value="__('Password')" />
                    <x-text-input id="mail_password" class="block mt-1 w-full" type="password" name="mail_password"
                        :value="old('mail_password')" required autofocus autocomplete="mail_password" />
                    <x-input-error :messages="$errors->get('mail_password')" class="mt-2" />
                </div>

                <!-- Encryption -->
                <div>
                    <x-input-label for="mail_encryption" :value="__('Encryption')" />
                    <select id="mail_encryption" name="mail_encryption" class="block mt-1 w-full">
                        <option value="" disabled selected></option>
                        <option value="ssl" {{ old('mail_encryption') == 'ssl' ? 'selected' : '' }}>SSL</option>
                        <option value="tls" {{ old('mail_encryption') == 'tls' ? 'selected' : '' }}>TLS</option>
                    </select>
                    <x-input-error :messages="$errors->get('mail_encryption')" class="mt-2" />
                </div>

                <!-- From Address -->
                <div>
                    <x-input-label for="mail_from_address" :value="__('From Address')" />
                    <x-text-input id="mail_from_address" class="block mt-1 w-full" type="text"
                        name="mail_from_address" :value="old('mail_from_address')" required autofocus
                        autocomplete="mail_from_address" />
                    <x-input-error :messages="$errors->get('mail_from_address')" class="mt-2" />
                </div>

                <!-- From Name -->
                <div>
                    <x-input-label for="mail_from_name" :value="__('From Name')" />
                    <x-text-input id="mail_from_name" class="block mt-1 w-full" type="text" name="mail_from_name"
                        :value="old('mail_from_name')" required autofocus autocomplete="mail_from_name" />
                    <x-input-error :messages="$errors->get('mail_from_name')" class="mt-2" />
                </div>

                <!-- Status -->
                <div>
                    <x-input-label for="status" :value="__('Status')" />
                    <select id="status" name="status" class="block mt-1 w-full">
                        <option disabled selected></option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div> --}}
</x-admin-app-layout>
