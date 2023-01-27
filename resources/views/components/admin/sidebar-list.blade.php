@props(['linkActive', 'route', 'icon'])

<li class="nav-item">
    <a href="{{ route($route) }}" class="nav-link {{ $linkActive ? 'active' : '' }}">
        <i class="nav-icon {{ $icon }}"></i>
        <p>{{ $slot }} </p>
    </a>
</li>
