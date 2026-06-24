<?php $__env->startSection('content'); ?>
<section class="py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Gallery</h1>

        <div class="columns-1 sm:columns-2 lg:columns-3 gap-4 space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if(Storage::disk('public')->exists('gallery/'.$gallery->image) && $gallery->image): ?>
                <div class="break-inside-avoid">
                    <img src="<?php echo e(Storage::url('gallery/'.$gallery->image)); ?>"
                         alt="Gallery image"
                         class="w-full rounded-box cursor-pointer hover:opacity-90 transition-opacity shadow-sm"
                         onclick="openGalleryLightbox('<?php echo e(Storage::url('gallery/'.$gallery->image)); ?>')">
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-3">
                <div class="alert"><span class="material-icons">info</span> No gallery images yet.</div>
            </div>
            <?php endif; ?>
        </div>

        <div class="mt-10 flex justify-center">
            <?php echo e($galleries->links()); ?>

        </div>
    </div>
</section>

<dialog id="gallery-modal" class="modal">
    <div class="modal-box max-w-4xl p-2 bg-black">
        <img id="gallery-img" src="" class="w-full h-auto max-h-[80vh] object-contain rounded" />
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function openGalleryLightbox(src) {
    document.getElementById('gallery-img').src = src;
    document.getElementById('gallery-modal').showModal();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/pages/gallery.blade.php ENDPATH**/ ?>