@extends('frontend.layouts.app')

@section('content')
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Post content --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="card bg-base-100 shadow-sm">
                    @if(Storage::disk('public')->exists('posts/'.$post->image))
                    <figure>
                        <img src="{{ Storage::url('posts/'.$post->image) }}" alt="{{ $post->title }}"
                             class="w-full max-h-80 object-cover">
                    </figure>
                    @endif
                    <div class="card-body">
                        <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-base-content/50 mt-1">
                            <a href="{{ route('blog.author', $post->user->username) }}" class="flex items-center gap-1 hover:text-primary">
                                <span class="material-icons text-sm">person</span> {{ $post->user->name }}
                            </a>
                            <span class="flex items-center gap-1">
                                <span class="material-icons text-sm">schedule</span> {{ $post->created_at->diffForHumans() }}
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-icons text-sm">visibility</span> {{ $post->view_count }} views
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-1 mt-2">
                            @foreach($post->categories as $category)
                                <a href="{{ route('blog.categories', $category->slug) }}" class="badge badge-primary badge-sm">{{ $category->name }}</a>
                            @endforeach
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog.tags', $tag->slug) }}" class="badge badge-outline badge-sm">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        <div class="divider my-2"></div>
                        <div class="prose max-w-none">{!! $post->body !!}</div>
                    </div>
                </div>

                {{-- Comments --}}
                <div class="card bg-base-100 shadow-sm" id="comments">
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->comments_count }} Comments</h2>

                        <div class="space-y-4 mt-4">
                            @foreach($post->comments as $comment)
                                @if($comment->parent_id == null)
                                <div class="flex gap-3">
                                    <div class="avatar shrink-0">
                                        <div class="w-9 h-9 rounded-full">
                                            <img src="{{ Storage::url('users/'.$comment->users->image) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-sm">{{ $comment->users->name }}</span>
                                            <span class="text-xs text-base-content/50">{{ $comment->created_at->diffForHumans() }}</span>
                                            @auth
                                            <button class="ml-auto text-xs text-primary hover:underline blog-reply-btn"
                                                    data-id="{{ $comment->id }}">Reply</button>
                                            @endauth
                                        </div>
                                        <p class="text-sm mt-1">{{ $comment->body }}</p>
                                        <div id="comment-{{ $comment->id }}"></div>
                                    </div>
                                </div>
                                @endif

                                @if($comment->children->count() > 0)
                                    @foreach($comment->children as $child)
                                    <div class="flex gap-3 ml-10">
                                        <div class="avatar shrink-0">
                                            <div class="w-8 h-8 rounded-full">
                                                <img src="{{ Storage::url('users/'.$child->users->image) }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2">
                                                <span class="font-semibold text-sm">{{ $child->users->name }}</span>
                                                <span class="text-xs text-base-content/50">{{ $child->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-sm mt-1">{{ $child->body }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>

                        @auth
                        <form action="{{ route('blog.comment', $post->id) }}" method="POST" class="mt-6 flex flex-col gap-2">
                            @csrf
                            <input type="hidden" name="parent" value="0">
                            <textarea name="body" rows="3" placeholder="Leave a comment..."
                                      class="textarea w-full"></textarea>
                            <button type="submit" class="btn btn-primary btn-sm w-fit">Post Comment</button>
                        </form>
                        @endauth
                        @guest
                        <div class="alert mt-4">
                            <span>Please <a href="{{ route('login') }}" class="link link-primary">login</a> to comment.</span>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <aside>
                @include('pages.blog.sidebar')
            </aside>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).on('click', '.blog-reply-btn', function() {
    var id = $(this).data('id');
    var action = "{{ route('blog.comment', $post->id) }}";
    $('#comment-' + id).html(
        '<form action="' + action + '" method="POST" class="mt-3 flex flex-col gap-2">' +
        '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
        '<input type="hidden" name="parent" value="1">' +
        '<input type="hidden" name="parent_id" value="' + id + '">' +
        '<textarea name="body" rows="2" placeholder="Your reply..." class="textarea textarea-sm w-full"></textarea>' +
        '<button type="submit" class="btn btn-primary btn-xs w-fit">Reply</button>' +
        '</form>'
    );
});
</script>
@endsection
