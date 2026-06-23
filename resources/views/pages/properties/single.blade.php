@extends('frontend.layouts.app')

@section('styles')
<style>#map { height: 320px; width: 100%; border-radius: 0.5rem; }</style>
@endsection

@section('content')
<section class="py-10">
    <div class="container mx-auto px-4">

        {{-- Header --}}
        <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold">{{ $property->title }}</h1>
                <p class="flex items-center gap-1 text-base-content/60 mt-1">
                    <span class="material-icons text-sm">place</span> {{ $property->address }}
                </p>
                <div class="flex flex-wrap gap-2 mt-2">
                    @if($property->is_featured)
                        <div class="badge badge-warning gap-1"><span class="material-icons text-xs">star</span> Featured</div>
                    @endif
                    <div class="badge badge-outline">{{ ucfirst($property->type) }}</div>
                    <div class="badge badge-outline">{{ ucfirst($property->status) }}</div>
                    <div class="badge badge-outline">{{ $property->bedroom }} Beds</div>
                    <div class="badge badge-outline">{{ $property->bathroom }} Baths</div>
                    <div class="badge badge-outline">{{ $property->area }} sqft</div>
                </div>
            </div>
            <div class="text-right">
                <p class="text-3xl font-bold text-primary">Ksh {{ number_format($property->price ?? 0) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT COLUMN --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Gallery / Image --}}
                @if(!$property->gallery->isEmpty())
                    @include('pages.properties.slider')
                @elseif($property->image && (Storage::disk('public')->exists('property/'.$property->image) || Storage::disk('public')->exists('property/gallery/'.$property->image)))
                    <figure class="rounded-box overflow-hidden">
                        @php($legacy = Storage::disk('public')->exists('property/'.$property->image) ? 'property/'.$property->image : 'property/gallery/'.$property->image)
                        <img src="{{ Storage::url($legacy) }}" alt="{{ $property->title }}"
                             class="w-full object-cover max-h-96">
                    </figure>
                @endif

                {{-- Description --}}
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">Description</h2>
                        <div class="prose max-w-none text-base-content/80 mt-2">{!! $property->description !!}</div>
                    </div>
                </div>

                @php
                    $unit = $property->units->first();
                    $amenities = is_array($property->amenities ?? null) ? $property->amenities : [];
                @endphp

                {{-- Unit Details --}}
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">Unit Details</h2>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div><span class="font-semibold">Unit:</span> {{ $unit?->unit_number ?? '—' }}</div>
                            <div><span class="font-semibold">Floor:</span> {{ $unit?->floor ?? '—' }}</div>
                            <div><span class="font-semibold">Beds:</span> {{ $unit?->bedrooms ?? 0 }}</div>
                            <div><span class="font-semibold">Baths:</span> {{ $unit?->bathrooms ?? 0 }}</div>
                            <div><span class="font-semibold">Size:</span> {{ $unit?->size_sqft ?? '—' }} sqft</div>
                            <div><span class="font-semibold">Rent:</span> Ksh {{ number_format($unit?->rent_amount ?? 0) }}</div>
                            <div><span class="font-semibold">Deposit:</span> Ksh {{ number_format($unit?->deposit_amount ?? 0) }}</div>
                            <div><span class="font-semibold">Unit Status:</span> {{ ucfirst($unit?->status ?? 'available') }}</div>
                        </div>
                        @if($unit?->notes)
                            <div class="text-sm text-base-content/70 mt-2">{{ $unit->notes }}</div>
                        @endif
                    </div>
                </div>

                {{-- Amenities --}}
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">Amenities</h2>
                        @if(count($amenities))
                            <ul class="grid grid-cols-2 gap-2 mt-2">
                                @foreach($amenities as $amenity)
                                <li class="flex items-center gap-2 text-sm">
                                    <span class="material-icons text-primary text-sm">check_circle</span>
                                    {{ $amenity }}
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-base-content/60">No amenities listed.</p>
                        @endif
                    </div>
                </div>

                {{-- Map --}}
                @if($property->latitude && $property->longitude)
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">Location</h2>
                        <div id="map" class="mt-2"></div>
                    </div>
                </div>
                @endif

                {{-- Comments --}}
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-4">
                            <h2 class="card-title">{{ $property->comments_count }} Comments</h2>
                            @auth
                            <div id="rateYo" class="ml-auto"></div>
                            @endauth
                        </div>

                        <div class="space-y-4">
                            @foreach($property->comments as $comment)
                                @if($comment->parent_id == null)
                                <div class="flex gap-3">
                                    <div class="avatar shrink-0">
                                        <div class="w-9 h-9 rounded-full">
                                            @if($comment->user && $comment->user->image && Storage::disk('public')->exists('users/'.$comment->user->image))
                                                <img src="{{ Storage::url('users/'.$comment->user->image) }}" alt="">
                                            @else
                                                <div class="bg-base-300 w-9 h-9 rounded-full"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-sm">{{ $comment->user?->name ?? 'Unknown' }}</span>
                                            <span class="text-xs text-base-content/50">{{ $comment->created_at->diffForHumans() }}</span>
                                            @auth
                                            <button class="ml-auto text-xs text-primary hover:underline reply-btn"
                                                    data-id="{{ $comment->id }}">Reply</button>
                                            @endauth
                                        </div>
                                        <p class="text-sm mt-1">{{ $comment->body }}</p>
                                        <div id="procomment-{{ $comment->id }}"></div>
                                    </div>
                                </div>
                                @endif

                                @foreach($comment->children as $child)
                                <div class="flex gap-3 ml-10">
                                    <div class="avatar shrink-0">
                                        <div class="w-8 h-8 rounded-full">
                                            @if($child->user && $child->user->image && Storage::disk('public')->exists('users/'.$child->user->image))
                                                <img src="{{ Storage::url('users/'.$child->user->image) }}" alt="">
                                            @else
                                                <div class="bg-base-300 w-8 h-8 rounded-full"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-sm">{{ $child->user?->name ?? 'Unknown' }}</span>
                                            <span class="text-xs text-base-content/50">{{ $child->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm mt-1">{{ $child->body }}</p>
                                    </div>
                                </div>
                                @endforeach
                            @endforeach
                        </div>

                        @auth
                        <form action="{{ route('property.comment', $property->id) }}" method="POST" class="mt-6 flex flex-col gap-2">
                            @csrf
                            <input type="hidden" name="parent" value="0">
                            <textarea name="body" rows="3" placeholder="Leave a comment..."
                                      class="textarea w-full"></textarea>
                            <button type="submit" class="btn btn-primary btn-sm w-fit">Post Comment</button>
                        </form>
                        @endauth
                        @guest
                        <div class="alert mt-4">
                            <span class="material-icons">info</span>
                            <span>Please <a href="{{ route('login') }}" class="link link-primary">login</a> to comment.</span>
                        </div>
                        @endguest
                    </div>
                </div>

            </div>

            {{-- RIGHT COLUMN --}}
            <div class="space-y-6">

                {{-- Agent contact --}}
                @if($property->user)
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body gap-3">
                        <h2 class="card-title text-base">Contact Agent</h2>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="w-12 h-12 rounded-full">
                                    @if($property->user->image && Storage::disk('public')->exists('users/'.$property->user->image))
                                        <img src="{{ Storage::url('users/'.$property->user->image) }}" alt="{{ $property->user->name }}">
                                    @else
                                        <div class="bg-base-300 w-12 h-12 rounded-full"></div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold text-sm">{{ $property->user->name }}</p>
                                <p class="text-xs text-base-content/60">{{ $property->user->email }}</p>
                                <a href="{{ route('agents.show', $property->user->id) }}" class="link link-primary text-xs">View Profile</a>
                            </div>
                        </div>
                        <form class="agent-message-box flex flex-col gap-2" action="{{ route('property.message') }}" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $property->user->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Name</legend>
                                <input type="text" name="name" placeholder="Your Name" class="input input-sm w-full">
                            </fieldset>
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Email</legend>
                                <input type="email" name="email" placeholder="Your Email" class="input input-sm w-full">
                            </fieldset>
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Phone</legend>
                                <input type="number" name="phone" placeholder="Your Phone" class="input input-sm w-full">
                            </fieldset>
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Message</legend>
                                <textarea name="message" rows="3" placeholder="Your Message" class="textarea textarea-sm w-full"></textarea>
                            </fieldset>
                            <button id="msgsubmitbtn" type="submit" class="btn btn-primary btn-sm w-full gap-1">
                                <span class="material-icons text-sm">send</span> Send Message
                            </button>
                        </form>
                    </div>
                </div>
                @endif

                {{-- City list --}}
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title text-base">Browse by City</h2>
                        <ul class="menu menu-sm mt-2 -mx-2">
                            @foreach($cities as $city)
                            <li><a href="{{ route('property.city', $city->city) }}">
                                <span class="material-icons text-sm">location_city</span> {{ $city->city }}
                            </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Related properties --}}
                @if($relatedproperty->count())
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title text-base">Related Properties</h2>
                        <ul class="space-y-3 mt-2">
                            @foreach($relatedproperty as $rel)
                            <li>
                                <a href="{{ route('property.show', $rel->slug) }}" class="flex items-center gap-3 hover:text-primary transition-colors">
                                    @php($relCover = $rel->gallery->first())
                                    @if($relCover)
                                    <div class="w-14 h-10 rounded bg-cover bg-center shrink-0"
                                         style="background-image:url({{ $relCover->file_path }})"></div>
                                    @elseif($rel->image && Storage::disk('public')->exists('property/gallery/'.$rel->image))
                                    <div class="w-14 h-10 rounded bg-cover bg-center shrink-0"
                                         style="background-image:url({{ Storage::url('property/gallery/'.$rel->image) }})"></div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-medium line-clamp-1">{{ \Illuminate\Support\Str::limit($rel->title, 30) }}</p>
                                        <p class="text-xs text-primary font-semibold">Ksh {{ number_format($rel->price ?? 0) }}</p>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

            </div>
        </div>

    </div>
