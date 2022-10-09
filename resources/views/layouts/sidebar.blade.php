<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="{{ request()->is('user/dashboard') ? 'active' : 'nav-item' }}"><a href="/user/dashboard"><i
                    class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
        </li>
        <li class="{{ request()->is('major') ? 'active' : 'nav-item' }} "><a href="/major/"><i
                    class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Majors</span></a>
        </li>
        <li class=" {{ request()->is('student') ? 'active' : 'nav-item' }}"><a href="/student/"><i
                    class="ft-droplet"></i><span class="menu-title" data-i18n="">Students</span></a>
        </li>
        <li class=" {{ request()->is('trash/student') ? 'active' : 'nav-item' }}"><a href="/trash/student"><i
                    class="ft-book"></i><span class="menu-title" data-i18n="">Trash</span></a>
        </li>

        <li class=" nav-item"><a href="/logout"><i class="ft-layout"></i><span class="menu-title"
                    data-i18n="">Logout</span></a>
        </li>

    </ul>
</div>
