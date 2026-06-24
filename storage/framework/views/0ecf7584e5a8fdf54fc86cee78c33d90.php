<?php $__env->startSection('title', 'Edit Service'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-base-100 shadow-sm max-w-xl">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Edit Service</h2>
            <a href="<?php echo e(route('admin.services.index')); ?>" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>
        <form action="<?php echo e(route('admin.services.update', $service->id)); ?>" method="POST" class="flex flex-col gap-4">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Service Title</legend>
                <input type="text" name="title" value="<?php echo e($service->title); ?>" class="input w-full" required>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Description</legend>
                <textarea name="description" rows="4" class="textarea w-full"><?php echo e($service->description); ?></textarea>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Icon</legend>
                <input type="text" name="icon" value="<?php echo e($service->icon); ?>" class="input w-full">
                <p class="fieldset-label">Use <a href="https://fonts.google.com/icons" target="_blank" class="link link-primary">Material Icons</a> names</p>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Order</legend>
                <input type="number" name="order" value="<?php echo e($service->order); ?>" class="input w-full" min="1">
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">save</span> Update
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\services\edit.blade.php ENDPATH**/ ?>