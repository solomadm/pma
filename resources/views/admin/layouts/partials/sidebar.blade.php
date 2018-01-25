<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <conference-switcher :conference-list="{{ GeneralHelper::CollectionToSelect2(App\Conference::all()) }}" :current-conference="{{ Auth::user()->conference ? Auth::user()->conference->id : 0 }}"></conference-switcher>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            @if(Auth::user()->conference)

                <li class="header">CONFERENCE MANAGEMENT</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="{{Active::checkRoute(['admin.dashboard']) ? 'active' : ''}}"><a href="/a"><i class='fa fa-dashboard'></i> <span>Dashboard</span></a></li>
                <li class="{{Active::checkRoute(['admin.speakers']) ? 'active' : ''}}"><a href="/a/speakers"><i class='fa fa-podcast'></i> <span>Speakers</span></a></li>

                <li><a href="/a/conference"><i class='fa fa-calendar'></i> <span>Programme</span></a></li>

                <li class="{{Active::checkRoute(['admin.contact']) ? 'active' : ''}}"><a href="/a/contact"><i class='fa fa-envelope'></i> <span>Contact Submissions</span></a></li>
                <li class="{{Active::checkRoute(['admin.media']) ? 'active' : ''}}"><a href="/a/media"><i class='fa fa-file-video-o'></i> <span>Media Registrations</span></a></li>

                <li class="header">DELEGATE MANAGEMENT</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="{{Active::checkRoutePattern(['admin.delegate.get', 'admin.delegate.upload-csv-page']) ? 'active' : ''}}">
                    <a href="{{ route('admin.delegate.get') }}">
                        <i class='fa fa-users'></i>
                        <span>Delegates</span>
                    </a>
                </li>
                <li><a href="/a/dashboard"><i class='fa fa-clock-o'></i> <span>Meeting Timeslots</span></a></li>
                <li><a href="#"><i class='fa fa-handshake-o'></i> <span>Meetings</span></a></li>

                <li class="header">CONTENT MANAGEMENT</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="{{Active::checkRoute(['admin.media-manager']) ? 'active' : ''}}"><a href="/a/content/media-manager"><i class='fa fa-image'></i> <span>Media Manager</span></a></li>
                <li class="{{Active::checkRoute(['admin.content.global']) ? 'active' : ''}}"><a href="/a/content/global"><i class='fa fa-cogs'></i> <span>Global Content</span></a></li>
                <li class="treeview {{Active::checkUriPattern('a/content/base/*') ? 'active' : ''}}">
                        <a href="#">
                            <i class="fa fa-file-text"></i>
                            <span>Base Pages</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{Active::checkRoute(['admin.content.base.home']) ? 'active' : ''}}"><a href="/a/content/base/home"><i class="fa fa-circle-o"></i> Home</a></li>
                            <li class="{{Active::checkRoute(['admin.content.base.speakers']) ? 'active' : ''}}"><a href="/a/content/base/speakers"><i class="fa fa-circle-o"></i> Speakers</a></li>
                            <li class="{{Active::checkRoute(['admin.content.base.programme']) ? 'active' : ''}}"><a href="/a/content/base/programme"><i class="fa fa-circle-o"></i> Programme</a></li>
                            <li class="{{Active::checkRoute(['admin.content.base.login']) ? 'active' : ''}}"><a href="/a/content/base/login"><i class="fa fa-circle-o"></i> Login</a></li>
                            <li class="{{Active::checkRoute(['admin.content.base.register']) ? 'active' : ''}}"><a href="/a/content/base/register"><i class="fa fa-circle-o"></i> Register</a></li>
                            <li><a href="charts/inline.html"><i class="fa fa-circle-o"></i> Contact</a></li>
                            <li><a href="charts/inline.html"><i class="fa fa-circle-o"></i> Media Registration</a></li>
                        </ul>
                </li>

                <li class="{{Active::checkRoute(['admin.cms']) ? 'active' : ''}}"><a href="/a/cms"><i class='fa fa-file-text-o'></i> <span>Custom Pages</span></a></li>

            @endif

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
