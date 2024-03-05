<x-admin-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Causer Type</th>
                                <th class="px-4 py-2">Causer</th>
                                <th class="px-4 py-2">Event</th>
                                <th class="px-4 py-2">Subject Type</th>
                                <th class="px-4 py-2">Subject</th>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activityLogs as $log)
                                <tr>
                                    <td class="border px-4 py-2">{{ $log->user_type }}</td>
                                    <td class="border px-4 py-2">{{ $log->user_id }}</td>
                                    <td class="border px-4 py-2">{{ $log->description }}</td>
                                    <td class="border px-4 py-2">{{ $log->subject_type }}</td>
                                    <td class="border px-4 py-2">{{ $log->subject_id }}</td>
                                    <td class="border px-4 py-2">{{ $log->created_at->format('F j, Y, g:i a') }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('admin.activity_logs.show', $log->id) }}"
                                            class="text-blue-500 hover:text-blue-700">Show</a>
                                        <form action="{{ route('admin.activity_logs.destroy', $log->id) }}"
                                            method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
