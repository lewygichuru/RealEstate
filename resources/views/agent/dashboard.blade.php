@extends('frontend.layouts.app')

@section('content')
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside>@include('agent.sidebar')</aside>

            <div class="lg:col-span-3 space-y-6">
                <h1 class="text-2xl font-bold">Dashboard</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="stat bg-base-100 rounded-box shadow-sm">
                        <div class="stat-figure text-primary"><span class="material-icons text-4xl">home</span></div>
                        <div class="stat-title">Properties</div>
                        <div class="stat-value text-primary">{{ $propertytotal }}</div>
                    </div>
                    <div class="stat bg-base-100 rounded-box shadow-sm">
                        <div class="stat-figure text-secondary"><span class="material-icons text-4xl">mail</span></div>
                        <div class="stat-title">Messages</div>
                        <div class="stat-value text-secondary">{{ $messagetotal }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="card bg-base-100 shadow-sm">
                        <div class="card-body p-0">
                            <div class="px-4 py-3 border-b border-base-200">
                                <h2 class="font-bold text-sm uppercase tracking-wide">Recent Properties</h2>
                            </div>
                            <ul class="divide-y divide-base-200">
                                @foreach($properties as $key => $property)
                                <li>
                                    <a href="{{ route('property.show', $property->slug) }}" target="_blank"
                                       class="flex items-center justify-between px-4 py-2 hover:bg-base-200 transition-colors text-sm">
                                        <span class="truncate">{{ ++$key }}. {{ \Illuminate\Support\Str::limit($property->title, 28) }}</span>
                                        <span class="text-primary font-semibold ml-2">Ksh {{ number_format($property->price) }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card bg-base-100 shadow-sm">
                        <div class="card-body p-0">
                            <div class="px-4 py-3 border-b border-base-200">
                                <h2 class="font-bold text-sm uppercase tracking-wide">Recent Messages</h2>
                            </div>
                            <ul class="divide-y divide-base-200">
                                @foreach($messages as $message)
                                <li>
                                    <span class="flex px-4 py-2 text-sm">
                                        <strong class="mr-1">{{ strtok($message->name, ' ') }}:</strong>
                                        <span class="truncate text-base-content/70">{{ \Illuminate\Support\Str::limit($message->message, 25) }}</span>
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-1 mt-4">
                    <div class="card bg-base-100 shadow-sm">
                        <div class="card-body p-0">
                            <div class="px-4 py-3 border-b border-base-200">
                                <h2 class="font-bold text-sm uppercase tracking-wide">Recent Comments</h2>
                            </div>
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
                                        @forelse($comments as $comment)
                                        <tr>
                                            <td class="max-w-44">
                                                <p class="text-sm truncate" title="{{ $comment->body }}">{{ \Illuminate\Support\Str::limit($comment->body, 35) }}</p>
                                            </td>
                                            <td>
                                                @if($comment->approved == 1)
                                                    <span class="badge badge-success badge-sm">Approved</span>
                                                @else
                                                    <span class="badge badge-warning badge-sm">Pending</span>
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
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-sm py-4 text-base-content/50">No recent comments found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
