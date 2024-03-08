<x-admin-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Email Settings') }}
            </h2>
            <a href="{{ route('admin.email-settings.create') }}"
                class="px-4 py-2 text-sm text-white bg-green-600 rounded hover:bg-blue-600 text-center">Create
                Email Setting</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Sl
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Mailer
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Host
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Port
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Encryption
                            </th>
                            <th scope="col" class="px-6 py-3">
                                From Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                From Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($emailSettings as $emailSetting)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $emailSetting->mail_mailer }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $emailSetting->mail_host }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $emailSetting->mail_port }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $emailSetting->mail_username }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $emailSetting->mail_encryption }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $emailSetting->mail_from_address }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $emailSetting->mail_from_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $emailSetting->status ? 'Active' : 'In Active' }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.email-settings.edit', $emailSetting->id) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <form action="{{ route('admin.email-settings.destroy', $emailSetting->id) }}"
                                        method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="bg-red-100 border border-fuchsia-400 text-fuchsia-700 px-4 py-3 rounded grid"
                                role="alert">
                                <strong class="font-bold text-center">No Record Found</strong>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-app-layout>
