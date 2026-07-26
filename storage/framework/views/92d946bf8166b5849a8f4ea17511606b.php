<?php $__env->startSection('content'); ?>


<section class="py-16 bg-base-200">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Our Services</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow text-center">
                <div class="card-body items-center">
                    <span class="material-icons text-5xl text-primary mb-2"><?php echo e($service->icon); ?></span>
                    <h3 class="card-title text-lg"><?php echo e($service->title); ?></h3>
                    <p class="text-base-content/70 text-sm"><?php echo e($service->description); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<?php if($properties->count()): ?>
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">Recent Properties</h2>
            <a href="<?php echo e(route('property')); ?>" class="btn btn-outline btn-primary btn-sm">View All</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow">
                <figure class="relative h-48 overflow-hidden">
                    <?php ($cover = $property->gallery->first()); ?>
                    <?php if($cover): ?>
                        <img src="<?php echo e($cover->file_path); ?>" alt="<?php echo e($property->title); ?>" class="w-full h-full object-cover">
                    <?php elseif($property->image && (Storage::disk('public')->exists('property/'.$property->image) || Storage::disk('public')->exists('property/gallery/'.$property->image))): ?>
                        <?php ($legacy = Storage::disk('public')->exists('property/'.$property->image) ? 'property/'.$property->image : 'property/gallery/'.$property->image); ?>
                        <img src="<?php echo e(Storage::url($legacy)); ?>" alt="<?php echo e($property->title); ?>"
                             class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full bg-base-300 flex items-center justify-center">
                            <span class="material-icons text-5xl text-base-content/30">home</span>
                        </div>
                    <?php endif; ?>
                    <?php if($property->is_featured): ?>
                    <div class="absolute top-2 right-2">
                        <div class="badge badge-warning gap-1 shadow">
                            <span class="material-icons text-xs">star</span> Featured
                        </div>
                    </div>
                    <?php endif; ?>
                </figure>
                <div class="card-body p-4">
                    <a href="<?php echo e(route('property.show', $property->slug)); ?>">
                        <h3 class="card-title text-base hover:text-primary transition-colors line-clamp-1">
                            <?php echo e(\Illuminate\Support\Str::limit($property->title, 40)); ?>

                        </h3>
                    </a>
                    <div class="flex flex-wrap gap-x-3 gap-y-1 text-sm text-base-content/60">
                        <span class="flex items-center gap-1"><span class="material-icons text-sm">place</span> <?php echo e(ucfirst($property->city)); ?></span>
                        <span class="flex items-center gap-1"><span class="material-icons text-sm">home</span> <?php echo e($property->address); ?></span>
                    </div>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="badge badge-outline badge-sm"><?php echo e(ucfirst($property->type)); ?></span>
                        <span class="badge badge-outline badge-sm"><?php echo e(ucfirst($property->status)); ?></span>
                    </div>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-xl font-bold text-primary">
                            Ksh <?php echo e(number_format($property->price ?? 0)); ?>

                        </span>
                        <div id="propertyrating-<?php echo e($property->id); ?>"></div>
                    </div>
                </div>
                <div class="px-4 pb-3 pt-2 border-t border-base-200 flex justify-between text-xs text-base-content/60">
                    <span class="flex items-center gap-1"><span class="material-icons text-sm">bed</span> <?php echo e($property->bedroom); ?></span>
                    <span class="flex items-center gap-1"><span class="material-icons text-sm">bathtub</span> <?php echo e($property->bathroom); ?></span>
                    <span class="flex items-center gap-1"><span class="material-icons text-sm">square_foot</span> <?php echo e($property->area); ?> sqft</span>
                    <span class="flex items-center gap-1"><span class="material-icons text-sm">comment</span> <?php echo e($property->comments_count); ?></span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if($testimonials->count()): ?>
<section class="py-16 bg-base-200">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">What Our Clients Say</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card bg-base-100 shadow-sm text-center">
                <div class="card-body items-center gap-3">
                    <div class="avatar">
                        <div class="w-16 h-16 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img src="<?php echo e(Storage::url('testimonial/'.$testimonial->image)); ?>" alt="<?php echo e($testimonial->name); ?>">
                        </div>
                    </div>
                    <p class="text-sm text-base-content/70 italic">"<?php echo e($testimonial->content); ?>"</p>
                    <p class="font-semibold text-sm"><?php echo e($testimonial->name); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if($posts->count()): ?>
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">Recent Blog Posts</h2>
            <a href="<?php echo e(route('blog')); ?>" class="btn btn-outline btn-primary btn-sm">View All</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow">
                <?php if(Storage::disk('public')->exists('posts/'.$post->image) && $post->image): ?>
                <figure class="h-44 overflow-hidden">
                    <img src="<?php echo e(Storage::url('posts/'.$post->image)); ?>" alt="<?php echo e($post->title); ?>"
                         class="w-full h-full object-cover">
                </figure>
                <?php endif; ?>
                <div class="card-body p-4">
                    <a href="<?php echo e(route('blog.show', $post->slug)); ?>">
                        <h3 class="card-title text-base hover:text-primary transition-colors line-clamp-2">
                            <?php echo e($post->title); ?>

                        </h3>
                    </a>
                    <p class="text-sm text-base-content/60 line-clamp-2">
                        <?php echo \Illuminate\Support\Str::limit(strip_tags($post->body), 100); ?>

                    </p>
                    <div class="flex items-center gap-2 mt-2 text-xs text-base-content/50">
                        <span class="material-icons text-sm">person</span>
                        <a href="<?php echo e(route('blog.author', $post->user->id)); ?>" class="hover:text-primary">
                            <?php echo e($post->user->name); ?>

                        </a>
                        <span>·</span>
                        <span class="material-icons text-sm">schedule</span>
                        <?php echo e($post->created_at->diffForHumans()); ?>

                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/frontend/index.blade.php ENDPATH**/ ?>