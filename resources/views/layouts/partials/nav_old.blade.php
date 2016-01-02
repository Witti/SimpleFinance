<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->

        <nav class="navbar navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        SimpleFinance
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (!Auth::guest())
                            <li><a href="{{ url('/home') }}">Home</a></li>
                            <li><a href="{{ url('/account') }}">Accounts</a></li>
                            <li><a href="{{ url('/category') }}">Categories</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Transactions <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @if(!Auth::guest())
                                        @foreach($accounts as $account)
                                            <li><a href="{{ url('/transaction/account', ['id' => $account->id]) }}">{{ $account->title }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Add Transaction <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @if(!Auth::guest())
                                        @foreach($accounts as $account)
                                            <li><a href="{{ url('/transaction/create/account', ['id' => $account->id]) }}">{{ $account->title }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>