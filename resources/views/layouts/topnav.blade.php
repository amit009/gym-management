<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class="navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        @if(Auth::check())
                            <!-- <img src="{{ asset('gentelella/images/img.jpg') }}" alt=""> -->
                            <i class="fa fa-user"></i>&nbsp;
                            {{ Auth::user()->name }} {{ Auth::user()->role }}                                                         
                        @endif  
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                       <!-- <a class="dropdown-item"  href="javascript:;">
                            <span class="badge bg-red pull-right">50%</span>
                            <span>Settings</span>
                        </a> -->
                        <x-dropdown-link :href="route('profile.edit')" class="dropdown-item">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ url('/clear-cache') }}">
                            @csrf
                            <x-dropdown-link :href="url('clear-cache')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="dropdown-item">
                                {{ __('Clear Cache') }}
                            </x-dropdown-link>
                        </form>

                          <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="dropdown-item">
                                <i class="fa fa-sign-out pull-right"></i> {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>                    
                </li>
            </ul>
        </nav>
    </div>
</div>
