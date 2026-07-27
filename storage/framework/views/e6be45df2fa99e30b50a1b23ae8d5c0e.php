<?php $__env->startSection('title', 'Gallery Albums'); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 card bg-base-100 shadow-sm">
        <div class="card-body p-0">
            <div class="px-4 py-3 border-b border-base-200">
                <h2 class="font-bold text-lg">Albums</h2>
            </div>
            <div class="p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card bg-base-200 shadow-sm overflow-hidden flex flex-col">
                    <a href="<?php echo e(route('admin.album.gallery', $album->id)); ?>" class="flex-grow hover:bg-base-300 transition-colors">
                        <?php if($album->files->isNotEmpty()): ?>
                            <?php $__currentLoopData = $album->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key == 0): ?>
                                    <figure class="h-28 overflow-hidden">
                                        <img src="<?php echo e(Storage::url('gallery/'.$file->file_name)); ?>" alt="<?php echo e($album->title); ?>" class="w-full h-full object-cover">
                                    </figure>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="h-28 flex items-center justify-center bg-base-300">
                                <span class="material-icons text-4xl text-base-content/30">collections</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body p-3">
                            <p class="font-semibold text-sm"><?php echo e($album->title); ?></p>
                            <p class="text-xs text-base-content/50"><?php echo e($album->files->count()); ?> images</p>
                        </div>
                    </a>
                    <div class="flex items-center justify-end px-3 pb-3 gap-2">
                        <a href="<?php echo e(route('admin.album.gallery', $album->id)); ?>" class="btn btn-xs btn-outline btn-info" title="View">
                            <span class="material-icons text-sm" style="font-size: 14px;">visibility</span>
                        </a>
                        <a href="<?php echo e(route('admin.album.edit', $album->id)); ?>" class="btn btn-xs btn-outline btn-primary" title="Edit">
                            <span class="material-icons text-sm" style="font-size: 14px;">edit</span>
                        </a>
                        <form action="<?php echo e(route('admin.album.destroy', $album->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this album?');" class="inline m-0">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-xs btn-outline btn-error" title="Delete">
                                <span class="material-icons text-sm" style="font-size: 14px;">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow-sm h-fit">
        <div class="card-body gap-4">
            <h2 class="card-title text-base">Create Album</h2>
            <form action="<?php echo e(route('admin.album.store')); ?>" method="POST" class="flex flex-col gap-4">
                <?php echo csrf_field(); ?>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Album Name</legend>
                    <input type="text" name="name" class="input w-full" required>
                </fieldset>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">save</span> Create Album
                </button>
            </form>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/admin/galleries/album.blade.php ENDPATH**/ ?>