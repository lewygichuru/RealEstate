<?php $__env->startSection('title', 'Create Tag'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-base-100 shadow-sm max-w-lg">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Create Tag</h2>
            <a href="<?php echo e(route('admin.tags.index')); ?>" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>
        <form action="<?php echo e(route('admin.tags.store')); ?>" method="POST" class="flex flex-col gap-4">
            <?php echo csrf_field(); ?>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Tag Name</legend>
                <input type="text" name="name" class="input w-full" required>
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">save</span> Save
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/admin/tags/create.blade.php ENDPATH**/ ?>