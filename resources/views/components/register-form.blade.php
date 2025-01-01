<div class="p-3">
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Create an account
    </h1>
    <form class="space-y-4 md:space-y-6" action="/register" method="POST">
        @csrf
        <div>
            <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Your name
            </label>
            <input type="text" name="name" id="name"
                class="focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder="Your name" required value="{{ old('name') }}">
            @error('name')
                <p class="mt-1 text-xs font-semibold text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Your email
            </label>
            <input type="email" name="email" id="email"
                class="focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder="name@company.com" required value="{{ old('email') }}">
            @error('email')
                <p class="mt-1 text-xs font-semibold text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••••"
                class="focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                required>
            @error('password')
                <p class="mt-1 text-xs font-semibold text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <button type="submit"
            class="w-full rounded-lg bg-blue-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
            an account</button>
        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
            Already have an account?
            <a href="/login" class="text-primary-600 dark:text-primary-500 font-medium hover:underline">Login
                here</a>
        </p>
    </form>
</div>
