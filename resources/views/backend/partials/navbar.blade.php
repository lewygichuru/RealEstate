<div class="navbar bg-base-100 border-b border-base-300 shadow-sm sticky top-0 z-10 px-4">

    {{-- Mobile hamburger --}}
    <div class="flex-none lg:hidden mr-2">
        <label for="admin-drawer" class="btn btn-ghost btn-square btn-sm">
            <span class="material-icons">menu</span>
        </label>
    </div>

    <div class="flex-1">
        <span class="text-sm text-base-content/50 hidden sm:inline">Admin Panel</span>
    </div>

    <div class="flex items-center gap-1">

        {{-- Theme picker --}}
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm" title="Change theme">
                <span class="material-icons">palette</span>
            </div>
            <div tabindex="0" class="dropdown-content bg-base-100 border border-base-300 rounded-box shadow-xl z-50 mt-2 p-2 w-48" style="max-height:20rem; overflow-y:auto;">
                <p class="text-[10px] font-bold uppercase tracking-widest text-base-content/40 mb-1 px-1">Theme</p>
                @foreach([
                    'light','dark','cupcake','bumblebee','emerald','corporate',
                    'synthwave','retro','cyberpunk','valentine','halloween',
                    'garden','forest','aqua','lofi','pastel','fantasy',
                    'wireframe','black','luxury','dracula','cmyk','autumn',
                    'business','acid','lemonade','night','coffee','winter',
                    'dim','nord','sunset'
                ] as $t)
                <button onclick="applyTheme('{{ $t }}')"
                        data-theme-option="{{ $t }}"
                        class="flex items-center gap-2 px-2 py-1 rounded-lg hover:bg-base-200 text-sm w-full text-left transition-colors">
                    <span class="flex gap-px shrink-0" data-theme="{{ $t }}">
                        <span class="w-2 h-4 rounded-sm bg-primary block"></span>
                        <span class="w-2 h-4 rounded-sm bg-secondary block"></span>
                        <span class="w-2 h-4 rounded-sm bg-accent block"></span>
                    </span>
                    <span class="capitalize">{{ $t }}</span>
                </button>
                @endforeach
            </div>
        </div>

        {{-- Notifications --}}
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm relative">
                <span class="material-icons">notifications</span>
                @if($countmessages > 0)
                    <span class="badge badge-primary badge-xs absolute top-0.5 right-0.5">{{ $countmessages }}</span>
                @endif
            </div>
            <div tabindex="0" class="dropdown-content card bg-base-100 shadow-xl w-72 z-50 mt-2 rounded-box">
                <div class="card-body p-0">
                    <div class="px-4 py-2 border-b border-base-200 font-semibold text-sm">Messages</div>
                    <ul class="divide-y divide-base-200">
                        @foreach($navbarmessages as $message)
                        <li>
                            <a href="{{ route('admin.message.read', $message->id) }}"
                               class="flex items-center gap-3 px-4 py-3 hover:bg-base-200 transition-colors">
                                <span class="material-icons text-primary text-sm">message</span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm truncate">{{ \Illuminate\Support\Str::limit($message->message, 35) }}</p>
                                    <p class="text-xs text-base-content/50">{{ $message->created_at->diffForHumans() }}</p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="p-2 border-t border-base-200">
                        <a href="{{ route('admin.message') }}" class="btn btn-ghost btn-sm w-full">View All Messages</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- User menu --}}
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm gap-2">
                <img src="{{ Storage::url('users/'.auth()->user()->image) }}"
                     class="w-7 h-7 rounded-full object-cover"
                     alt="{{ auth()->user()->name }}">
                <span class="hidden md:inline text-sm">{{ strtok(auth()->user()->name, ' ') }}</span>
                <span class="material-icons text-sm">arrow_drop_down</span>
            </div>
            <ul tabindex="0" class="dropdown-content menu menu-sm bg-base-100 shadow-xl rounded-box w-48 z-50 mt-2">
                <li><a href="{{ route('admin.profile') }}"><span class="material-icons text-sm">person</span> Profile</a></li>
                <li><a href="{{ route('admin.message') }}"><span class="material-icons text-sm">message</span> Messages</a></li>
                <li><a href="{{ route('admin.changepassword') }}"><span class="material-icons text-sm">lock</span> Password</a></li>
                <li><a href="{{ route('home') }}" target="_blank"><span class="material-icons text-sm">home</span> Visit Site</a></li>
                <li class="divider my-0"></li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                        <span class="material-icons text-sm">power_settings_new</span> Sign Out
                    </a>
                </li>
            </ul>
            <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </div>

    </div>
</div>
