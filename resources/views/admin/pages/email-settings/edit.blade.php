<x-admin-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.email-settings.update', $emailSetting) }}">
                @csrf
                @method('PUT')

                <!-- Mailer -->
                <div>
                    <x-input-label for="mail_mailer" :value="__('Mailer')" />
                    <x-text-input id="mail_mailer" class="block mt-1 w-full" type="text" name="mail_mailer"
                        :value="$emailSetting->mail_mailer" required autofocus autocomplete="mail_mailer" />
                    <x-input-error :messages="$errors->get('mail_mailer')" class="mt-2" />
                </div>

                <!-- Host -->
                <div>
                    <x-input-label for="mail_host" :value="__('Host')" />
                    <x-text-input id="mail_host" class="block mt-1 w-full" type="text" name="mail_host"
                        :value="$emailSetting->mail_host" required autofocus autocomplete="mail_host" />
                    <x-input-error :messages="$errors->get('mail_host')" class="mt-2" />
                </div>

                <!-- Port -->
                <div>
                    <x-input-label for="mail_port" :value="__('Port')" />
                    <x-text-input id="mail_port" class="block mt-1 w-full" type="text" name="mail_port"
                        :value="$emailSetting->mail_port" required autofocus autocomplete="mail_port" />
                    <x-input-error :messages="$errors->get('mail_port')" class="mt-2" />
                </div>

                <!-- Username -->
                <div>
                    <x-input-label for="mail_username" :value="__('Username')" />
                    <x-text-input id="mail_username" class="block mt-1 w-full" type="text" name="mail_username"
                        :value="$emailSetting->mail_username" required autofocus autocomplete="mail_username" />
                    <x-input-error :messages="$errors->get('mail_username')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="mail_password" :value="__('Password')" />
                    <x-text-input id="mail_password" class="block mt-1 w-full" type="password" name="mail_password"
                        :value="$emailSetting->mail_password" required autofocus autocomplete="mail_password" />
                    <x-input-error :messages="$errors->get('mail_password')" class="mt-2" />
                </div>

                <!-- Encryption -->
                <div>
                    <x-input-label for="mail_encryption" :value="__('Encryption')" />
                    <select id="mail_encryption" name="mail_encryption" class="block mt-1 w-full">
                        <option value="" disabled>Select encryption</option>
                        <option value="ssl" {{ $emailSetting->mail_encryption == 'ssl' ? 'selected' : '' }}>SSL
                        </option>
                        <option value="tls" {{ $emailSetting->mail_encryption == 'tls' ? 'selected' : '' }}>TLS
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('mail_encryption')" class="mt-2" />
                </div>

                <!-- From Address -->
                <div>
                    <x-input-label for="mail_from_address" :value="__('From Address')" />
                    <x-text-input id="mail_from_address" class="block mt-1 w-full" type="text"
                        name="mail_from_address" :value="$emailSetting->mail_from_address" required autofocus
                        autocomplete="mail_from_address" />
                    <x-input-error :messages="$errors->get('mail_from_address')" class="mt-2" />
                </div>

                <!-- From Name -->
                <div>
                    <x-input-label for="mail_from_name" :value="__('From Name')" />
                    <x-text-input id="mail_from_name" class="block mt-1 w-full" type="text" name="mail_from_name"
                        :value="$emailSetting->mail_from_name" required autofocus autocomplete="mail_from_name" />
                    <x-input-error :messages="$errors->get('mail_from_name')" class="mt-2" />
                </div>

                <!-- Status -->
                <div>
                    <x-input-label for="status" :value="__('Status')" />
                    <select id="status" name="status" class="block mt-1 w-full">
                        <option value="1" {{ $emailSetting->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $emailSetting->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-app-layout>
