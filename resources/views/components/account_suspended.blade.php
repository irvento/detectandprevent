<div class="p-6 bg-red-100 dark:bg-red-900 rounded-lg">
    <div class="flex items-center justify-center mb-4">
        <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
    </div>
    
    <h2 class="text-2xl font-bold text-center text-red-700 dark:text-red-300 mb-4">
        Account Suspended
    </h2>
    
    <div class="text-center text-red-600 dark:text-red-400 mb-4">
        <p class="mb-2">Your account has been suspended for security reasons.</p>
        <p class="mb-2">Suspension will be lifted on: {{ auth()->user()->suspended_until->format('Y-m-d H:i:s') }}</p>
        <p>Please contact an administrator if you believe this is an error.</p>
    </div>

    <div class="mt-6 text-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Logout
            </button>
        </form>
    </div>
</div>
