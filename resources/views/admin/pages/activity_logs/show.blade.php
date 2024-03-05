<x-admin-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Activity Log Details</h1>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="causer_type">Causer Type</label>
                        <p id="causer_type" class="border p-2">{{ $activityLog->user_type }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="causer">Causer</label>
                        <p id="causer" class="border p-2">{{ $activityLog->user_id }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="event">Event</label>
                        <p id="event" class="border p-2">{{ $activityLog->description }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="subject_type">Subject Type</label>
                        <p id="subject_type" class="border p-2">{{ $activityLog->subject_type }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="subject">Subject</label>
                        <p id="subject" class="border p-2">{{ $activityLog->subject_id }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="date">Date</label>
                        <p id="date" class="border p-2">{{ $activityLog->created_at->format('F j, Y, g:i a') }}</p>
                    </div>

                    <a href="{{ route('admin.activity_logs.index') }}" class="text-blue-500 hover:text-blue-700">Back to Activity Logs</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>