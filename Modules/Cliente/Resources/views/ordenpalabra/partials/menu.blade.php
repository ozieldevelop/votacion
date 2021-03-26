<aside class="main-sidebar">
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menú</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ request()->is('ordenpab/crear') ? 'active' : '' }}">
                <a href="{{ route('orden.create') }}"><i class="fa fa-code-fork"></i> <span>Registro de Temas</span></a>
            </li>
            <li class="{{ request()->is('ordenpab/suscriptores') ? 'active' : '' }}">
                <a href="{{ route('orden.suscriptores') }}"><i class="fa fa-users"></i> <span>Suscribir a Temas</span></a>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>