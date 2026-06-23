<?php $__env->startSection('content'); ?>
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside><?php echo $__env->make('user.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></aside>

            <div class="lg:col-span-3 flex flex-col gap-6">

                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-figure text-primary">
                            <span class="material-icons text-4xl">comment</span>
                        </div>
                        <div class="stat-title">Comments</div>
                        <div class="stat-value text-primary"><?php echo e($commentcount); ?></div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-0">
                        <div class="px-4 py-3 border-b border-base-200">
                            <h2 class="font-bold text-lg">Recent Comments</h2>
                        </div>
                        <ul class="divide-y divide-base-200">
                            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="px-4 py-3 text-sm text-base-content/80">
                                <span class="font-medium text-base-content"><?php echo e(++$key); ?>.</span> <?php echo e($comment->body); ?>

                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="px-4 py-3 flex justify-center">
                            <?php echo e($comments->links()); ?>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\RealEstate\resources\views/user/dashboard.blade.php ENDPATH**/ ?>