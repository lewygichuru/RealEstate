<section class="bg-base-200 border-b border-base-300 py-4">
    <div class="container mx-auto px-4">
        <form action="{{ route('search') }}" method="GET">
            <div class="flex flex-wrap gap-3 items-end justify-center">

                <fieldset class="fieldset py-0">
                    <legend class="fieldset-legend text-xs font-semibold uppercase tracking-wide">City</legend>
                          <input type="text" name="city" list="city-datalist" value="{{ request('city') }}"
                              placeholder="Enter city..." autocomplete="off"
                              class="input input-sm w-40">
                    <datalist id="city-datalist">
                        @foreach($citylist as $city)
                            <option value="{{ $city }}">
                        @endforeach
                    </datalist>
                </fieldset>

                <fieldset class="fieldset py-0">
                    <legend class="fieldset-legend text-xs font-semibold uppercase tracking-wide">Type</legend>
                    <select name="type" class="select select-sm w-36">
                        <option value="">Any Type</option>
                        <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="house" {{ request('type') == 'house' ? 'selected' : '' }}>House</option>
                    </select>
                </fieldset>

                <fieldset class="fieldset py-0">
                    <legend class="fieldset-legend text-xs font-semibold uppercase tracking-wide">Status</legend>
                    <select name="status" class="select select-sm w-32">
                        <option value="">Any</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                        <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </fieldset>

                <fieldset class="fieldset py-0">
                    <legend class="fieldset-legend text-xs font-semibold uppercase tracking-wide">Beds</legend>
                    <select name="bedroom" class="select select-sm w-28">
                        <option value="">Any</option>
                        @if(isset($bedroomdistinct))
                            @foreach($bedroomdistinct as $b)
                                <option value="{{ $b->bedroom }}" {{ request('bedroom') == $b->bedroom ? 'selected' : '' }}>{{ $b->bedroom }}</option>
                            @endforeach
                        @endif
                    </select>
                </fieldset>

                <fieldset class="fieldset py-0">
                    <legend class="fieldset-legend text-xs font-semibold uppercase tracking-wide">Max Price</legend>
                          <input type="number" name="maxprice" value="{{ request('maxprice') }}" placeholder="Max price"
                              class="input input-sm w-32">
                </fieldset>

                <div class="self-end">
                    <button type="submit" class="btn btn-primary btn-sm gap-1">
                        <span class="material-icons text-sm">search</span> Search
                    </button>
                </div>

            </div>
        </form>
    </div>
</section>
