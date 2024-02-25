<x-admin-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-bold text-xl mb-4">Category Name: <p class="text-gray-500">{{ $category->name }}</p>
                    </h2>

                    <div class="mb-4">
                        <p><strong>ID:</strong> {{ $category->id }}</p>
                        <p><strong>Name:</strong> {{ $category->name }}</p>
                        <p><strong>Slug:</strong> {{ $category->slug }}</p>
                        <p><strong>Status:</strong> {{ $category->status == 1 ? 'Active' : 'Inactive' }}</p>
                        <p><strong>Created At:</strong> {{ $category->created_at->format('F j, Y, g:i a') }}</p>
                        <p><strong>Last Updated:</strong> {{ $category->updated_at->format('F j, Y, g:i a') }}</p>
                    </div>

                    @if ($category->parent)
                        <div class="mb-4">
                            <p><strong>Parent Category:</strong> {{ $category->parent->name }}</p>
                        </div>
                    @endif

                    @if ($category->children->isNotEmpty())
                        <div class="mb-4">
                            <p><strong>Child Categories ({{ $category->children->count() }}):</strong></p>
                            <ul class="list-disc pl-5">
                                @foreach ($category->children as $child)
                                    <li>
                                        <strong>Child:</strong> {{ $child->name }}
                                        @if ($child->children->isNotEmpty())
                                            <ul class="list-disc pl-5">
                                                @foreach ($child->children as $grandchild)
                                                    <li><strong>Grandchild:</strong> {{ $grandchild->name }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
