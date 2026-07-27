@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- Stats --}}
<div class="stats stats-vertical sm:stats-horizontal shadow w-full mb-6">
    <div class="stat">
        <div class="stat-figure text-primary">
            <span class="material-icons text-4xl">home</span>
        </div>
        <div class="stat-title">Total Properties</div>
        <div class="stat-value text-primary">{{ $propertycount }}</div>
        <div class="stat-desc">Listed on the site</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-secondary">
            <span class="material-icons text-4xl">article</span>
        </div>
        <div class="stat-title">Total Posts</div>
        <div class="stat-value text-secondary">{{ $postcount }}</div>
        <div class="stat-desc">Published articles</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-accent">
            <span class="material-icons text-4xl">comment</span>
        </div>
        <div class="stat-title">Total Comments</div>
        <div class="stat-value text-accent">{{ $commentcount }}</div>
        <div class="stat-desc">Across all content</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-warning">
            <span class="material-icons text-4xl">people</span>
        </div>
        <div class="stat-title">Total Users</div>
        <div class="stat-value text-warning">{{ $usercount }}</div>
        <div class="stat-desc">Registered accounts</div>
    </div>
</div>

<div class="stats stats-vertical sm:stats-horizontal shadow w-full mb-6">
    <div class="stat">
        <div class="stat-figure text-info">
            <span class="material-icons text-4xl">admin_panel_settings</span>
        </div>
        <div class="stat-title">Roles</div>
        <div class="stat-value text-info">{{ $rolecount }}</div>
        <div class="stat-desc">Access groups in the backend</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-secondary">
            <span class="material-icons text-4xl">verified_user</span>
        </div>
        <div class="stat-title">Permissions</div>
        <div class="stat-value text-secondary">{{ $permissioncount }}</div>
        <div class="stat-desc">Granted abilities</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-success">
            <span class="material-icons text-4xl">how_to_reg</span>
        </div>
        <div class="stat-title">Registrations Today</div>
        <div class="stat-value text-success">{{ $todayregistrations }}</div>
        <div class="stat-desc">New users in the last 24h</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-accent">
            <span class="material-icons text-4xl">calendar_month</span>
        </div>
        <div class="stat-title">Registrations This Week</div>
        <div class="stat-value text-accent">{{ $weekregistrations }}</div>
        <div class="stat-desc">New users since Monday</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    {{-- Recent Properties --}}
    <div>
        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-sm uppercase tracking-wide">Recent Properties</h2>
            <a href="{{ route('admin.properties.index') }}" class="btn btn-ghost btn-xs">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Price</th>
                        <th>Badge</th>
                        <th>Agent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($properties as $property)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-10 h-10 rounded-box">
                                        @php($cover = $property->gallery->first())
                                        @php($legacy = $property->image ? (Storage::disk('public')->exists('property/'.$property->image) ? 'property/'.$property->image : (Storage::disk('public')->exists('property/gallery/'.$property->image) ? 'property/gallery/'.$property->image : null)) : null)
                                        @if($cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path))
                                            <img src="{{ Storage::url($cover->file_path) }}" alt="{{ $property->title }}">
                                        @elseif($legacy)
                                            <img src="{{ Storage::url($legacy) }}" alt="{{ $property->title }}">
                                        @else
                                            <div class="bg-base-300 w-full h-full flex items-center justify-center rounded-box">
                                                <span class="material-icons text-base-content/40 text-lg">home</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm leading-tight">{{ \Illuminate\Support\Str::limit($property->title, 22) }}</div>
                                    <div class="text-xs text-base-content/50">{{ ucfirst($property->city) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="font-semibold text-success text-sm">Ksh {{ number_format($property->price) }}</td>
                        <td>
                            @if($property->is_featured)
                                <span class="badge badge-warning badge-sm gap-1">
                                    <span class="material-icons text-xs">star</span> Featured
                                </span>
                            @else
                                <span class="badge badge-ghost badge-sm">Standard</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar placeholder">
                                    <div class="bg-neutral text-neutral-content rounded-full w-7">
                                        <span class="text-xs">{{ strtoupper(substr($property->user->name, 0, 1)) }}</span>
                                    </div>
                                </div>
                                <span class="text-sm">{{ strtok($property->user->name, ' ') }}</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Posts --}}
    <div>
        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-sm uppercase tracking-wide">Recent Posts</h2>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-ghost btn-xs">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Post</th>
                        <th>Comments</th>
                        <th>Status</th>
                        <th>Author</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-10 h-10 rounded-box">
                                        @if($post->image && Storage::disk('public')->exists('posts/'.$post->image))
                                            <img src="{{ Storage::url('posts/'.$post->image) }}" alt="{{ $post->title }}">
                                        @else
                                            <div class="bg-base-300 w-full h-full flex items-center justify-center rounded-box">
                                                <span class="material-icons text-base-content/40 text-lg">article</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="font-semibold text-sm leading-tight">{{ \Illuminate\Support\Str::limit($post->title, 28) }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="badge badge-primary badge-sm">{{ $post->comments_count }}</div>
                        </td>
                        <td>
                            @if($post->status)
                                <span class="badge badge-success badge-sm">Published</span>
                            @else
                                <span class="badge badge-warning badge-sm">Draft</span>
                            @endif
                        </td>
                        <td class="text-sm">{{ strtok($post->user->name, ' ') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Recent Registrations --}}
    <div>
        <h2 class="font-bold text-sm uppercase tracking-wide mb-3">Recent Registrations</h2>
        <div class="overflow-x-auto">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-9 h-9 rounded-full">
                                        @if($user->image && Storage::disk('public')->exists('users/'.$user->image))
                                            <img src="{{ Storage::url('users/'.$user->image) }}" alt="{{ $user->name }}">
                                        @else
                                            <div class="bg-base-300 w-9 h-9 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-semibold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm">{{ $user->name }}</div>
                                    <div class="text-xs text-base-content/50">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php($displayRole = $user->roles->first()?->name ?? $user->type)
                            @if($displayRole === 'admin')
                                <span class="badge badge-sm badge-error">{{ $displayRole }}</span>
                            @elseif($displayRole === 'staff' || $displayRole === 'owner')
                                <span class="badge badge-sm badge-primary">{{ $displayRole }}</span>
                            @else
                                <span class="badge badge-sm badge-ghost">{{ $displayRole ?? 'No role' }}</span>
                            @endif
                        </td>
                        <td class="text-xs text-base-content/50">{{ $user->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Comments --}}
    <div>
        <h2 class="font-bold text-sm uppercase tracking-wide mb-3">Recent Comments</h2>
        <div class="overflow-x-auto">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Author</th>
                        <th>When</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <td class="max-w-44">
                            <p class="text-sm truncate" title="{{ $comment->body }}">{{ \Illuminate\Support\Str::limit($comment->body, 35) }}</p>
                        </td>
                        <td>
                            @if($comment->approved == 1)
                                <span class="badge badge-success badge-sm">Approved</span>
                            @else
                                <span class="badge badge-warning badge-sm">Pending</span>
                            </span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar placeholder">
                                    <div class="bg-accent text-accent-content rounded-full w-7">
                                        <span class="text-xs">{{ strtoupper(substr($comment->user?->name ?? 'U', 0, 1)) }}</span>
                                    </div>
                                </div>
                                <span class="text-sm">{{ $comment->user ? strtok($comment->user->name, ' ') : 'Unknown' }}</span>
                            </div>
                        </td>
                        <td class="text-xs text-base-content/50">{{ $comment->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
