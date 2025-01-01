<nav class="flex gap-2">
    <x-layout.header.nav-link href="/">Shorten it</x-layout.header.nav-link>
    <x-layout.header.nav-link href="/links">My Links</x-layout.header.nav-link>
    @guest
        <x-layout.header.nav-link href="/login">Log in</x-layout.header.nav-link>
        <x-layout.header.nav-link href="/register">Register</x-layout.header.nav-link>
    @endguest
    @auth
        <x-layout.header.nav-link href="/logout">Log Out</x-layout.header.nav-link>
    @endauth
</nav>
