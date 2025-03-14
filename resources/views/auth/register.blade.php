<x-guest-layout>
    <div class="bg-white shadow-lg rounded-2xl p-4 md:p-6 lg:p-8 w-full max-w-xs md:max-w-md relative mx-2">
        <!-- Logo -->
        <div class="flex justify-center -mt-10 md:-mt-14">
            <img src="{{ asset('logo.png') }}" class="h-12 md:h-16 bg-white p-1 md:p-2 rounded-full shadow-md"
                alt="Logo" />
        </div>

        <h2 class="text-center text-lg md:text-xl font-semibold text-blue-600 mt-3 md:mt-4">Create an Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mt-4 md:mt-6">
                <label for="name" class="block text-sm md:text-base font-medium text-gray-700">Full Name</label>
                <input id="name" type="text" name="name"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 md:p-3 text-sm md:text-base"
                    required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs md:text-sm" />
            </div>

            <!-- Email -->
            <div class="mt-3 md:mt-4">
                <label for="email" class="block text-sm md:text-base font-medium text-gray-700">Email Address</label>
                <input id="email" type="email" name="email"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 md:p-3 text-sm md:text-base"
                    required autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs md:text-sm" />
            </div>

            <!-- Password -->
            <div class="mt-3 md:mt-4">
                <label for="password" class="block text-sm md:text-base font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 md:p-3 text-sm md:text-base"
                    required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs md:text-sm" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-3 md:mt-4">
                <label for="password_confirmation" class="block text-sm md:text-base font-medium text-gray-700">
                    Confirm Password
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 md:p-3 text-sm md:text-base"
                    required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs md:text-sm" />
            </div>

            <!-- Register Button -->
            <div class="mt-4 md:mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 md:py-3 rounded-lg shadow-md hover:bg-blue-600 transition text-sm md:text-base">
                    REGISTER
                </button>
            </div>

            <!-- Login Link -->
            <div class="text-center mt-3 md:mt-4 text-xs md:text-sm text-blue-500">
                <a href="{{ route('login') }}" class="hover:underline">Already registered? Login here</a>
            </div>
        </form>
    </div>

</x-guest-layout>
