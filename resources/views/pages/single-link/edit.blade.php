<x-layout>
    <x-slot name="head">
        <title>Link Edit</title>
    </x-slot>
    <form action="/{{ $link->code }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
            <div class="sm:col-span-4">
                <label class="block text-sm/6 font-medium text-gray-300">
                    <span>Redirect To</span>
                    <input type="url" name="link" autocomplete="family-name" value="{{ $link->link }}"
                        class="block w-full rounded-md bg-slate-700 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-gray-800 placeholder:text-white focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </label>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm/6 font-medium text-gray-300">
                    <span>Redirect From</span>
                    <input type="url" readonly value="{{ $link->redirect_from }}"
                        class="block w-full rounded-md bg-slate-700 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-gray-800 placeholder:text-white focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </label>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm/6 font-medium text-gray-300">
                    <span>Updated At</span>
                    <input type="url" readonly value="{{ $link->updated_at }}"
                        class="block w-full rounded-md bg-slate-700 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-gray-800 placeholder:text-white focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </label>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm/6 font-medium text-gray-300">
                    <span>Created At</span>
                    <input type="url" readonly value="{{ $link->created_at }}"
                        class="block w-full rounded-md bg-slate-700 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-gray-800 placeholder:text-white focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </label>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm/6 font-medium text-gray-300">
                    <span>Access Count</span>
                    <input type="number" readonly value="{{ $link->access_count }}"
                        class="block w-full rounded-md bg-slate-700 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-gray-800 placeholder:text-white focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </label>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <div class="mr-auto">
                <button type="submit"
                    class="shadow-xs ml-1 rounded-md bg-indigo-600 px-6 py-2 text-sm font-semibold text-white hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                <button type="submit" form="deleteForm"
                    class="shadow-xs rounded-md bg-red-600 px-6 py-2 text-sm font-semibold text-white hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Delete</button>
            </div>
            @if ($errors->any())
                <div class="text-red-700">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('message'))
                <div class="text-green-700">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
    </form>
    <form id="deleteForm" class="hidden" action="/{{ $link->code }}" method="POST">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
