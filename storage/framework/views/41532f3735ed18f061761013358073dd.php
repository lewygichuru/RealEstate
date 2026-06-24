<?php $__env->startSection('content'); ?>
<section class="py-12">
    <div class="container mx-auto px-4">

        <h1 class="text-3xl font-bold mb-6">Properties</h1>

        
        <?php if($cities->count()): ?>
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="<?php echo e(route('property')); ?>" class="btn btn-sm btn-outline btn-primary">All Cities</a>
            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('property.city', $city->city)); ?>" class="btn btn-sm btn-outline">
                    <?php echo e($city->city); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-3">
                <div class="alert alert-info">
                    <span class="material-icons">info</span>
                    No properties found.
                </div>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="mt-10 flex justify-center">
            <?php echo e($properties->links()); ?>

        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/pages/properties/property.blade.php ENDPATH**/ ?>