</section>

@php $rating = ($rating == null) ? 0 : $rating; @endphp
@endsection

@section('scripts')
<script>
$(function(){
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // Rating
    @auth
    $("#rateYo").rateYo({
        rating: <?php echo json_encode($rating); ?>,
        halfStar: true,
        starWidth: "24px"
    }).on("rateyo.set", function(e, data) {
        $.post("{{ route('property.rating') }}", {
            rating: data.rating,
            property_id: <?php echo json_encode($property->id); ?>,
            user_id: <?php echo json_encode(auth()->id()); ?>
        }, function(data) {
            if (data.rating) toastr.success('Rating saved!');
        });
    });
    @endauth

    // Reply button
    $(document).on('click', '.reply-btn', function() {
        var id = $(this).data('id');
        var action = "{{ route('property.comment', $property->id) }}";
        $('#procomment-' + id).html(
            '<form action="' + action + '" method="POST" class="mt-3 flex flex-col gap-2">' +
            '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
            '<input type="hidden" name="parent" value="1">' +
            '<input type="hidden" name="parent_id" value="' + id + '">' +
            '<textarea name="body" rows="2" placeholder="Your reply..." class="textarea textarea-sm w-full"></textarea>' +
            '<button type="submit" class="btn btn-primary btn-xs w-fit">Reply</button>' +
            '</form>'
        );
    });

    // Send message
    $(document).on('submit', '.agent-message-box', function(e) {
        e.preventDefault();
        var btn = $('#msgsubmitbtn');
        btn.addClass('loading').prop('disabled', true);
        $.ajax({
            type: 'POST', url: "{{ route('property.message') }}",
            data: $(this).serialize(),
            success: function(data) { if (data.message) toastr.success(data.message); },
            error: function() { toastr.error('Failed to send message.'); },
            complete: function() { btn.removeClass('loading').prop('disabled', false); $('form.agent-message-box')[0].reset(); },
            dataType: 'json'
        });
    });
});
</script>

@if($property->latitude && $property->longitude)
<script>
function initMap() {
    var latlng = { lat: <?php echo $property->latitude; ?>, lng: <?php echo $property->longitude; ?> };
    var map = new google.maps.Map(document.getElementById('map'), { zoom: 12, center: latlng });
    new google.maps.Marker({ position: latlng, map: map, title: '<?php echo addslashes($property->title); ?>' });
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRLaJEjRudGCuEi1_pqC4n3hpVHIyJJZA&callback=initMap"></script>
@endif
@endsection
