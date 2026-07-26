<?php $__env->startSection('title', 'Gallery'); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 card bg-base-100 shadow-sm">
        <div class="card-body p-0">
            <div class="px-4 py-3 border-b border-base-200 flex items-center justify-between">
                <h2 class="font-bold text-lg">Gallery Images</h2>
                <a href="<?php echo e(route('admin.album')); ?>" class="btn btn-outline btn-sm gap-1">
                    <span class="material-icons text-sm">arrow_back</span> Albums
                </a>
            </div>
            <div class="p-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(Storage::url('gallery/'.$gallery->image)); ?>" class="block overflow-hidden rounded-box" data-src="<?php echo e(Storage::url('gallery/'.$gallery->image)); ?>">
                    <img src="<?php echo e(Storage::url('gallery/'.$gallery->image)); ?>" alt="gallery" class="w-full h-24 object-cover hover:scale-105 transition-transform">
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow-sm h-fit">
        <div class="card-body gap-4">
            <h2 class="card-title text-base">Upload Images</h2>
            <form action="<?php echo e(route('admin.galleries.store')); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="albumid" value="<?php echo e($album_id); ?>">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Images</legend>
                    <input type="file" name="file[]" multiple accept=".png,.jpg,.jpeg" class="file-input w-full">
                    <p class="fieldset-label">Select one or more images to upload</p>
                </fieldset>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">upload</span> Upload
                </button>
            </form>
            <a href="<?php echo e(route('admin.album.gallery', $album_id)); ?>" class="btn btn-outline gap-2 w-full">
                <span class="material-icons text-sm">refresh</span> Refresh Gallery
            </a>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/admin/galleries/gallery.blade.php ENDPATH**/ ?>