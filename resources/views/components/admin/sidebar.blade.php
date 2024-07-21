<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                @can('maskapai')
                    <li class="menu-title">Maskapai</li><!-- /.menu-title -->
                    <li>
                        <a href="{{ route('admin.maskapai.index') }}"> <i class="menu-icon fa fa-plane"></i>Maskapai </a>
                    </li>
                @endcan
                
                @can('product')
        <li class="menu-title">Penerbangan</li>
        <li>
            <a href="{{ route('admin.products.index') }}"> <i class="menu-icon fa fa-file-text"></i>Data Penerbangan
            </a>
        </li>

@endcan


                @can('confirmation')
                    <li class="menu-title">Pesanan</li>
                    <li>
                        <a href="{{ route('admin.pesanan.index') }}"> <i class="menu-icon fa fa-sticky-note"></i>Pesanan
                        </a>
                    </li>
                @endcan

                @can('confirmation')
                @if (Auth::user()->hasRole(1) && Auth::user()->hasRole(2))
                <li class="menu-title ">Users</li><!-- /.menu-title -->
                <li>
                    <a href="{{ route('admin.user.index') }}"> <i class="menu-icon fa fa-user"></i>Data User
                    </a>
                </li>
                @endif
            @endcan

   @can('confirmation')
                <li class="menu-title ">Back</li>
   <li><a href="{{ route('logout') }}" class="mb-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="menu-icon fa fa-sign-out"></i>
    {{ __('Logout') }}
</a></li>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>@endcan
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
