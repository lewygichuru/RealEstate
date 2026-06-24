<?php $__env->startSection('content'); ?>
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            
            <aside>
                <div class="card bg-base-100 shadow-sm sticky top-20">
                    <div class="card-body p-4 gap-3">
                        <h2 class="card-title text-base">Filter Properties</h2>

                        <form action="<?php echo e(route('search')); ?>" method="GET" class="flex flex-col gap-3">

                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">City</legend>
                                <input type="text" name="city" value="<?php echo e(request('city')); ?>"
                                       placeholder="Enter city..." list="search-city-list"
                                       class="input input-sm w-full" autocomplete="off">
                                <datalist id="search-city-list">
                                    <?php $__currentLoopData = $citylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($city); ?>">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </datalist>
                            </fieldset>

                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Type</legend>
                                <select name="type" class="select select-sm w-full">
                                    <option value="">Any Type</option>
                                    <option value="apartment" <?php echo e(request('type') == 'apartment' ? 'selected' : ''); ?>>Apartment</option>
                                    <option value="house" <?php echo e(request('type') == 'house' ? 'selected' : ''); ?>>House</option>
                                </select>
                            </fieldset>

                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Status</legend>
                                <select name="status" class="select select-sm w-full">
                                    <option value="">Any Status</option>
                                    <option value="available" <?php echo e(request('status') == 'available' ? 'selected' : ''); ?>>Available</option>
                                    <option value="rented" <?php echo e(request('status') == 'rented' ? 'selected' : ''); ?>>Rented</option>
                                    <option value="maintenance" <?php echo e(request('status') == 'maintenance' ? 'selected' : ''); ?>>Maintenance</option>
                                </select>
                            </fieldset>

                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Bedrooms</legend>
                                <select name="bedroom" class="select select-sm w-full">
                                    <option value="">Any</option>
                                    <?php $__currentLoopData = $bedroomdistinct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($b->bedroom); ?>" <?php echo e(request('bedroom') == $b->bedroom ? 'selected' : ''); ?>><?php echo e($b->bedroom); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </fieldset>

                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Bathrooms</legend>
                                <select name="bathroom" class="select select-sm w-full">
                                    <option value="">Any</option>
                                    <?php $__currentLoopData = $bathroomdistinct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($b->bathroom); ?>" <?php echo e(request('bathroom') == $b->bathroom ? 'selected' : ''); ?>><?php echo e($b->bathroom); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </fieldset>

                            <div class="grid grid-cols-2 gap-2">
                                <fieldset class="fieldset py-0">
                                    <legend class="fieldset-legend">Min Price</legend>
                                    <input type="number" name="minprice" value="<?php echo e(request('minprice')); ?>"
                                           placeholder="0" class="input input-sm w-full">
                                </fieldset>
                                <fieldset class="fieldset py-0">
                                    <legend class="fieldset-legend">Max Price</legend>
                                    <input type="number" name="maxprice" value="<?php echo e(request('maxprice')); ?>"
                                           placeholder="Any" class="input input-sm w-full">
                                </fieldset>
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <fieldset class="fieldset py-0">
                                    <legend class="fieldset-legend">Min Area</legend>
                                    <input type="number" name="minarea" value="<?php echo e(request('minarea')); ?>"
                                           placeholder="0" class="input input-sm w-full">
                                </fieldset>
                                <fieldset class="fieldset py-0">
                                    <legend class="fieldset-legend">Max Area</legend>
                                    <input type="number" name="maxarea" value="<?php echo e(request('maxarea')); ?>"
                                           placeholder="Any" class="input input-sm w-full">
                                </fieldset>
                            </div>

                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="featured" class="checkbox checkbox-primary checkbox-sm"
                                       <?php echo e(request('featured') ? 'checked' : ''); ?>>
                                <span class="text-sm">Featured only</span>
                            </label>

                            <button type="submit" class="btn btn-primary btn-sm w-full gap-1">
                                <span class="material-icons text-sm">search</span> Search
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            
            <div class="lg:col-span-3">
                <h1 class="text-2xl font-bold mb-6">
                    Search Results
                    <span class="text-base font-normal text-base-content/50">(<?php echo e($properties->total()); ?> found)</span>
                </h1>

                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="card card-side bg-base-100 shadow-sm hover:shadow-md transition-shadow">
                        <?php ($cover = $property->gallery->first()); ?>
                        <?php if($cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path)): ?>
                        <figure class="w-44 shrink-0">
                            <img src="<?php echo e(Storage::url($cover->file_path)); ?>" alt="<?php echo e($property->title); ?>"
                                 class="h-full w-full object-cover">
                        </figure>
                        <?php elseif($property->image && (Storage::disk('public')->exists('property/'.$property->image) || Storage::disk('public')->exists('property/gallery/'.$property->image))): ?>
                        <figure class="w-44 shrink-0">
                            <?php ($legacyPath = Storage::disk('public')->exists('property/'.$property->image) ? 'property/'.$property->image : 'property/gallery/'.$property->image); ?>
                            <img src="<?php echo e(Storage::url($legacyPath)); ?>" alt="<?php echo e($property->title); ?>"
                                 class="h-full w-full object-cover">
                        </figure>
                        <?php endif; ?>
                        <div class="card-body p-4">
                            <a href="<?php echo e(route('property.show', $property->slug)); ?>">
                                <h3 class="card-title text-base hover:text-primary transition-colors line-clamp-1">
                                    <?php echo e($property->title); ?>

                                </h3>
                            </a>
                            <p class="flex items-center gap-1 text-sm text-base-content/60">
                                <span class="material-icons text-sm">location_city</span><?php echo e(ucfirst($property->city)); ?>

                                <span class="material-icons text-sm ml-1">place</span><?php echo e(ucfirst($property->address)); ?>

                            </p>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-lg font-bold text-primary">
                                    Ksh <?php echo e(number_format($property->price ?? 0)); ?>

                                </span>
                                <span class="badge badge-outline badge-sm"><?php echo e(ucfirst($property->type)); ?> · <?php echo e(ucfirst($property->status)); ?></span>
                            </div>
                            <div class="flex flex-wrap gap-3 text-xs text-base-content/60 mt-1">
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">bed</span> <?php echo e($property->bedroom); ?> bed</span>
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">bathtub</span> <?php echo e($property->bathroom); ?> bath</span>
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">square_foot</span> <?php echo e($property->area); ?> sqft</span>
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">comment</span> <?php echo e($property->comments_count); ?></span>
                                <?php if($property->is_featured): ?>
                                    <span class="badge badge-warning badge-sm ml-auto">Featured</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="alert">
                        <span class="material-icons">info</span>
                        No properties found matching your criteria.
                    </div>
                    <?php endif; ?>
                </div>

                <div class="mt-8 flex justify-center">
                    <?php echo e($properties->appends([
                        'city'      => request('city'),
                        'type'      => request('type'),
                        'status'    => request('status'),
                        'bedroom'   => request('bedroom'),
                        'bathroom'  => request('bathroom'),
                        'minprice'  => request('minprice'),
                        'maxprice'  => request('maxprice'),
                        'minarea'   => request('minarea'),
                        'maxarea'   => request('maxarea'),
                        'featured'  => request('featured'),
                    ])->links()); ?>

                </div>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\pages\search.blade.php ENDPATH**/ ?>