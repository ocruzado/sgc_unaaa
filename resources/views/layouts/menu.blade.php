@inject('cls_funcion','App\Http\Controllers\FuncionesController')


    <li class="menu-title">APP</li>

    <li>
        <a href="{{ route('home') }}" class="waves-effect">
            <i class="ri-home-line"></i>
            <span>Inicio</span>
        </a>
    </li>

    @if($cls_funcion->acceso_modulo(Auth::user()->id,1)!=0)
    <li>
        <a href="{{ route('usuarios') }}" class=" waves-effect">
            <i class="ri-user-2-line"></i>
            <span>Usuarios</span>
        </a>
    </li>
    @endif

@if($cls_funcion->acceso_modulo(Auth::user()->id,2)!=0)
    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class=" ri-award-line"></i>
            <span>LICENCIAMIENTO</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            @if($cls_funcion->acceso_modulo(Auth::user()->id,4)!=0)
                <li><a href="{{ route('lic_inicio') }}">Mantenimiento</a></li>
            @endif

            @if($cls_funcion->acceso_modulo(Auth::user()->id,5)!=0)
                <li><a href="#">Reportes</a></li>
            @endif
        </ul>
    </li>
@endif





    <li class="menu-title">Mantenimiento</li>

    @if($cls_funcion->acceso_modulo(Auth::user()->id,3)!=0)
    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class=" ri-settings-3-line"></i>
            <span>MANTENIMIENTO</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            @if($cls_funcion->acceso_modulo(Auth::user()->id,6)!=0)
                <li><a href="{{ route('mante_oficinas') }}">Oficinas</a></li>
            @endif

            @if($cls_funcion->acceso_modulo(Auth::user()->id,7)!=0)
                <li><a href="{{ route('mante_modulos') }}">Módulos del sistema</a></li>
            @endif
        </ul>
    </li>
    @endif