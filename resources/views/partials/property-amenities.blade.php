@php
    $amenityOptions = $amenityOptions ?? ['Parking', 'Pool', 'Gym', 'Security', 'Elevator', 'Garden', 'Backup Power', 'Water Tank', 'Internet', 'Furnished'];
    $selectedAmenities = old('amenities', $property?->amenities ?? []);
    $selectedAmenities = is_array($selectedAmenities) ? $selectedAmenities : [];
@endphp

<div>
    <h4 class="text-sm font-semibold mb-2">Amenities</h4>
    <div class="flex flex-wrap gap-2">
        @foreach($amenityOptions as $amenity)
        <label class="label cursor-pointer gap-1.5 bg-base-200 rounded-lg px-3 py-1.5">
            <input type="checkbox" name="amenities[]" value="{{ $amenity }}" class="checkbox checkbox-primary checkbox-xs"
                   @checked(in_array($amenity, $selectedAmenities, true))>
            <span class="text-sm">{{ $amenity }}</span>
        </label>
        @endforeach
    </div>
</div>
