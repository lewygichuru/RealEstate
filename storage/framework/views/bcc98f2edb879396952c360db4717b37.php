<?php $__env->startSection('content'); ?>
<section class="py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Our Agents</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow text-center">
                <div class="card-body items-center gap-3">
                    <div class="avatar">
                        <div class="w-20 h-20 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img src="<?php echo e(Storage::url('users/'.$agent->image)); ?>" alt="<?php echo e($agent->name); ?>">
                        </div>
                    </div>
                    <a href="<?php echo e(route('agents.show', $agent->id)); ?>">
                        <h3 class="card-title text-base hover:text-primary transition-colors"><?php echo e($agent->name); ?></h3>
                    </a>
                    <p class="text-sm text-base-content/60"><?php echo e($agent->email); ?></p>
                    <p class="text-sm text-base-content/70 line-clamp-2">
                        <?php echo e(\Illuminate\Support\Str::limit($agent->about, 80)); ?>

                    </p>
                    <a href="<?php echo e(route('agents.show', $agent->id)); ?>" class="btn btn-primary btn-sm mt-1">View Profile</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-3">
                <div class="alert"><span class="material-icons">info</span> No agents found.</div>
            </div>
            <?php endif; ?>
        </div>

        <div class="mt-10 flex justify-center">
            <?php echo e($agents->links()); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\pages\agents\index.blade.php ENDPATH**/ ?>