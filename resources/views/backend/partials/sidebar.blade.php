<aside class="bg-base-100 border-r border-base-300 min-h-full w-64 flex flex-col">

    {{-- Logo --}}
    <div class="p-4 border-b border-base-300">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-primary font-bold text-lg">
            <span class="material-icons">location_city</span>
            Real Estate
        </a>
        <p class="text-xs text-base-content/50 mt-0.5">Administration</p>
    </div>

    {{-- Navigation --}}
    <ul class="menu menu-sm p-3 gap-0.5 flex-1">

        <li class="menu-title text-xs">Main</li>

        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="material-icons text-sm">dashboard</span> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.sliders.index') }}"
               class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                <span class="material-icons text-sm">burst_mode</span> Sliders
            </a>
        </li>
        <li>
            <a href="{{ route('admin.properties.index') }}"
               class="{{ request()->routeIs('admin.properties.*') ? 'active' : '' }}">
                <span class="material-icons text-sm">home</span> Properties
            </a>
        </li>
        <li>
            <a href="{{ route('admin.features.index') }}"
               class="{{ request()->routeIs('admin.features.*') ? 'active' : '' }}">
                <span class="material-icons text-sm">star</span> Features
            </a>
        </li>
        <li>
            <a href="{{ route('admin.services.index') }}"
               class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <span class="material-icons text-sm">wb_sunny</span> Services
            </a>
        </li>
        <li>
            <a href="{{ route('admin.testimonials.index') }}"
               class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <span class="material-icons text-sm">view_carousel</span> Testimonials
            </a>
        </li>

        <li class="menu-title text-xs mt-2">Blog</li>

        <li>
            <a href="{{ route('admin.categories.index') }}"
               class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="material-icons text-sm">category</span> Categories
            </a>
        </li>
        <li>
            <a href="{{ route('admin.tags.index') }}"
               class="{{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                <span class="material-icons text-sm">label</span> Tags
            </a>
        </li>
        <li>
            <a href="{{ route('admin.posts.index') }}"
               class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <span class="material-icons text-sm">library_books</span> Posts
            </a>
        </li>

        <li class="menu-title text-xs mt-2">Other</li>

        <li>
            <a href="{{ route('admin.album') }}"
               class="{{ request()->routeIs('admin.album*') || request()->routeIs('admin.galleries*') ? 'active' : '' }}">
                <span class="material-icons text-sm">photo_library</span> Gallery
            </a>
        </li>

        <li class="menu-title text-xs mt-2">Settings</li>

        <li>
            <a href="{{ route('admin.settings') }}"
               class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <span class="material-icons text-sm">settings</span> Site Settings
            </a>
        </li>
        <li>
            <a href="{{ route('admin.profile') }}"
               class="{{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                <span class="material-icons text-sm">person</span> Profile
            </a>
        </li>
        <li>
            <a href="{{ route('admin.changepassword') }}"
               class="{{ request()->routeIs('admin.changepassword*') ? 'active' : '' }}">
                <span class="material-icons text-sm">lock</span> Change Password
            </a>
        </li>
        <li>
            <a href="{{ route('admin.message') }}"
               class="{{ request()->routeIs('admin.message*') || request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <span class="material-icons text-sm">message</span> Messages
                @if($countmessages > 0)
                    <span class="badge badge-primary badge-sm ml-auto">{{ $countmessages }}</span>
                @endif
            </a>
        </li>

    </ul>

</aside>
