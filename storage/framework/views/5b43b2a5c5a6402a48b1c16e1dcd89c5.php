
<div class="card bg-base-100 shadow-sm mb-6">
    <div class="card-body p-4">
        <h3 class="font-bold text-sm uppercase tracking-wide mb-3">Popular Posts</h3>
        <ul class="menu menu-sm -mx-2">
            <?php $__currentLoopData = $popularposts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e(route('blog.show', $post->slug)); ?>" class="text-sm line-clamp-1">
                    <?php echo e($post->title); ?>

                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>


<div class="card bg-base-100 shadow-sm mb-6">
    <div class="card-body p-4">
        <h3 class="font-bold text-sm uppercase tracking-wide mb-3">Categories</h3>
        <ul class="space-y-2">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e(route('blog.categories', $category->slug)); ?>"
                   class="flex items-center justify-between text-sm hover:text-primary transition-colors">
                    <span><?php echo e($category->name); ?></span>
                    <span class="badge badge-outline badge-sm"><?php echo e($category->posts_count); ?></span>
                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>


<div class="card bg-base-100 shadow-sm mb-6">
    <div class="card-body p-4">
        <h3 class="font-bold text-sm uppercase tracking-wide mb-3">Archives</h3>
        <ul class="space-y-1">
            <?php $__currentLoopData = $archives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="/blog/?month=<?php echo e($stats['month']); ?>&year=<?php echo e($stats['year']); ?>"
                   class="flex items-center justify-between text-sm hover:text-primary transition-colors">
                    <span><?php echo e($stats['month']); ?> <?php echo e($stats['year']); ?></span>
                    <span class="badge badge-primary badge-sm"><?php echo e($stats['published']); ?></span>
                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>


<div class="card bg-base-100 shadow-sm">
    <div class="card-body p-4">
        <h3 class="font-bold text-sm uppercase tracking-wide mb-3">Tags</h3>
        <div class="flex flex-wrap gap-2">
            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('blog.tags', $tag->slug)); ?>" class="badge badge-outline hover:badge-primary transition-colors">
                <?php echo e($tag->name); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH C:\projo\RealEstate-1\resources\views\pages\blog\sidebar.blade.php ENDPATH**/ ?>