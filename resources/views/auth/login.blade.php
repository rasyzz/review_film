<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="bg-white shadow-lg rounded-2xl p-4 md:p-6 lg:p-9 w-full max-w-xs md:max-w-md relative mx-2">
        <!-- Logo -->
        <div class="flex justify-center -mt-10 md:-mt-14">
            <img src="{{ asset('logo.png') }}" class="h-12 md:h-16 bg-white p-1 md:p-2 rounded-full shadow-md" alt="Logo" />
        </div>
    
        <h2 class="text-center text-lg md:text-xl font-semibold text-blue-600 mt-3 md:mt-4">Login Now</h2>
    
        <form method="POST" action="{{ route('login') }}">
            @csrf
    
            <!-- Email Address -->
            <div class="mt-4 md:mt-6">
                <label for="email" class="block text-sm md:text-base font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 md:p-3 text-sm md:text-base">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-3 md:mt-4">
                <label for="password" class="block text-sm md:text-base font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 md:p-3 text-sm md:text-base">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Remember Me -->
            <div class="flex items-center mt-3 md:mt-4">
                <input id="remember_me" type="checkbox"
                    class="w-4 h-4 md:w-5 md:h-5 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <label for="remember_me" class="ml-2 text-xs md:text-sm text-gray-600">Remember me</label>
            </div>
    
            <!-- Login Button -->
            <div class="mt-4 md:mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 md:py-3 rounded-lg shadow-md hover:bg-blue-600 transition text-sm md:text-base">
                    LOGIN
                </button>
            </div>
    
            <!-- Links -->
            <div class="flex flex-col md:flex-row justify-between mt-3 md:mt-4 space-y-2 md:space-y-0 text-xs md:text-sm text-blue-500">
                <a href="{{ route('register') }}" class="hover:underline text-center md:text-left">Don't have an account?</a>
                <a href="{{ route('password.request') }}" class="hover:underline text-center md:text-right">Forgot password?</a>
            </div>
        </form>
    </div>

</x-guest-layout>
