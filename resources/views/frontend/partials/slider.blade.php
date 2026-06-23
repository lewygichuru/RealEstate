<div class="relative w-full overflow-hidden" style="height:520px;" id="hero-carousel">
    @if($sliders && $sliders->count() > 0)
        @foreach($sliders as $index => $slider)
        <div class="hero-slide absolute inset-0 transition-opacity duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
             style="background-image:url('{{ Storage::url('slider/'.$slider->image) }}'); background-size:cover; background-position:center;">
            <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                <div class="text-center text-white px-6 max-w-3xl">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">{{ $slider->title }}</h2>
                    <p class="text-lg md:text-xl opacity-90 drop-shadow">{{ $slider->description }}</p>
                    <a href="{{ route('property') }}" class="btn btn-primary mt-6">Browse Properties</a>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="absolute inset-0 bg-primary flex items-center justify-center"
             style="background-image:url('{{ asset('frontend/images/real_estate.jpg') }}'); background-size:cover; background-position:center;">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative text-center text-white px-6">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Find Your Dream Home</h2>
                <p class="text-lg opacity-90">Browse our exclusive property listings</p>
                <a href="{{ route('property') }}" class="btn btn-primary mt-6">Browse Properties</a>
            </div>
        </div>
    @endif
</div>

<script>
    (function () {
        var slides = document.querySelectorAll('.hero-slide');
        if (slides.length <= 1) return;
        var current = 0;
        setInterval(function () {
            slides[current].classList.remove('opacity-100');
            slides[current].classList.add('opacity-0');
            current = (current + 1) % slides.length;
            slides[current].classList.remove('opacity-0');
            slides[current].classList.add('opacity-100');
        }, 4500);
    })();
</script>
