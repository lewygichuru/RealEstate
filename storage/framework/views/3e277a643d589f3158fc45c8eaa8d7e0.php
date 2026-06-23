<?php if($paginator->hasPages()): ?>
<nav aria-label="Pagination">
    <div class="join">

        
        <?php if($paginator->onFirstPage()): ?>
            <button class="join-item btn btn-sm btn-disabled" aria-disabled="true">«</button>
        <?php else: ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="join-item btn btn-sm" rel="prev">«</a>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_string($element)): ?>
                <button class="join-item btn btn-sm btn-disabled"><?php echo e($element); ?></button>
            <?php endif; ?>
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <button class="join-item btn btn-sm btn-primary" aria-current="page"><?php echo e($page); ?></button>
                    <?php else: ?>
                        <a href="<?php echo e($url); ?>" class="join-item btn btn-sm"><?php echo e($page); ?></a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="join-item btn btn-sm" rel="next">»</a>
        <?php else: ?>
            <button class="join-item btn btn-sm btn-disabled" aria-disabled="true">»</button>
        <?php endif; ?>

    </div>
</nav>
<?php endif; ?>
<?php /**PATH C:\Users\Admin\Desktop\RealEstate\resources\views/vendor/pagination/daisy.blade.php ENDPATH**/ ?>