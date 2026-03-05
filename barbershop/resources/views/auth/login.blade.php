<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gray-200">

    <div class="bg-zinc-900 text-white w-[420px] p-10 rounded-3xl shadow-xl">

        <h2 class="text-3xl font-bold text-center mb-8">
            Login Account
        </h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email / Username -->
            <div>
                <input
                    id="email"
                    type="text"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="username / @gmail.com"
                    required
                    autofocus
                    class="w-full px-5 py-3 rounded-xl bg-gray-200 text-black focus:outline-none"
                >
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <!-- Password -->
            <div>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="password"
                    required
                    class="w-full px-5 py-3 rounded-xl bg-gray-200 text-black focus:outline-none"
                >
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <!-- Register Link -->
            <div class="text-center text-sm text-gray-300">
                Don't have an account yet?
                <a href="{{ route('register') }}" class="underline">
                    Register
                </a>
            </div>

            <!-- Login Button -->
            <div class="flex justify-center">
                <button
                    type="submit"
                    class="bg-white text-black px-8 py-2 rounded-full font-semibold hover:bg-gray-200 transition">
                    Login
                </button>
            </div>

        </form>

    </div>

</div>

</x-guest-layout>