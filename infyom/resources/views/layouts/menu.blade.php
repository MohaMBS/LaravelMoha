<li class="nav-item">
    <a href="{{ route('coches.index') }}"
       class="nav-link {{ Request::is('coches*') ? 'active' : '' }}">
        <p>Coches</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cilientes.index') }}"
       class="nav-link {{ Request::is('cilientes*') ? 'active' : '' }}">
        <p>Cilientes</p>
    </a>
</li>


