@extends('backend.layouts.app')

@section('title', 'Show Property')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    {{-- Left column --}}
    <div class="lg:col-span-2 space-y-4">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h2 class="card-title text-xl">{{ $property->title }}</h2>
                <p class="text-sm text-base-content/60">Posted by <strong>{{ $property->user->name }}</strong> on {{ $property->created_at->toFormattedDateString() }}</p>
                <div class="divider my-0"></div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-sm">
                    <div><span class="font-semibold">Type:</span> {{ $property->type }}</div>
                    <div><span class="font-semibold">Status:</span> {{ ucfirst($property->status) }}</div>
                    <div><span class="font-semibold">Price:</span> Ksh {{ number_format($property->price ?? 0) }}</div>
                    <div><span class="font-semibold">City:</span> {{ $property->city }}</div>
                    <div><span class="font-semibold">State:</span> {{ $property->state ?? '—' }}</div>
                    <div><span class="font-semibold">Country:</span> {{ $property->country ?? 'Kenya' }}</div>
                    <div class="col-span-2"><span class="font-semibold">Address:</span> {{ $property->address }}</div>
                </div>
                <div class="divider my-0"></div>
                <h3 class="font-bold">Description</h3>
                <div class="prose max-w-none text-sm">{!! $property->description !!}</div>
            </div>
        </div>

        @php($unit = $property->units->first())
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-2">
                <h3 class="font-bold">Unit Details</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-sm">
                    <div><span class="font-semibold">Unit:</span> {{ $unit?->unit_number ?? '—' }}</div>
                    <div><span class="font-semibold">Floor:</span> {{ $unit?->floor ?? '—' }}</div>
                    <div><span class="font-semibold">Beds:</span> {{ $unit?->bedrooms ?? 0 }}</div>
                    <div><span class="font-semibold">Baths:</span> {{ $unit?->bathrooms ?? 0 }}</div>
                    <div><span class="font-semibold">Size:</span> {{ $unit?->size_sqft ?? '—' }} sqft</div>
                    <div><span class="font-semibold">Rent:</span> Ksh {{ number_format($unit?->rent_amount ?? 0) }}</div>
                    <div><span class="font-semibold">Deposit:</span> Ksh {{ number_format($unit?->deposit_amount ?? 0) }}</div>
                    <div><span class="font-semibold">Unit Status:</span> {{ ucfirst($unit?->status ?? 'available') }}</div>
                    <div class="col-span-2"><span class="font-semibold">Notes:</span> {{ $unit?->notes ?? '—' }}</div>
                </div>
            </div>
        </div>

        @if(!$property->gallery->isEmpty())
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-2">
                <h3 class="font-bold">Gallery</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                    @foreach($property->gallery as $gallery)
                    <img src="{{ $gallery->file_path }}" alt="{{ $gallery->file_name }}" class="w-full h-28 object-cover rounded-lg">
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- Comments --}}
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold">{{ $property->comments_count }} Comments</h3>
                @foreach($property->comments as $comment)
                    @if($comment->parent_id == NULL)
                    <div class="flex gap-3">
                        <div class="avatar"><div class="w-9 h-9 rounded-full">
                            @if($comment->user && $comment->user->image && Storage::disk('public')->exists('users/'.$comment->user->image))
                                <img src="{{ Storage::url('users/'.$comment->user->image) }}" alt="">
                            @else
                                <div class="bg-base-300 w-9 h-9 rounded-full"></div>
                            @endif
                        </div></div>
                        <div class="flex-1">
                            <div class="flex justify-between text-sm"><strong>{{ $comment->user?->name ?? 'Unknown' }}</strong><span class="text-base-content/50">{{ $comment->created_at->diffForHumans() }}</span></div>
                            <p class="text-sm mt-1">{{ $comment->body }}</p>
                        </div>
                    </div>
                    @endif
                    @foreach($comment->children as $reply)
                    <div class="flex gap-3 ml-10">
                        <div class="avatar"><div class="w-8 h-8 rounded-full">
                            @if($reply->user && $reply->user->image && Storage::disk('public')->exists('users/'.$reply->user->image))
                                <img src="{{ Storage::url('users/'.$reply->user->image) }}" alt="">
                            @else
                                <div class="bg-base-300 w-8 h-8 rounded-full"></div>
                            @endif
                        </div></div>
                        <div class="flex-1">
                            <div class="flex justify-between text-sm"><strong>{{ $reply->user?->name ?? 'Unknown' }}</strong><span class="text-base-content/50">{{ $reply->created_at->diffForHumans() }}</span></div>
                            <p class="text-sm mt-1">{{ $reply->body }}</p>
                        </div>
                    </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

    {{-- Right column --}}
    <div class="space-y-4">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-2">
                <h3 class="font-bold">Status</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="badge badge-primary">{{ $property->type }}</span>
                    <span class="badge badge-outline">{{ ucfirst($property->status) }}</span>
                    @if($property->is_featured)
                        <span class="badge badge-warning">Featured</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-2">
                <h3 class="font-bold">Amenities</h3>
                <div class="flex flex-wrap gap-1">
                    @forelse(($property->amenities ?? []) as $amenity)
                        <span class="badge badge-success badge-sm">{{ $amenity }}</span>
                    @empty
                        <span class="text-sm text-base-content/60">No amenities listed.</span>
                    @endforelse
                </div>
            </div>
        </div>
        @if($property->latitude && $property->longitude)
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold">Location</h3>
                <div class="text-sm text-base-content/70">{{ $property->latitude }}, {{ $property->longitude }}</div>
                <div id="gmap_markers" class="w-full h-48 rounded-lg"></div>
            </div>
        </div>
        @endif
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-2">
                <h3 class="font-bold">Gallery Image</h3>
                @php($cover = $property->gallery->first())
                @if($cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path))
                    <img src="{{ Storage::url($cover->file_path) }}" alt="{{ $property->title }}" class="w-full rounded-lg">
                @elseif($property->image && (Storage::disk('public')->exists('property/'.$property->image) || Storage::disk('public')->exists('property/gallery/'.$property->image)))
                    @php($legacy = Storage::disk('public')->exists('property/'.$property->image) ? 'property/'.$property->image : 'property/gallery/'.$property->image)
                    <img src="{{ Storage::url($legacy) }}" alt="{{ $property->title }}" class="w-full rounded-lg">
                @endif
                <div class="flex gap-2">
                    <a href="{{ route('admin.properties.index') }}" class="btn btn-outline btn-sm gap-1"><span class="material-icons text-sm">arrow_back</span> Back</a>
                    <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-info btn-sm gap-1"><span class="material-icons text-sm">edit</span> Edit</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    @if($property->latitude && $property->longitude)
    <script src="https://maps.google.com/maps/api/js?v=3&sensor=false"></script>
    <script src="{{ asset('backend/plugins/gmaps/gmaps.js') }}"></script>
    <script>
        var markers = new GMaps({
            div: '#gmap_markers',
            lat: '<?php echo $property->latitude; ?>',
            lng: '<?php echo $property->longitude; ?>'
        });
        markers.addMarker({
            lat: '<?php echo $property->latitude; ?>',
            lng: '<?php echo $property->longitude; ?>',
            title: '<?php echo $property->title; ?>'
        });
    </script>
    @endif
@endpush
