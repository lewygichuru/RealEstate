<?php $__env->startSection('content'); ?>
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside><?php echo $__env->make('agent.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></aside>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body gap-4">
                        <div class="flex items-center justify-between">
                            <h2 class="card-title">Create Property</h2>
                            <a href="<?php echo e(route('agent.properties.index')); ?>" class="btn btn-outline btn-sm gap-1">
                                <span class="material-icons text-sm">arrow_back</span> Back
                            </a>
                        </div>

                        <form action="<?php echo e(route('agent.properties.store')); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                            <?php echo csrf_field(); ?>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Title</legend>
                                <input type="text" name="title" class="input w-full" value="<?php echo e(old('title')); ?>" maxlength="200" required>
                            </fieldset>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Type</legend>
                                    <input type="text" name="type" class="input w-full" value="<?php echo e(old('type')); ?>" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Status</legend>
                                    <?php ($statusValue = old('status', 'available')); ?>
                                    <select name="status" class="select w-full" required>
                                        <option value="available" <?php if($statusValue === 'available'): echo 'selected'; endif; ?>>Available</option>
                                        <option value="rented" <?php if($statusValue === 'rented'): echo 'selected'; endif; ?>>Rented</option>
                                        <option value="maintenance" <?php if($statusValue === 'maintenance'): echo 'selected'; endif; ?>>Maintenance</option>
                                    </select>
                                </fieldset>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Price</legend>
                                    <input type="number" name="price" class="input w-full" value="<?php echo e(old('price')); ?>" required>
                                </fieldset>
                                <div class="sm:col-span-2">
                                    <?php echo $__env->make('partials.property-location', ['as_textarea' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="is_featured" value="1" class="checkbox checkbox-primary" <?php if(old('is_featured')): echo 'checked'; endif; ?>>
                                <span class="label-text">Featured Property</span>
                            </div>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Description</legend>
                                <textarea name="description" rows="5" class="textarea w-full" required><?php echo e(old('description')); ?></textarea>
                            </fieldset>

                            <?php echo $__env->make('partials.property-amenities', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                            <div class="divider">Unit Details</div>


                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Unit Number</legend>
                                    <input type="text" name="unit_number" class="input w-full" value="<?php echo e(old('unit_number')); ?>">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Floor</legend>
                                    <input type="number" name="floor" class="input w-full" value="<?php echo e(old('floor')); ?>">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Bedrooms</legend>
                                    <input type="number" name="bedroom" class="input w-full" value="<?php echo e(old('bedroom')); ?>" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Bathrooms</legend>
                                    <input type="number" name="bathroom" class="input w-full" value="<?php echo e(old('bathroom')); ?>" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Size (sqft)</legend>
                                    <input type="number" name="size_sqft" class="input w-full" value="<?php echo e(old('size_sqft')); ?>">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Rent Amount</legend>
                                    <input type="number" name="rent_amount" class="input w-full" value="<?php echo e(old('rent_amount')); ?>">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Deposit Amount</legend>
                                    <input type="number" name="deposit_amount" class="input w-full" value="<?php echo e(old('deposit_amount')); ?>">
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Unit Status</legend>
                                    <?php ($unitStatusValue = old('unit_status', 'available')); ?>
                                    <select name="unit_status" class="select w-full">
                                        <option value="available" <?php if($unitStatusValue === 'available'): echo 'selected'; endif; ?>>Available</option>
                                        <option value="occupied" <?php if($unitStatusValue === 'occupied'): echo 'selected'; endif; ?>>Occupied</option>
                                        <option value="maintenance" <?php if($unitStatusValue === 'maintenance'): echo 'selected'; endif; ?>>Maintenance</option>
                                    </select>
                                </fieldset>
                                <fieldset class="fieldset sm:col-span-2">
                                    <legend class="fieldset-legend">Unit Notes</legend>
                                    <textarea name="unit_notes" rows="3" class="textarea w-full"><?php echo e(old('unit_notes')); ?></textarea>
                                </fieldset>
                            </div>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Gallery Image</legend>
                                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full" required>
                                <p class="fieldset-label">Uploaded image is added to the property gallery</p>
                            </fieldset>

                            <div>
                                <button type="submit" class="btn btn-primary gap-2">
                                    <span class="material-icons text-sm">send</span> Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\agent\properties\create.blade.php ENDPATH**/ ?>