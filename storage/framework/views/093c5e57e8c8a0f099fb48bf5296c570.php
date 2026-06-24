<?php $__env->startSection('title', 'Edit Category'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-base-100 shadow-sm max-w-lg">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Edit Category</h2>
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>
        <form action="<?php echo e(route('admin.categories.update', $category->id)); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Category Name</legend>
                <input type="text" name="name" value="<?php echo e($category->name); ?>" class="input w-full" required>
            </fieldset>
            <?php if(Storage::disk('public')->exists('category/thumb/'.$category->image)): ?>
            <div>
                <img src="<?php echo e(Storage::url('category/thumb/'.$category->image)); ?>" alt="<?php echo e($category->name); ?>" class="h-24 rounded-box object-cover">
            </div>
            <?php endif; ?>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Replace Image</legend>
                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full">
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

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\categories\edit.blade.php ENDPATH**/ ?>