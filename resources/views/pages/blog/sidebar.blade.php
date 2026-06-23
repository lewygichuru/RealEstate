{{-- Popular Posts --}}
<div class="card bg-base-100 shadow-sm mb-6">
    <div class="card-body p-4">
        <h3 class="font-bold text-sm uppercase tracking-wide mb-3">Popular Posts</h3>
        <ul class="menu menu-sm -mx-2">
            @foreach($popularposts as $post)
            <li>
                <a href="{{ route('blog.show', $post->slug) }}" class="text-sm line-clamp-1">
                    {{ $post->title }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- Categories --}}
<div class="card bg-base-100 shadow-sm mb-6">
    <div class="card-body p-4">
        <h3 class="font-bold text-sm uppercase tracking-wide mb-3">Categories</h3>
        <ul class="space-y-2">
            @foreach($categories as $category)
            <li>
                <a href="{{ route('blog.categories', $category->slug) }}"
                   class="flex items-center justify-between text-sm hover:text-primary transition-colors">
                    <span>{{ $category->name }}</span>
                    <span class="badge badge-outline badge-sm">{{ $category->posts_count }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- Archives --}}
<div class="card bg-base-100 shadow-sm mb-6">
    <div class="card-body p-4">
        <h3 class="font-bold text-sm uppercase tracking-wide mb-3">Archives</h3>
        <ul class="space-y-1">
            @foreach($archives as $stats)
            <li>
                <a href="/blog/?month={{ $stats['month'] }}&year={{ $stats['year'] }}"
                   class="flex items-center justify-between text-sm hover:text-primary transition-colors">
                    <span>{{ $stats['month'] }} {{ $stats['year'] }}</span>
                    <span class="badge badge-primary badge-sm">{{ $stats['published'] }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- Tags --}}
<div class="card bg-base-100 shadow-sm">
    <div class="card-body p-4">
        <h3 class="font-bold text-sm uppercase tracking-wide mb-3">Tags</h3>
        <div class="flex flex-wrap gap-2">
            @foreach($tags as $tag)
            <a href="{{ route('blog.tags', $tag->slug) }}" class="badge badge-outline hover:badge-primary transition-colors">
                {{ $tag->name }}
            </a>
            @endforeach
        </div>
    </div>
</div>
