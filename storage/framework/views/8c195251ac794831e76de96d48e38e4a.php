<?php $__env->startSection('title', 'Create Property'); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.properties.store')); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    
    <div class="lg:col-span-2 space-y-4">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-4">
                <h2 class="card-title">Create Property</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <fieldset class="fieldset sm:col-span-2"><legend class="fieldset-legend">Title</legend>
                        <input type="text" name="title" class="input w-full" value="<?php echo e(old('title')); ?>" required>
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Type</legend>
                        <input type="text" name="type" class="input w-full" value="<?php echo e(old('type')); ?>" required>
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Status</legend>
                        <?php ($statusValue = old('status', 'available')); ?>
                        <select name="status" class="select w-full" required>
                            <option value="available" <?php if($statusValue === 'available'): echo 'selected'; endif; ?>>Available</option>
                            <option value="rented" <?php if($statusValue === 'rented'): echo 'selected'; endif; ?>>Rented</option>
                            <option value="maintenance" <?php if($statusValue === 'maintenance'): echo 'selected'; endif; ?>>Maintenance</option>
                        </select>
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Price ($)</legend>
                        <input type="number" name="price" class="input w-full" value="<?php echo e(old('price')); ?>" required>
                    </fieldset>
                    <div class="sm:col-span-2">
                        <?php echo $__env->make('partials.property-location', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
                <label class="label cursor-pointer gap-2 justify-start w-fit">
                    <input type="checkbox" name="is_featured" value="1" class="checkbox checkbox-primary checkbox-sm" <?php if(old('is_featured')): echo 'checked'; endif; ?>>
                    <span>Featured Property</span>
                </label>
                <fieldset class="fieldset"><legend class="fieldset-legend">Description</legend>
                    <textarea name="description" id="tinymce" rows="8" class="textarea w-full" required><?php echo e(old('description')); ?></textarea>
                </fieldset>
                <?php echo $__env->make('partials.property-amenities', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-4">
                <h3 class="font-bold">Unit Details</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <fieldset class="fieldset"><legend class="fieldset-legend">Unit Number</legend>
                        <input type="text" name="unit_number" class="input w-full" value="<?php echo e(old('unit_number')); ?>">
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Floor</legend>
                        <input type="number" name="floor" class="input w-full" value="<?php echo e(old('floor')); ?>">
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Bedrooms</legend>
                        <input type="number" name="bedroom" class="input w-full" value="<?php echo e(old('bedroom')); ?>" required>
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Bathrooms</legend>
                        <input type="number" name="bathroom" class="input w-full" value="<?php echo e(old('bathroom')); ?>" required>
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Size (sqft)</legend>
                        <input type="number" name="size_sqft" class="input w-full" value="<?php echo e(old('size_sqft')); ?>">
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Rent Amount</legend>
                        <input type="number" name="rent_amount" class="input w-full" value="<?php echo e(old('rent_amount')); ?>">
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Deposit Amount</legend>
                        <input type="number" name="deposit_amount" class="input w-full" value="<?php echo e(old('deposit_amount')); ?>">
                    </fieldset>
                    <fieldset class="fieldset"><legend class="fieldset-legend">Unit Status</legend>
                        <?php ($unitStatusValue = old('unit_status', 'available')); ?>
                        <select name="unit_status" class="select w-full">
                            <option value="available" <?php if($unitStatusValue === 'available'): echo 'selected'; endif; ?>>Available</option>
                            <option value="occupied" <?php if($unitStatusValue === 'occupied'): echo 'selected'; endif; ?>>Occupied</option>
                            <option value="maintenance" <?php if($unitStatusValue === 'maintenance'): echo 'selected'; endif; ?>>Maintenance</option>
                        </select>
                    </fieldset>
                    <fieldset class="fieldset sm:col-span-2"><legend class="fieldset-legend">Unit Notes</legend>
                        <textarea name="unit_notes" rows="3" class="textarea w-full"><?php echo e(old('unit_notes')); ?></textarea>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    
    <div class="space-y-4">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold">Gallery Image</h3>
                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full" required>
                <p class="text-xs text-base-content/60">Uploaded image is added to the property gallery.</p>
                <div class="flex gap-2 mt-2">
                    <a href="<?php echo e(route('admin.properties.index')); ?>" class="btn btn-outline gap-1">
                        <span class="material-icons text-sm">arrow_back</span> Back
                    </a>
                    <button type="submit" class="btn btn-primary gap-1">
                        <span class="material-icons text-sm">save</span> Save
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('backend/plugins/tinymce/tinymce.js')); ?>"></script>
    <script>
        $(function () {
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern", height: 300,
                plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak','searchreplace wordcount visualblocks visualchars code fullscreen','insertdatetime media nonbreaking save table contextmenu directionality','emoticons template paste textcolor colorpicker textpattern imagetools'],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons', image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '<?php echo e(asset('backend/plugins/tinymce')); ?>';
        });

        // Ensure TinyMCE content is saved before form submission
        $('form').on('submit', function(e) {
            if (typeof tinymce !== 'undefined' && tinymce.get('tinymce')) {
                tinymce.triggerSave();
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\RealEstate\resources\views/admin/properties/create.blade.php ENDPATH**/ ?>