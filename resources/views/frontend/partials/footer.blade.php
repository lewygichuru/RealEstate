<footer class="bg-base-200 border-t border-base-300 mt-auto">
    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- About --}}
            <div>
                <h3 class="font-bold text-lg mb-3 uppercase tracking-wide">About Us</h3>
                <p class="text-base-content/70 text-sm leading-relaxed">
                    @if(isset($footersettings[0]) && $footersettings[0]['aboutus'])
                        {{ $footersettings[0]['aboutus'] }}
                    @else
                        At RealEstate, we connect buyers, sellers, and renters with trusted property listings across prime locations.
                    @endif
                </p>
            </div>

            {{-- Recent Properties --}}
            <div>
                <h3 class="font-bold text-lg mb-3 uppercase tracking-wide">Recent Properties</h3>
                <ul class="space-y-3">
                    @foreach($footerproperties as $property)
                    <li class="flex items-center gap-3">
                        @php($cover = $property->gallery->first())
                        @php($bg = $cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path) ? Storage::url($cover->file_path) : (Storage::disk('public')->exists('property/'.$property->image) ? Storage::url('property/'.$property->image) : (Storage::disk('public')->exists('property/gallery/'.$property->image) ? Storage::url('property/gallery/'.$property->image) : '')))
                        <div class="w-14 h-10 rounded shrink-0 bg-cover bg-center"
                             style="background-image:url({{ $bg }})"></div>
                        <div>
                            <a href="{{ route('property.show', $property->slug) }}" class="text-sm font-medium hover:text-primary transition-colors line-clamp-1">
                                {{ \Illuminate\Support\Str::limit($property->title, 35) }}
                            </a>
                            <p class="text-xs text-base-content/60">{{ $property->bedroom }}bd · {{ $property->bathroom }}ba</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Menu + Social --}}
            <div>
                <h3 class="font-bold text-lg mb-3 uppercase tracking-wide">Quick Links</h3>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('property') }}" class="hover:text-primary transition-colors">Properties</a></li>
                    <li><a href="{{ route('agents') }}" class="hover:text-primary transition-colors">Agents</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-primary transition-colors">Gallery</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-primary transition-colors">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-primary transition-colors">Contact</a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="border-t border-base-300 bg-base-300">
        <div class="container mx-auto px-4 py-3 flex flex-wrap items-center justify-between gap-2 text-sm text-base-content/70">
            <span>
                @if(isset($footersettings[0]) && $footersettings[0]['footer'])
                    {{ $footersettings[0]['footer'] }}
                @else
                    &copy; {{ date('Y') }} Real Estate. All rights reserved.
                @endif
            </span>
            <div class="flex gap-3">
                @if(isset($footersettings[0]) && $footersettings[0]['facebook'])
                    <a href="{{ $footersettings[0]['facebook'] }}" target="_blank" class="hover:text-primary transition-colors font-medium">Facebook</a>
                @endif
                @if(isset($footersettings[0]) && $footersettings[0]['twitter'])
                    <a href="{{ $footersettings[0]['twitter'] }}" target="_blank" class="hover:text-primary transition-colors font-medium">Twitter</a>
                @endif
                @if(isset($footersettings[0]) && $footersettings[0]['linkedin'])
                    <a href="{{ $footersettings[0]['linkedin'] }}" target="_blank" class="hover:text-primary transition-colors font-medium">LinkedIn</a>
                @endif
            </div>
        </div>
    </div>
</footer>
