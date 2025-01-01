@php
    $isActive = url($href) === url()->full();
@endphp

<a {{ $attributes->class(['border-b-2' => $isActive]) }} href="{{ $href }}">{{ $slot }}</a>
