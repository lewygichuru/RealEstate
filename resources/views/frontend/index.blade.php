@extends('frontend.layouts.app')

@section('content')

{{-- SERVICES --}}
<section class="py-16 bg-base-200">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Our Services</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
            <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow text-center">
                <div class="card-body items-center">
                    <span class="material-icons text-5xl text-primary mb-2">{{ $service->icon }}</span>
                    <h3 class="card-title text-lg">{{ $service->title }}</h3>
                    <p class="text-base-content/70 text-sm">{{ $service->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FEATURED PROPERTIES --}}
@if($properties->count())
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">Recent Properties</h2>
            <a href="{{ route('property') }}" class="btn btn-outline btn-primary btn-sm">View All</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($properties as $property)
            <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow">
                <figure class="relative h-48 overflow-hidden">
                    @php($cover = $property->gallery->first())
                    @if($cover)
                        <img src="{{ $cover->file_path }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                    @elseif($property->image && (Storage::disk('public')->exists('property/'.$property->image) || Storage::disk('public')->exists('property/gallery/'.$property->image)))
                        @php($legacy = Storage::disk('public')->exists('property/'.$property->image) ? 'property/'.$property->image : 'property/gallery/'.$property->image)
                        <img src="{{ Storage::url($legacy) }}" alt="{{ $property->title }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-base-300 flex items-center justify-center">
                            <span class="material-icons text-5xl text-base-content/30">home</span>
                        </div>
                    @endif
                    @if($property->is_featured)
                    <div class="absolute top-2 right-2">
                        <div class="badge badge-warning gap-1 shadow">
                            <span class="material-icons text-xs">star</span> Featured
                        </div>
                    </div>
                    @endif
                </figure>
                <div class="card-body p-4">
                    <a href="{{ route('property.show', $property->slug) }}">
                        <h3 class="card-title text-base hover:text-primary transition-colors line-clamp-1">
                            {{ \Illuminate\Support\Str::limit($property->title, 40) }}
                        </h3>
                    </a>
                    <div class="flex flex-wrap gap-x-3 gap-y-1 text-sm text-base-content/60">
                        <span class="flex items-center gap-1"><span class="material-icons text-sm">place</span> {{ ucfirst($property->city) }}</span>
                        <span class="flex items-center gap-1"><span class="material-icons text-sm">home</span> {{ $property->address }}</span>
                    </div>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="badge badge-outline badge-sm">{{ ucfirst($property->type) }}</span>
                        <span class="badge badge-outline badge-sm">{{ ucfirst($property->status) }}</span>
                    </div>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-xl font-bold text-primary">
                            Ksh {{ number_format($property->price ?? 0) }}
                        </span>
                        <div id="propertyrating-{{ $property->id }}"></div>
                    </div>
                </div>
                <div class="px-4 pb-3 pt-2 border-t border-base-200 flex justify-between text-xs text-base-content/60">
                    <span class="flex items-center gap-1"><span class="material-icons text-sm">bed</span> {{ $property->bedroom }}</span>
                    <span class="flex items-center gap-1"><span class="material-icons text-sm">bathtub</span> {{ $property->bathroom }}</span>
                    <span class="flex items-center gap-1"><span class="material-icons text-sm">square_foot</span> {{ $property->area }} sqft</span>
                    <span class="flex items-center gap-1"><span class="material-icons text-sm">comment</span> {{ $property->comments_count }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- TESTIMONIALS --}}
@if($testimonials->count())
<section class="py-16 bg-base-200">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">What Our Clients Say</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $testimonial)
            <div class="card bg-base-100 shadow-sm text-center">
                <div class="card-body items-center gap-3">
                    <div class="avatar">
                        <div class="w-16 h-16 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img src="{{ Storage::url('testimonial/'.$testimonial->image) }}" alt="{{ $testimonial->name }}">
                        </div>
                    </div>
                    <p class="text-sm text-base-content/70 italic">"{{ $testimonial->content }}"</p>
                    <p class="font-semibold text-sm">{{ $testimonial->name }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- RECENT BLOG --}}
@if($posts->count())
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">Recent Blog Posts</h2>
            <a href="{{ route('blog') }}" class="btn btn-outline btn-primary btn-sm">View All</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
            <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow">
                @if(Storage::disk('public')->exists('posts/'.$post->image) && $post->image)
                <figure class="h-44 overflow-hidden">
                    <img src="{{ Storage::url('posts/'.$post->image) }}" alt="{{ $post->title }}"
                         class="w-full h-full object-cover">
                </figure>
                @endif
                <div class="card-body p-4">
                    <a href="{{ route('blog.show', $post->slug) }}">
                        <h3 class="card-title text-base hover:text-primary transition-colors line-clamp-2">
                            {{ $post->title }}
                        </h3>
                    </a>
                    <p class="text-sm text-base-content/60 line-clamp-2">
                        {!! \Illuminate\Support\Str::limit(strip_tags($post->body), 100) !!}
                    </p>
                    <div class="flex items-center gap-2 mt-2 text-xs text-base-content/50">
                        <span class="material-icons text-sm">person</span>
                        <a href="{{ route('blog.author', $post->user->id) }}" class="hover:text-primary">
                            {{ $post->user->name }}
                        </a>
                        <span>·</span>
                        <span class="material-icons text-sm">schedule</span>
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@section('scripts')
<script>
$(function(){
    var js_properties = <?php echo json_encode($properties); ?>;
    js_properties.forEach(function(element) {
        var avg = 0;
        if (element.rating && element.rating.length) {
            var sum = element.rating.reduce(function(a, b) { return a + parseFloat(b.score || 0); }, 0);
            avg = sum / element.rating.length;
        }
        $("#propertyrating-" + element.id).rateYo({ rating: isNaN(avg) ? 0 : avg, starWidth: "16px", readOnly: true });
    });
});
</script>
@endsection
