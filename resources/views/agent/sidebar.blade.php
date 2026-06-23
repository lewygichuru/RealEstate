<div class="card bg-base-100 shadow-sm">
    <div class="card-body items-center gap-2 py-5">
        <div class="avatar">
            <div class="w-20 h-20 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                <img src="{{ Storage::url('users/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}">
            </div>
        </div>
        <h3 class="font-bold text-center">{{ auth()->user()->name }}</h3>
        <p class="text-xs text-base-content/60 text-center">{{ auth()->user()->email }}</p>
    </div>
    <ul class="menu menu-sm px-2 pb-4 gap-0.5">
        <li>
            <a href="{{ route('agent.dashboard') }}"
               class="{{ request()->routeIs('agent.dashboard') ? 'active' : '' }}">
                <span class="material-icons text-sm">dashboard</span> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('agent.profile') }}"
               class="{{ request()->routeIs('agent.profile*') ? 'active' : '' }}">
                <span class="material-icons text-sm">person</span> Profile
            </a>
        </li>
        <li>
            <a href="{{ route('agent.message') }}"
               class="{{ request()->routeIs('agent.message*') || request()->routeIs('agent.messages.*') ? 'active' : '' }}">
                <span class="material-icons text-sm">mail</span> Messages
            </a>
        </li>
        <li>
            <a href="{{ route('agent.properties.index') }}"
               class="{{ request()->routeIs('agent.properties.index') || request()->routeIs('agent.properties.edit') ? 'active' : '' }}">
                <span class="material-icons text-sm">view_list</span> Properties
            </a>
        </li>
        <li>
            <a href="{{ route('agent.properties.create') }}"
               class="{{ request()->routeIs('agent.properties.create') ? 'active' : '' }}">
                <span class="material-icons text-sm">add_circle</span> Add Property
            </a>
        </li>
        <li>
            <a href="{{ route('agent.changepassword') }}"
               class="{{ request()->routeIs('agent.changepassword*') ? 'active' : '' }}">
                <span class="material-icons text-sm">lock</span> Change Password
            </a>
        </li>
    </ul>
</div>
