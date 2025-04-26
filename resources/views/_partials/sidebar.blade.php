            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            
                            <li class="menu-title" key="t-menu">MAIN</li>
                            <li>
                                <a href="{{ route('main.index') }}" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Dashboards</span>
                                </a>
                            </li>

                            <li class="menu-title" key="t-radius">MENU</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-data"></i>
                                    <span key="t-dashboards">NAS</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('nas.lists') }}" key="t-tui-calendar">NAS Routers</a></li>
                                    <li><a href="{{ route('nas.attributes') }}" key="t-full-calendar">Attributes</a></li>
                                    <li><a href="{{ route('nas.users') }}" key="t-full-calendar">Users</a></li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">Profiles</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="{{ route('nas.bw') }}">Profile Bandwidth</a></li>
                                            <li><a href="{{ route('nas.ppp') }}">Profile PPP</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-globe"></i>
                                    <span key="t-backhaul">SERVICES</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('dns.lists') }}" key="t-list-services">DNS Management</a></li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                            <span key="t-ddns">DDNS</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="{{ route('ddns.lists') }}" key="t-list-router">List Routers</a></li>
                                            <li><a href="{{ route('ddns.users') }}" key="t-ddns">DDNS Users</a></li>
                                            <li><a href="{{ route('ddns.forwarding') }}" key="t-forwarding">Forwarding Ports</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            

                            <li class="menu-title" key="t-task">TASK</li>
                            <li>
                                <a href="#" class="has-arrow waves-effect">
                                    <i class="bx bx-task"></i>
                                    <span key="t-task">Task</span>
                                </a>
                                <ul class="sub-menu" arial-expended="false">
                                    <li><a href="{{ url('task/daily') }}" key="t-dailytask">Daily Task</a></li>
                                    <li><a href="{{ url('task/project') }}" key="t-dailytask">Project Task</a></li>
                                    <li><a href="{{ url('task/planning') }}" key="t-dailytask">Planning Task</a></li>
                                </ul>
                            </li>
                            @can('access-permission' , '1')
                                <li class="menu-title" key="t-administrator">ADMINISTRATOR</li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-authentication">Management Users</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        @can('access-permission', '2')
                                        <li><a href="{{ route('user.index') }}" key="t-account">Users</a></li>
                                        @endcan
                                        @can('access-permission', '5')
                                        <li><a href="{{ route('privilege.index') }}" key="t-privileges">Privilege</a></li>
                                        @endcan
                                        @can('access-permission', '8')
                                        <li><a href="{{ route('group.index') }}" key="t-privileges">Group</a></li>
                                        @endcan
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="mdi mdi-menu"></i>
                                        <span key="t-authentication">Management Menu</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{ url('menu/') }}" key="t-login">Menu</a></li>
                                        <li><a href="{{ url('sub-menu/') }}" key="t-login-2">Sub Menu</a></li>
                                    </ul>
                                </li>
                            
                                @can('access-permission' , '14')
                                    <li>
                                        <a href="{{ route('log.index') }}" class="waves-effect">
                                            <i class="bx bx-archive"></i>
                                            <span key="t-dashboards">Log</span>
                                        </a>
                                    </li>
                                @endcan
                            @endcan

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->