<div class="carousel carousel-center w-full rounded-box gap-2 p-2 bg-base-200">
    <?php $__currentLoopData = $property->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="carousel-item">
        <img src="<?php echo e($gallery->file_path); ?>"
             class="h-72 w-auto rounded-box object-cover cursor-pointer"
             onclick="openLightbox('<?php echo e($gallery->file_path); ?>')" />
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<dialog id="lightbox-modal" class="modal">
    <div class="modal-box max-w-4xl p-2 bg-black">
        <img id="lightbox-img" src="" class="w-full h-auto max-h-screen object-contain rounded" />
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

<script>
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-modal').showModal();
}
</script>
<?php /**PATH C:\projo\RealEstate-1\resources\views\pages\properties\slider.blade.php ENDPATH**/ ?>