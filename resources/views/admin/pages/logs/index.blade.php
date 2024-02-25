<x-admin-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Logs Table') }}
            </h2>
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
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Last Modified
                            </th>
                            <th scope="col" class="px-6 py-3">
                                File Size
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $log['name'] }}
                                </td>
                                <td x-data="{ date: '{{ $log['date'] }}' }" x-text="date" x-init="setInterval(() => date = new Date().toLocaleString(), 1000)">
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $log['last_modified'] }}
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $log['size'] }}
                                </td>
                                <td>
                                    <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{ route('admin.log.show', $log['name']) }}">Preview</a>
                                    <a class="font-medium text-teal-600 dark:text-teal-600 hover:underline" href="{{ route('admin.log.download', $log['name']) }}">Download</a>
                                    <form action="{{ route('admin.log.destroy', $log['name']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="font-medium text-red-600 dark:text-red-600 hover:underline" type="submit">Delete</button>
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
