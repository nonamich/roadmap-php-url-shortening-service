<div>
    <h1 class="text-center text-xl font-bold text-gray-800 sm:text-3xl dark:text-white">Paste the URL to be shortened
    </h1>
    <form action="/" method="POST">
        @csrf
        <div class="mb-4 mt-4">
            <input type="url" name="link"
                class="text-md w-full rounded-lg border border-neutral-700 px-4 py-3 focus:border-blue-500 focus:outline-none dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500"
                placeholder="https://example.com" required>
        </div>
        @if ($errors->any())
            <div class="mb-4 mt--1 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <button type="submit"
                class="text-md inline-flex w-full items-center justify-center rounded-lg border border-transparent bg-blue-600 px-4 py-3 font-medium text-white hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">Submit</button>
        </div>
    </form>
</div>
