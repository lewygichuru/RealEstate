@php
    $property = $property ?? null;
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <fieldset class="fieldset">
        <legend class="fieldset-legend">City</legend>
        <input type="text" name="city" class="input w-full" value="{{ old('city', $property?->city) }}" required id="city">
    </fieldset>
    <fieldset class="fieldset">
        <legend class="fieldset-legend">State</legend>
        <input type="text" name="state" class="input w-full" value="{{ old('state', $property?->state) }}" id="state">
    </fieldset>
    <fieldset class="fieldset">
        <legend class="fieldset-legend">Country</legend>
        <input type="text" name="country" class="input w-full" value="{{ old('country', $property?->country ?? 'Kenya') }}" id="country">
    </fieldset>
    <fieldset class="fieldset sm:col-span-2">
        <legend class="fieldset-legend">Address</legend>
        @if(isset($as_textarea) && $as_textarea)
            <textarea name="address" rows="2" class="textarea w-full" required id="address">{{ old('address', $property?->address) }}</textarea>
        @else
            <input type="text" name="address" class="input w-full" value="{{ old('address', $property?->address) }}" required id="address">
        @endif
    </fieldset>
    <fieldset class="fieldset">
        <legend class="fieldset-legend">Latitude</legend>
        <input type="text" name="latitude" class="input w-full" value="{{ old('latitude', $property?->latitude) }}" id="latitude">
    </fieldset>
    <fieldset class="fieldset">
        <legend class="fieldset-legend">Longitude</legend>
        <input type="text" name="longitude" class="input w-full" value="{{ old('longitude', $property?->longitude) }}" id="longitude">
    </fieldset>
</div>
