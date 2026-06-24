<div class="relative w-full overflow-hidden" style="height:520px;" id="hero-carousel">
    <?php if($sliders && $sliders->count() > 0): ?>
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="hero-slide absolute inset-0 transition-opacity duration-700 <?php echo e($index === 0 ? 'opacity-100' : 'opacity-0'); ?>"
             style="background-image:url('<?php echo e(Storage::url('slider/'.$slider->image)); ?>'); background-size:cover; background-position:center;">
            <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                <div class="text-center text-white px-6 max-w-3xl">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg"><?php echo e($slider->title); ?></h2>
                    <p class="text-lg md:text-xl opacity-90 drop-shadow"><?php echo e($slider->description); ?></p>
                    <a href="<?php echo e(route('property')); ?>" class="btn btn-primary mt-6">Browse Properties</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="absolute inset-0 bg-primary flex items-center justify-center"
             style="background-image:url('<?php echo e(asset('frontend/images/real_estate.jpg')); ?>'); background-size:cover; background-position:center;">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative text-center text-white px-6">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Find Your Dream Home</h2>
                <p class="text-lg opacity-90">Browse our exclusive property listings</p>
                <a href="<?php echo e(route('property')); ?>" class="btn btn-primary mt-6">Browse Properties</a>
            </div>
        </div>
    <?php endif; ?>
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
<?php /**PATH C:\projo\RealEstate-1\resources\views/frontend/partials/slider.blade.php ENDPATH**/ ?>