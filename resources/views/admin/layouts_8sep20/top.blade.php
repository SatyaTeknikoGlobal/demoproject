
<div class="topright">
   <ul class="top-nav">
    @if (auth()->check())
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i>&nbsp; {{ auth()->user()->first_name }} <i aria-hidden="true" class="fa fa-angle-down"></i>
            </a>
            <?php
            $ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
            
            $back_url = CustomHelper::BackUrl();
            ?>
            <ul class="dropdown-menu dropdown-menu-right">
                <?php
                /*
                <li><a href="{{ route('account') }}">Account Settings</a></li>
                <li><a href="{{ route('orders') }}">My Orders</a></li>
                <li class="divider"></li>
                */
                ?>
                @if (auth()->user()->type == 'admin')
                    <li><a href="{{ route($ADMIN_ROUTE_NAME.'.home') }}" title="Admin Panel"><i class="fa fa-desktop"></i> Admin</a></li>
                @endif

                <li><a href="{{ route($ADMIN_ROUTE_NAME.'.change_password', ['back_url'=>$back_url]) }}" title="Change Password"><i class="fa fa-key"></i> Change Password</a></li>

                <?php
                /*
                <li><a href="{{ url('') }}" title="View Website" target="_blank"><i class="fas fa-globe"></i> View Website</a></li>
                */
                ?>

                @if(CustomHelper::isAllowedModule('settings'))

                 <li><a href="{{ url('admin/settings?type=website') }}" title="Settings"><i class="fas fa-cog"></i> Website Settings</a></li>

                 <li><a href="{{ url('admin/settings?type=seo') }}" title="Settings"><i class="fas fa-cog"></i> SEO Settings</a></li>

                 @endif

                <li>

                    <a href="{{ url('admin/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> Log out
                        </a>
                    

                    <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    @else
        <li><a href="login">Login</a></li>
        <!-- <li><a href="register">Register</a></li> -->
    @endif
</ul>
</div>