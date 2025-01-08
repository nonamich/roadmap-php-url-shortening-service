<x-layout>
    <x-slot name="head">
        <title>Links</title>
    </x-slot>
    @if (!$links->isEmpty())
        <x-links :$links />
    @else
        <h1>Empty</h1>
    @endif
</x-layout>
