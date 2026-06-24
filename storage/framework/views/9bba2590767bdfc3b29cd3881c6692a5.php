<?php $__env->startSection('title', 'Create Post'); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.posts.store')); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 card bg-base-100 shadow-sm">
        <div class="card-body gap-4">
            <div class="flex items-center justify-between">
                <h2 class="card-title">Create Post</h2>
                <a href="<?php echo e(route('admin.posts.index')); ?>" class="btn btn-outline btn-sm gap-1">
                    <span class="material-icons text-sm">arrow_back</span> Back
                </a>
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Post Title</legend>
                <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="input w-full" required>
            </fieldset>
            <div class="flex items-center gap-2">
                <input type="checkbox" id="published" name="status" value="published" class="checkbox checkbox-primary">
                <label for="published" class="label-text cursor-pointer">Published</label>
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Body</legend>
                <textarea name="content" id="tinymce" class="textarea w-full min-h-48"><?php echo e(old('content')); ?></textarea>
            </fieldset>
        </div>
    </div>

    <div class="card bg-base-100 shadow-sm h-fit">
        <div class="card-body gap-4">
            <h2 class="card-title text-base">Post Options</h2>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Categories</legend>
                <select name="categories[]" multiple class="select w-full h-28" required>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(in_array($category->id, old('categories', [])) ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Tags</legend>
                <select name="tags[]" multiple class="select w-full h-28" required>
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tag->id); ?>" <?php echo e(in_array($tag->id, old('tags', [])) ? 'selected' : ''); ?>><?php echo e($tag->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Featured Image</legend>
                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full">
            </fieldset>
            <button type="submit" class="btn btn-primary gap-2">
                <span class="material-icons text-sm">save</span> Save Post
            </button>
        </div>
    </div>

</div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('backend/plugins/tinymce/tinymce.js')); ?>"></script>
<script>
tinymce.init({
    selector: 'textarea#tinymce',
    height: 350,
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image',
});
tinymce.suffix = '.min';
tinyMCE.baseURL = '<?php echo e(asset('backend/plugins/tinymce')); ?>';
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\posts\create.blade.php ENDPATH**/ ?>