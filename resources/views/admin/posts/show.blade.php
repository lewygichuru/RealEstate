@extends('backend.layouts.app')

@section('title', 'View Post')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 space-y-6">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold">{{ $post->title }}</h2>
                        <p class="text-sm text-base-content/60 mt-1">
                            Posted by <strong>{{ $post->user->name }}</strong> on {{ $post->created_at->toFormattedDateString() }}
                        </p>
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-info btn-sm gap-1">
                            <span class="material-icons text-sm">edit</span> Edit
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline btn-sm gap-1">
                            <span class="material-icons text-sm">arrow_back</span> Back
                        </a>
                    </div>
                </div>
                <div class="divider my-0"></div>
                <div class="prose max-w-none">
                    {!! $post->body !!}
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body p-0">
                <div class="px-4 py-3 border-b border-base-200">
                    <h3 class="font-bold">{{ $post->comments_count }} Comments</h3>
                </div>
                <div class="divide-y divide-base-200">
                    @foreach($post->comments as $comment)
                        @if($comment->parent_id == null)
                        <div class="flex gap-3 p-4">
                            <div class="avatar shrink-0">
                                <div class="w-9 h-9 rounded-full bg-base-200 overflow-hidden">
                                    <img src="{{ Storage::url('users/'.$comment->users->image) }}" alt="{{ $comment->users->name }}">
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-sm">{{ $comment->users->name }}</span>
                                    <span class="text-xs text-base-content/50">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-base-content/80 mt-1">{{ $comment->body }}</p>
                                @foreach($comment->children as $reply)
                                <div class="flex gap-3 mt-3 pl-4 border-l-2 border-base-200">
                                    <div class="avatar shrink-0">
                                        <div class="w-7 h-7 rounded-full bg-base-200 overflow-hidden">
                                            <img src="{{ Storage::url('users/'.$reply->users->image) }}" alt="{{ $reply->users->name }}">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold text-sm">{{ $reply->users->name }}</span>
                                            <span class="text-xs text-base-content/50">{{ $reply->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-base-content/80 mt-1">{{ $reply->body }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold text-sm">Categories</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($post->categories as $category)
                        <span class="badge badge-primary">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold text-sm">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                        <span class="badge badge-outline">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        @if(Storage::disk('public')->exists('posts/'.$post->image))
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold text-sm">Featured Image</h3>
                <img src="{{ Storage::url('posts/'.$post->image) }}" alt="{{ $post->title }}" class="w-full rounded-box object-cover">
            </div>
        </div>
        @endif
    </div>

</div>
@endsection
