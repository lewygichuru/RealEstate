<div class="navbar bg-primary text-primary-content shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 w-full flex items-center">

        {{-- Logo --}}
        <div class="flex-1">
            <a href="{{ route('home') }}" class="btn btn-ghost text-xl font-bold gap-1">
                <span class="material-icons">location_city</span>
                @if(!empty($footersettings['name']))
                    {{ $footersettings['name'] }}
                @else
                    Real Estate
                @endif
            </a>
        </div>

        {{-- Desktop nav links --}}
        <div class="hidden lg:flex">
            <ul class="menu menu-horizontal px-1 gap-1">
                <li><a href="{{ route('home') }}" class="{{ Request::is('/') ? 'underline underline-offset-4' : '' }}">Home</a></li>
                <li><a href="{{ route('property') }}" class="{{ Request::is('property*') ? 'underline underline-offset-4' : '' }}">Properties</a></li>
                <li><a href="{{ route('agents') }}" class="{{ Request::is('agents*') ? 'underline underline-offset-4' : '' }}">Agents</a></li>
                <li><a href="{{ route('gallery') }}" class="{{ Request::is('gallery') ? 'underline underline-offset-4' : '' }}">Gallery</a></li>
                <li><a href="{{ route('blog') }}" class="{{ Request::is('blog*') ? 'underline underline-offset-4' : '' }}">Blog</a></li>
                <li><a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'underline underline-offset-4' : '' }}">Contact</a></li>
            </ul>
        </div>

        {{-- Auth section --}}
        <div class="flex items-center gap-2 ml-2">
            @guest
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm hidden sm:flex">Login</a>
                <a href="{{ route('register') }}" class="btn btn-sm bg-white text-primary hover:bg-base-200">Register</a>
            @else
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-sm gap-2">
                        <img src="{{ Storage::url('users/'.auth()->user()->image) }}"
                             class="w-7 h-7 rounded-full object-cover ring-2 ring-white/40"
                             alt="{{ auth()->user()->name }}">
                        <span class="hidden md:inline text-sm">{{ ucfirst(strtok(auth()->user()->name, ' ')) }}</span>
                        <span class="material-icons text-sm">arrow_drop_down</span>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu menu-sm bg-base-100 text-base-content rounded-box shadow-xl w-48 mt-2 z-50">
                        @if(auth()->user()->type === 'admin' || auth()->user()->hasRole('admin'))
                            <li><a href="{{ route('admin.dashboard') }}"><span class="material-icons text-sm">dashboard</span> Dashboard</a></li>
                        @elseif(in_array(auth()->user()->type, ['staff', 'owner']) || auth()->user()->hasRole('staff') || auth()->user()->hasRole('owner'))
                            <li><a href="{{ route('agent.dashboard') }}"><span class="material-icons text-sm">dashboard</span> Dashboard</a></li>
                        @else
                            <li><a href="{{ route('user.dashboard') }}"><span class="material-icons text-sm">dashboard</span> Dashboard</a></li>
                        @endif
                        <li class="divider m-0"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="material-icons text-sm">power_settings_new</span> Logout
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </div>
            @endguest

            {{-- Mobile hamburger --}}
            <div class="dropdown dropdown-end lg:hidden">
                <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                    <span class="material-icons">menu</span>
                </div>
                <ul tabindex="0" class="dropdown-content menu menu-sm bg-base-100 text-base-content rounded-box shadow-xl w-52 mt-2 z-50">
                    <li><a href="{{ route('home') }}"><span class="material-icons text-sm">home</span> Home</a></li>
                    <li><a href="{{ route('property') }}"><span class="material-icons text-sm">apartment</span> Properties</a></li>
                    <li><a href="{{ route('agents') }}"><span class="material-icons text-sm">people</span> Agents</a></li>
                    <li><a href="{{ route('gallery') }}"><span class="material-icons text-sm">photo_library</span> Gallery</a></li>
                    <li><a href="{{ route('blog') }}"><span class="material-icons text-sm">article</span> Blog</a></li>
                    <li><a href="{{ route('contact') }}"><span class="material-icons text-sm">mail</span> Contact</a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
