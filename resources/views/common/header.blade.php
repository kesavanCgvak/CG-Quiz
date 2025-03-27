
  <header class="navbar navbar-inverse navbar-fixed-top navbar-glass">

    <ul class="nav navbar-nav-custom">

        <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">


                    <p class="sidebar-title navbar-brand">
                        <img src="{{ url('public/img/logo.png') }}" >
                    </p>

        </div>

        <!--					<li>
                                                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                                                <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                                                                <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
                                                        </a>
                                                </li>-->

        <!--					<li class="hidden-xs animation-fadeInQuick">
                                                        <a href=""><strong>WELCOME</strong></a>
                                                </li>-->
    </ul>
    <ul class="nav navbar-nav-custom pull-right">
         <li>

        </li>
        <li class="dropdown">
        @if(session()->has('user_id'))
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img style="background-color:black;" src="{{ url('public/img/placeholders/avatars/avatar9.jpg') }}" alt="avatar">
            </a>

            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">
                   <strong>Hi
                    {{ session('user_name') }}
                    </strong>
                </li>

                   <!-- <li>
                                    <a href="{{ url('change-pwd') }}">Channge Password</a>
                                    </li> -->
                <li>
                    <a href="{{ route('logout') }}" >
                        <i class="fa fa-power-off fa-fw pull-right"></i> Log out
                    </a>
                    {{--<form id="frm-logout" action="" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>--}}
                </li>
            </ul>
            @endif
        </li>
    </ul>



</header>
