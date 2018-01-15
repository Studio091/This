     
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="/cms/"><i class="active fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li @yield('post')>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Posts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/cms/publish">Add Post</a>
                                </li>
                                <li>
                                    <a href="/cms/category">Create Category</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li @yield('message')>
                            <a href="/cms/message"><i class="fa fa-file-text-o fa-fw"></i> Messages </a>
                        </li>
                        <li @yield('album')>
                            <a href="/cms/album"><i class="fa fa-file-picture-o fa-fw"></i> Albums</a>
                        </li>
                       
                        <li @yield('portfolio')>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Porfolio<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/cms/work">Add project</a>
                                </li>
                                 <li>
                                    <a href="/cms/portfolio">Category project</a>
                                </li>
                              
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li @yield('profile')>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Profile<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/cms/profile">Edit Profile's {{auth()->user()->name}}</a>
                                </li>
                                <li>
                                    <a href="/cms/user">Users</a>
                                </li>
                                 <li>
                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">