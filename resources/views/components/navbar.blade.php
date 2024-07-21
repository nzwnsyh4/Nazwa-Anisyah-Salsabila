 <style>

                            .navbar {
                                background-color: #ffa1cb; /* Ganti kode warna dengan warna yang Anda inginkan */
                            }

                                </style>

                        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
                            <div class="container"><a class="navbar-brand" href="{{ url('/') }}"><img class="d-inline-block"
                                        src="{{ asset('assets/voyage') }}/assets/img/gallery/logo.png" width="50" alt="logo" /><span
                                        class="fw-bold text-primary ms-3">Air Wing Tickets</span></a>
                                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                                    <ul class="navbar-nav mx-auto pt-2 pt-lg-0 font-base">

                                    </ul>
                                    <div>
                                        @if (!Auth::check())
                                        <!--<button onclick="window.location.reload()" class="btn btn-light refresh-button">Refresh</button>-->
                                            <a href="{{ route('auth.login') }}"><span
                                                    class="btn btn-primary">Sign
                                                    in</span></a>
                                        @else
                                            <div class="dropdown custom-dropdown">
                                                <a href="#" data-bs-toggle="dropdown"
                                                    class="d-flex align-items-center dropdown-link text-left" aria-haspopup="true"

                                                </a>


                          <div class="collapse navbar-collapse" id="navbarNav">
                            <center><div class="profile-info">
                                <h3>Hello {{ Auth::user()->name }}!</h3>
                                <!--<span>Indonesia, JKT</span>-->
                            </div></center>
                        
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    @if (!Auth::user()->hasRole(1) && !Auth::user()->hasRole(2))
                                    <a class="nav-link" href="{{ route('home.index') }}"><i
                                    class=" fa-solid fa-home mx-2"></i>Home </a>
                                    @endif
                                  </li>
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    @if (Auth::user()->hasRole(1) || Auth::user()->hasRole(2))
                                    <a class="nav-link" href="{{ route('admin.index') }}"><i
                                    class=" fa-solid fa-user-circle mx-2"></i>Admin </a>
                        @endif
                                  </li>

                                  <li class="nav-item">
                                    @if (!Auth::user()->hasRole(1) && !Auth::user()->hasRole(2))
                                    <a class="nav-link" href="{{ route('profile.index') }}"><i
                                      class=" fa-solid fa-user mx-2"></i>Profile</a>
                                      @endif
                                  </li>

                              <li class="nav-item">
                                @if (!Auth::user()->hasRole(1) && !Auth::user()->hasRole(2))
                                <a class="nav-link" href="{{ route('pesanan.index') }}"><i
                                  class=" fa-solid fa-cart-plus mx-2"></i>Pesanan <span
                                  class="number">{{ Auth::user()->Pesanan->count() }}</span></a>
                                  @endif
                              </li>
                              <li class="nav-item">
                                @if (!Auth::user()->hasRole(1) && !Auth::user()->hasRole(2))
                                <a class="nav-link" href="{{ route('tickets.index') }}"><i
                                  class=" fa-solid fa-ticket mx-2"></i>My
                              Tickets <span class="number">{{ Auth::user()->Ticket->count() }}</span></a>
                              @endif
                              </li>
                              <li class="nav-item">
                                @if (!Auth::user()->hasRole(1) && !Auth::user()->hasRole(2))
                              <a class="nav-link logout" href="javascript:;"><i
                                class="fa-solid fa-right-from-bracket mx-2"></i>Logout</a>
                                @endif
                            </li>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</nav>



