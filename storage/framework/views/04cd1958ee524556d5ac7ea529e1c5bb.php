<?php $__env->startSection('title', 'Create Testimonial'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-base-100 shadow-sm max-w-xl">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Create Testimonial</h2>
            <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>
        <form action="<?php echo e(route('admin.testimonials.store')); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            <?php echo csrf_field(); ?>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Name</legend>
                <input type="text" name="name" class="input w-full" required>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Testimonial</legend>
                <textarea name="content" rows="4" class="textarea w-full"></textarea>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Image</legend>
                <img src="" id="testimonial-preview" class="w-24 h-24 object-cover rounded-full mb-2 hidden">
                <input type="file" name="image" id="testimonial-image-input" accept=".png,.jpg,.jpeg" class="file-input w-full">
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

<?php $__env->startPush('scripts'); ?>
<script>
document.getElementById('testimonial-image-input').addEventListener('change', function() {
    var preview = document.getElementById('testimonial-preview');
    if (this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { preview.src = e.target.result; preview.classList.remove('hidden'); };
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\testimonials\create.blade.php ENDPATH**/ ?>