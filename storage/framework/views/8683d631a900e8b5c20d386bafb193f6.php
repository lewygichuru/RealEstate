<?php $__env->startSection('title', 'Show Property'); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    
    <div class="lg:col-span-2 space-y-4">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h2 class="card-title text-xl"><?php echo e($property->title); ?></h2>
                <p class="text-sm text-base-content/60">Posted by <strong><?php echo e($property->user->name); ?></strong> on <?php echo e($property->created_at->toFormattedDateString()); ?></p>
                <div class="divider my-0"></div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-sm">
                    <div><span class="font-semibold">Type:</span> <?php echo e($property->type); ?></div>
                    <div><span class="font-semibold">Status:</span> <?php echo e(ucfirst($property->status)); ?></div>
                    <div><span class="font-semibold">Price:</span> Ksh <?php echo e(number_format($property->price ?? 0)); ?></div>
                    <div><span class="font-semibold">City:</span> <?php echo e($property->city); ?></div>
                    <div><span class="font-semibold">State:</span> <?php echo e($property->state ?? '—'); ?></div>
                    <div><span class="font-semibold">Country:</span> <?php echo e($property->country ?? 'Kenya'); ?></div>
                    <div class="col-span-2"><span class="font-semibold">Address:</span> <?php echo e($property->address); ?></div>
                </div>
                <div class="divider my-0"></div>
                <h3 class="font-bold">Description</h3>
                <div class="prose max-w-none text-sm"><?php echo $property->description; ?></div>
            </div>
        </div>

        <?php ($unit = $property->units->first()); ?>
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-2">
                <h3 class="font-bold">Unit Details</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-sm">
                    <div><span class="font-semibold">Unit:</span> <?php echo e($unit?->unit_number ?? '—'); ?></div>
                    <div><span class="font-semibold">Floor:</span> <?php echo e($unit?->floor ?? '—'); ?></div>
                    <div><span class="font-semibold">Beds:</span> <?php echo e($unit?->bedrooms ?? 0); ?></div>
                    <div><span class="font-semibold">Baths:</span> <?php echo e($unit?->bathrooms ?? 0); ?></div>
                    <div><span class="font-semibold">Size:</span> <?php echo e($unit?->size_sqft ?? '—'); ?> sqft</div>
                    <div><span class="font-semibold">Rent:</span> Ksh <?php echo e(number_format($unit?->rent_amount ?? 0)); ?></div>
                    <div><span class="font-semibold">Deposit:</span> Ksh <?php echo e(number_format($unit?->deposit_amount ?? 0)); ?></div>
                    <div><span class="font-semibold">Unit Status:</span> <?php echo e(ucfirst($unit?->status ?? 'available')); ?></div>
                    <div class="col-span-2"><span class="font-semibold">Notes:</span> <?php echo e($unit?->notes ?? '—'); ?></div>
                </div>
            </div>
        </div>

        <?php if(!$property->gallery->isEmpty()): ?>
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-2">
                <h3 class="font-bold">Gallery</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                    <?php $__currentLoopData = $property->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e($gallery->file_path); ?>" alt="<?php echo e($gallery->file_name); ?>" class="w-full h-28 object-cover rounded-lg">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold"><?php echo e($property->comments_count); ?> Comments</h3>
                <?php $__currentLoopData = $property->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($comment->parent_id == NULL): ?>
                    <div class="flex gap-3">
                        <div class="avatar"><div class="w-9 h-9 rounded-full">
                            <?php if($comment->user && $comment->user->image && Storage::disk('public')->exists('users/'.$comment->user->image)): ?>
                                <img src="<?php echo e(Storage::url('users/'.$comment->user->image)); ?>" alt="">
                            <?php else: ?>
                                <div class="bg-base-300 w-9 h-9 rounded-full"></div>
                            <?php endif; ?>
                        </div></div>
                        <div class="flex-1">
                            <div class="flex justify-between text-sm"><strong><?php echo e($comment->user?->name ?? 'Unknown'); ?></strong><span class="text-base-content/50"><?php echo e($comment->created_at->diffForHumans()); ?></span></div>
                            <p class="text-sm mt-1"><?php echo e($comment->body); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php $__currentLoopData = $comment->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex gap-3 ml-10">
                        <div class="avatar"><div class="w-8 h-8 rounded-full">
                            <?php if($reply->user && $reply->user->image && Storage::disk('public')->exists('users/'.$reply->user->image)): ?>
                                <img src="<?php echo e(Storage::url('users/'.$reply->user->image)); ?>" alt="">
                            <?php else: ?>
                                <div class="bg-base-300 w-8 h-8 rounded-full"></div>
                            <?php endif; ?>
                        </div></div>
                        <div class="flex-1">
                            <div class="flex justify-between text-sm"><strong><?php echo e($reply->user?->name ?? 'Unknown'); ?></strong><span class="text-base-content/50"><?php echo e($reply->created_at->diffForHumans()); ?></span></div>
                            <p class="text-sm mt-1"><?php echo e($reply->body); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    <div class="space-y-4">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-2">
                <h3 class="font-bold">Status</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="badge badge-primary"><?php echo e($property->type); ?></span>
                    <span class="badge badge-outline"><?php echo e(ucfirst($property->status)); ?></span>
                    <?php if($property->is_featured): ?>
                        <span class="badge badge-warning">Featured</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-2">
                <h3 class="font-bold">Amenities</h3>
                <div class="flex flex-wrap gap-1">
                    <?php $__empty_1 = true; $__currentLoopData = ($property->amenities ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <span class="badge badge-success badge-sm"><?php echo e($amenity); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <span class="text-sm text-base-content/60">No amenities listed.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if($property->latitude && $property->longitude): ?>
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold">Location</h3>
                <div class="text-sm text-base-content/70"><?php echo e($property->latitude); ?>, <?php echo e($property->longitude); ?></div>
                <div id="gmap_markers" class="w-full h-48 rounded-lg"></div>
            </div>
        </div>
        <?php endif; ?>
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-2">
                <h3 class="font-bold">Gallery Image</h3>
                <?php ($cover = $property->gallery->first()); ?>
                <?php if($cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path)): ?>
                    <img src="<?php echo e(Storage::url($cover->file_path)); ?>" alt="<?php echo e($property->title); ?>" class="w-full rounded-lg">
                <?php elseif($property->image && (Storage::disk('public')->exists('property/'.$property->image) || Storage::disk('public')->exists('property/gallery/'.$property->image))): ?>
                    <?php ($legacy = Storage::disk('public')->exists('property/'.$property->image) ? 'property/'.$property->image : 'property/gallery/'.$property->image); ?>
                    <img src="<?php echo e(Storage::url($legacy)); ?>" alt="<?php echo e($property->title); ?>" class="w-full rounded-lg">
                <?php endif; ?>
                <div class="flex gap-2">
                    <a href="<?php echo e(route('admin.properties.index')); ?>" class="btn btn-outline btn-sm gap-1"><span class="material-icons text-sm">arrow_back</span> Back</a>
                    <a href="<?php echo e(route('admin.properties.edit', $property->id)); ?>" class="btn btn-info btn-sm gap-1"><span class="material-icons text-sm">edit</span> Edit</a>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php if($property->latitude && $property->longitude): ?>
    <script src="https://maps.google.com/maps/api/js?v=3&sensor=false"></script>
    <script src="<?php echo e(asset('backend/plugins/gmaps/gmaps.js')); ?>"></script>
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
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\properties\show.blade.php ENDPATH**/ ?>