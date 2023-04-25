<li class="menu-header">General</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/home') }}">
        <i class="fas fa-columns"></i><span>Menu</span>
    </a>
</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/clientes') }}">
        <i class="fas fa-user-tag"></i><span>Clientes</span>
    </a>

</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/facturas') }}">
        <i class="fas fa-money-bill"></i><span>Ventas</span>
    </a>
</li>

<li class="menu-header">Productos</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/productos') }}">
        <i class="fas fa-archive"></i><span>Productos</span>
    </a>
</li>

<li class="menu-header">Proveedores</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/proveedores') }}">
        <i class="fas fa-truck"></i><span>Proveedores</span>
    </a>

</li>

<li class="menu-header">Documentos</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/documentos') }}">
        <i class=" far fa-file-alt"></i><span>Documentos</span>
    </a>

</li>

