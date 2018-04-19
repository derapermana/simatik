<li {{{ (Request::is('home') ? 'class=active' : '') }}}>
    <a href="{{ url('home') }}">
    Dashboard <span {{{ (Request::is('home') ? 'class=selected' : '') }}}>
    </span>
    </a>
</li>
@can('server.b')
    <li {{{ (Request::is('servers/*') || Request::is('servers') ? 'class=active' : '') }}}>
        <a href="{{ route('servers') }}">
            Server <span {{{ (Request::is('servers/*') || Request::is('servers') ? 'class=selected' : '') }}}>
    </span>
        </a>
    </li>
@endcan
@can('person.b')
<li {{{ (Request::is('persons/*') || Request::is('persons') ? 'class=active' : '') }}}>
    <a href="{{ route('persons') }}">
    Pengelola TIK <span {{{ (Request::is('persons/*') || Request::is('persons') ? 'class=selected' : '') }}}>
    </span>
    </a>
</li>
@endcan
@can('license.b')
<li {{{ (Request::is('licenses/*') || Request::is('licenses') ? 'class=active' : '') }}}>
    <a href="{{ route('licenses') }}">
    Lisensi <span {{{ (Request::is('licenses/*') || Request::is('licenses') ? 'class=selected' : '') }}}>
    </span>
    </a>
</li>
@endcan
@can('application.b')
    <li {{{ (Request::is('applications/*') || Request::is('applications') ? 'class=active' : '') }}}>
        <a href="{{ route('applications') }}">
            Aplikasi <span {{{ (Request::is('applications/*') || Request::is('applications') ? 'class=selected' : '') }}}>
    </span>
        </a>
    </li>
@endcan
@can('subdomain.b')
    <li {{{ (Request::is('subdomains/*') || Request::is('subdomains') ? 'class=active' : '') }}}>
        <a href="{{ route('subdomains') }}">
            Subdomain <span {{{ (Request::is('subdomains/*') || Request::is('subdomains') ? 'class=selected' : '') }}}>
    </span>
        </a>
    </li>
@endcan
@can('ip_address.b')
    <li {{{ (Request::is('ip_addresses/*') || Request::is('ip_addresses') ? 'class=active' : '') }}}>
        <a href="{{ route('ip_addresses') }}">
            Alamat IP <span {{{ (Request::is('ip_addresses/*') || Request::is('ip_addresses') ? 'class=selected' : '') }}}>
    </span>
        </a>
    </li>
@endcan
{{--  <li class="classic-menu-dropdown">
    <a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
    Classic <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu pull-left">
        <li>
            <a href="#">
            <i class="fa fa-bookmark-o"></i> Section 1 </a>
        </li>
        <li>
            <a href="#">
            <i class="fa fa-user"></i> Section 2 </a>
        </li>
        <li>
            <a href="#">
            <i class="fa fa-puzzle-piece"></i> Section 3 </a>
        </li>
        <li>
            <a href="#">
            <i class="fa fa-gift"></i> Section 4 </a>
        </li>
        <li>
            <a href="#">
            <i class="fa fa-table"></i> Section 5 </a>
        </li>
        <li class="dropdown-submenu">
            <a href="javascript:;">
            <i class="fa fa-envelope-o"></i> More options </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#">
                    Second level link </a>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:;">
                    More options </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.html">
                            Third level link </a>
                        </li>
                        <li>
                            <a href="index.html">
                            Third level link </a>
                        </li>
                        <li>
                            <a href="index.html">
                            Third level link </a>
                        </li>
                        <li>
                            <a href="index.html">
                            Third level link </a>
                        </li>
                        <li>
                            <a href="index.html">
                            Third level link </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="index.html">
                    Second level link </a>
                </li>
                <li>
                    <a href="index.html">
                    Second level link </a>
                </li>
                <li>
                    <a href="index.html">
                    Second level link </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li>
    <a href="">
    Link </a>
</li>  --}}
