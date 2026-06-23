@extends('frontend.layouts.app')

@section('content')
<section class="py-12">
    <div class="container mx-auto px-4">

        <h1 class="text-3xl font-bold mb-6">Properties</h1>

        {{-- City filter tabs --}}
        @if($cities->count())
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="{{ route('property') }}" class="btn btn-sm btn-outline btn-primary">All Cities</a>
            @foreach($cities as $city)
                <a href="{{ route('property.city', $city->city) }}" class="btn btn-sm btn-outline">
                    {{ $city->city }}
                </a>
            @endforeach
        </div>
        @endif

        {{-- Property grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($properties as $property)
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
            @empty
            <div class="col-span-3">
                <div class="alert alert-info">
                    <span class="material-icons">info</span>
                    No properties found.
                </div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            {{ $properties->links() }}
        </div>

    </div>
</section>
@endsection

@section('scripts')
<script>
$(function(){
    var js_properties = <?php echo json_encode($properties); ?>;
    js_properties.data.forEach(function(element) {
        if (element.rating && element.rating.length) {
            var sum = element.rating.reduce(function(a, b) { return a + parseFloat(b.score || 0); }, 0);
            var avg = sum / element.rating.length;
            $("#propertyrating-" + element.id).rateYo({ rating: isNaN(avg) ? 0 : avg, starWidth: "16px", readOnly: true });
        }
    });
});
</script>
@endsection
