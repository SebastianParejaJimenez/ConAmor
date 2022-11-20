<li class="menu-header">General</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/home">
        <i class="fas fa-columns"></i><span>Menu</span>
    </a>
</li>
<li class="menu-header">Usuarios</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
    <a class="nav-link" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>
    
</li>
<li class="menu-header">Proveedores</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/proveedores">
        <i class="fas fa-truck"></i><span>Proveedores</span>
    </a>

</li>

<li class="menu-header">Documentos</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/productos">
        <i class=" far fa-file-alt"></i><span>Documentos</span>
    </a>

</li>

<li class="menu-header">Productos</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/productos">
        <i class=" fas fa-user"></i><span>Productos</span>
    </a>

</li>

