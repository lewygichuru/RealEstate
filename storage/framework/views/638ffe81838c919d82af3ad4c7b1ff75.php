<?php $__env->startSection('title', 'Edit Slider'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-base-100 shadow-sm max-w-xl">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Edit Slider</h2>
            <a href="<?php echo e(route('admin.sliders.index')); ?>" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>
        <form action="<?php echo e(route('admin.sliders.update', $slider->id)); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Title</legend>
                <input type="text" name="title" value="<?php echo e($slider->title); ?>" class="input w-full">
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Description</legend>
                <textarea name="description" rows="4" class="textarea w-full"><?php echo e($slider->description); ?></textarea>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Image</legend>
                <?php if(Storage::disk('public')->exists('slider/'.$slider->image)): ?>
                    <img src="<?php echo e(Storage::url('slider/'.$slider->image)); ?>" id="slider-preview" alt="<?php echo e($slider->title); ?>" class="h-32 object-cover rounded-box mb-2">
                <?php else: ?>
                    <img src="" id="slider-preview" class="h-32 object-cover rounded-box mb-2 hidden">
                <?php endif; ?>
                <input type="file" name="image" id="slider-image-input" accept=".png,.jpg,.jpeg" class="file-input w-full">
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

<?php $__env->startPush('scripts'); ?>
<script>
document.getElementById('slider-image-input').addEventListener('change', function() {
    var preview = document.getElementById('slider-preview');
    if (this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { preview.src = e.target.result; preview.classList.remove('hidden'); };
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\sliders\edit.blade.php ENDPATH**/ ?>