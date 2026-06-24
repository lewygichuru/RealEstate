<?php $__env->startSection('title', 'Edit Post'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $selectedCategories = $post->categories->pluck('id')->toArray();
    $selectedTags = $post->tags->pluck('id')->toArray();
?>
<form action="<?php echo e(route('admin.posts.update', $post->slug)); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 card bg-base-100 shadow-sm">
        <div class="card-body gap-4">
            <div class="flex items-center justify-between">
                <h2 class="card-title">Edit Post</h2>
                <a href="<?php echo e(route('admin.posts.index')); ?>" class="btn btn-outline btn-sm gap-1">
                    <span class="material-icons text-sm">arrow_back</span> Back
                </a>
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Post Title</legend>
                <input type="text" name="title" value="<?php echo e($post->title); ?>" class="input w-full" required>
            </fieldset>
            <div class="flex items-center gap-2">
                <input type="checkbox" id="published" name="status" value="published" class="checkbox checkbox-primary" <?php echo e($post->status === 'published' ? 'checked' : ''); ?>>
                <label for="published" class="label-text cursor-pointer">Published</label>
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Body</legend>
                <textarea name="content" id="tinymce" class="textarea w-full min-h-48"><?php echo e(old('content', $post->content)); ?></textarea>
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
                        <option value="<?php echo e($category->id); ?>" <?php echo e(in_array($category->id, old('categories', $selectedCategories)) ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Tags</legend>
                <select name="tags[]" multiple class="select w-full h-28" required>
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tag->id); ?>" <?php echo e(in_array($tag->id, old('tags', $selectedTags)) ? 'selected' : ''); ?>><?php echo e($tag->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Featured Image</legend>
                <?php if($post->featured_image && Storage::disk('public')->exists('posts/'.$post->featured_image)): ?>
                    <img src="<?php echo e(Storage::url('posts/'.$post->featured_image)); ?>" alt="<?php echo e($post->title); ?>" class="h-20 rounded-box object-cover mb-2">
                <?php endif; ?>
                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full">
            </fieldset>
            <button type="submit" class="btn btn-primary gap-2">
                <span class="material-icons text-sm">save</span> Update Post
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

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\posts\edit.blade.php ENDPATH**/ ?>