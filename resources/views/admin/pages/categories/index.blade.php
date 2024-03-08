<x-admin-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Category Table') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}"
                class="px-4 py-2 text-sm text-white bg-green-600 rounded hover:bg-blue-600 text-center">Create
                Category</a>
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
                                Slug
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Parent
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $category->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $category->slug }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $category->parent_id ? $category->parent->name : 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.categories.show', $category->id) }}"
                                        class="text-green-500 hover:text-green-700">Show</a>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @foreach ($category->children as $child)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->parent->iteration }}.{{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4">
                                        -- {{ $child->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $child->slug }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $child->parent->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.categories.show', $child->id) }}"
                                            class="text-green-500 hover:text-green-700">Show</a>
                                        <a href="{{ route('admin.categories.edit', $child->id) }}"
                                            class="text-blue-500 hover:text-blue-700">Edit</a>
                                        <form action="{{ route('admin.categories.destroy', $child->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
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
