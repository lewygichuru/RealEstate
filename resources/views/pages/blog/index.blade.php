@extends('frontend.layouts.app')

@section('content')
<section class="py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Blog</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Posts --}}
            <div class="lg:col-span-2 space-y-6">
                @forelse($posts as $post)
                <div class="card card-side bg-base-100 shadow-sm hover:shadow-md transition-shadow">
                    @if(Storage::disk('public')->exists('posts/'.$post->image) && $post->image)
                    <figure class="w-44 shrink-0">
                        <img src="{{ Storage::url('posts/'.$post->image) }}" alt="{{ $post->title }}"
                             class="h-full w-full object-cover">
                    </figure>
                    @endif
                    <div class="card-body p-4">
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <h2 class="card-title text-base hover:text-primary transition-colors line-clamp-2">
                                {{ $post->title }}
                            </h2>
                        </a>
                        <p class="text-sm text-base-content/60 line-clamp-2">
                            {!! \Illuminate\Support\Str::limit(strip_tags($post->body), 120) !!}
                        </p>
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-2 text-xs text-base-content/50">
                            <a href="{{ route('blog.author', $post->user->username) }}" class="flex items-center gap-1 hover:text-primary">
                                <span class="material-icons text-sm">person</span> {{ $post->user->name }}
                            </a>
                            <span class="flex items-center gap-1">
                                <span class="material-icons text-sm">schedule</span> {{ $post->created_at->diffForHumans() }}
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-icons text-sm">comment</span> {{ $post->comments_count }}
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-1 mt-2">
                            @foreach($post->categories as $category)
                                <a href="{{ route('blog.categories', $category->slug) }}" class="badge badge-outline badge-xs hover:badge-primary">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog.tags', $tag->slug) }}" class="badge badge-ghost badge-xs">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert"><span class="material-icons">info</span> No posts found.</div>
                @endforelse

                <div class="mt-6 flex justify-center">
                    {{ $posts->links() }}
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
