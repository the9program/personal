<header id="header" class="header">
    <div class="header-nav">
        <div class="header-nav-wrapper navbar-scrolltofixed bg-lightest">
            <div class="container">
                <nav id="menuzord-right" class="menuzord blue bg-lightest">
                    <a class="menuzord-brand pull-left flip" href="javascript:void(0)">
                        <img src="{{ asset('images/logo-wide.png') }}" alt="LY" title="LY">
                    </a>
                    <div id="side-panel-trigger" class="side-panel-trigger"><a href="#"><i
                                    class="fa fa-bars font-24 text-gray"></i></a></div>
                    <ul class="menuzord-menu">
                        <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/"><i class="fa fa-home"></i>Accueil</a></li>

                        <li class="{{ request()->is('login') ? 'active' : '' }}">
                            <a href="{{ route('login') }}">
                                <i class="fa fa-user"></i>
                                Se Connecter
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
