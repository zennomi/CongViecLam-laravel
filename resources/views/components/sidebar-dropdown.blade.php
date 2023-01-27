<li class="nav-item has-treeview {{ $linkActive ? 'menu-open' : '' }}">
    <a href="javascript:void(0)"
        class="nav-link {{ $subLinkActive ? 'active' : '' }}">
        <i class="nav-icon {{ $icon }}"></i>
        <p>{{ $title }} <i class="right fas fa-angle-left"></i></p>
    </a>
    {{ $slot }}
</li>
