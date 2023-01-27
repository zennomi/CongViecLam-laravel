<li class="nav-item">
    @if ($parameter)
        <a href="{{ route($route, $parameter) }}" class="nav-link {{ $linkActive ? 'active' : '' }}">
            <i class="nav-icon {{ $icon }}"></i>
            <p>{{ $slot }} </p>
        </a>
    @else
        <a href="{{ route($route) }}" class="nav-link {{ $linkActive ? 'active' : '' }}">
            <i class="nav-icon {{ $icon }}"></i>
            <p>{{ $slot }} </p>
        </a>
    @endif
</li>
