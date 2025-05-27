<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-4">
                @if(auth()->user()->is_suspended == 1)
                    <x-account_suspended />
                @else
                    <x-welcome />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>