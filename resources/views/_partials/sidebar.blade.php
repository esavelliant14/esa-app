            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            
                            <li class="menu-title" key="t-menu">MAIN</li>
                            <li>
                                <a href="{{ url('/main') }}" class="waves-effect">
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
                                    <li><a href="calendar.html" key="t-tui-calendar">NAS Routers</a></li>
                                    <li><a href="{{ url('nas/attribute') }}" key="t-full-calendar">Attributes</a></li>
                                    <li><a href="calendar-full.html" key="t-full-calendar">User</a></li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">Profiles</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="javascript: void(0);">Profile Bandwidth</a></li>
                                            <li><a href="javascript: void(0);">Profile PPP</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-router"></i>
                                    <span key="t-devices">DEVICES</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="calendar.html" key="t-tui-calendar">List Devices</a></li>
                                    <li><a href="calendar.html" key="t-tui-calendar">Category Devices</a></li>
                                    <li><a href="calendar.html" key="t-tui-calendar">Type Devices</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-route"></i>
                                    <span key="t-backhaul">SERVICES</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="calendar.html" key="t-tui-calendar">List Services</a></li>
                                    <li><a href="calendar.html" key="t-tui-calendar">Category Services</a></li>
                                    <li><a href="calendar.html" key="t-tui-calendar">Provider Services</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-globe"></i>
                                    <span key="t-ddns">DDNS</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="calendar.html" key="t-list-router">List Routers</a></li>
                                    <li><a href="calendar.html" key="t-ddns">DDNS Users</a></li>
                                    <li><a href="calendar.html" key="t-forwarding">Forwarding Ports</a></li>
                                </ul>
                            </li>

                            <li class="menu-title" key="t-task">TASK</li>
                            <li>
                                <a href="#" class="has-arrow waves-effect">
                                    <i class="bx bx-task"></i>
                                    <span key="t-task">Task</span>
                                </a>
                                <ul class="sub-menu" arial-expended="false">
                                    <li><a href="#" key="t-dailytask">Daily Task</a></li>
                                    <li><a href="#" key="t-dailytask">Project Task</a></li>
                                    <li><a href="#" key="t-dailytask">Planning Task</a></li>
                                </ul>
                            </li>

                            <li class="menu-title" key="t-administrator">ADMINISTRATOR</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user-circle"></i>
                                    <span key="t-authentication">Management Users</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ url('user/') }}" key="t-account">Users</a></li>
                                    <li><a href="{{ url('privilege/') }}" key="t-privileges">Privilege</a></li>
                                    <li><a href="{{ url('group/') }}" key="t-privileges">Group</a></li>
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


                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->