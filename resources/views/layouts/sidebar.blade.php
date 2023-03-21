<aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/home">ConAmor</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">C.A</a>
        </div>
    <ul class="sidebar-menu">
        @if($rol===2) 
            @include('layouts.menuuser')
        @endif
        @if($rol===1) 
        @include('layouts.menu')
        @endif
        

    </ul>
</aside>
