<?php $__env->startSection('content'); ?>
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside><?php echo $__env->make('agent.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></aside>

            <div class="lg:col-span-3 space-y-6">
                <h1 class="text-2xl font-bold">Dashboard</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="stat bg-base-100 rounded-box shadow-sm">
                        <div class="stat-figure text-primary"><span class="material-icons text-4xl">home</span></div>
                        <div class="stat-title">Properties</div>
                        <div class="stat-value text-primary"><?php echo e($propertytotal); ?></div>
                    </div>
                    <div class="stat bg-base-100 rounded-box shadow-sm">
                        <div class="stat-figure text-secondary"><span class="material-icons text-4xl">mail</span></div>
                        <div class="stat-title">Messages</div>
                        <div class="stat-value text-secondary"><?php echo e($messagetotal); ?></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="card bg-base-100 shadow-sm">
                        <div class="card-body p-0">
                            <div class="px-4 py-3 border-b border-base-200">
                                <h2 class="font-bold text-sm uppercase tracking-wide">Recent Properties</h2>
                            </div>
                            <ul class="divide-y divide-base-200">
                                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('property.show', $property->slug)); ?>" target="_blank"
                                       class="flex items-center justify-between px-4 py-2 hover:bg-base-200 transition-colors text-sm">
                                        <span class="truncate"><?php echo e(++$key); ?>. <?php echo e(\Illuminate\Support\Str::limit($property->title, 28)); ?></span>
                                        <span class="text-primary font-semibold ml-2">Ksh <?php echo e(number_format($property->price)); ?></span>
                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>

                    <div class="card bg-base-100 shadow-sm">
                        <div class="card-body p-0">
                            <div class="px-4 py-3 border-b border-base-200">
                                <h2 class="font-bold text-sm uppercase tracking-wide">Recent Messages</h2>
                            </div>
                            <ul class="divide-y divide-base-200">
                                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <span class="flex px-4 py-2 text-sm">
                                        <strong class="mr-1"><?php echo e(strtok($message->name, ' ')); ?>:</strong>
                                        <span class="truncate text-base-content/70"><?php echo e(\Illuminate\Support\Str::limit($message->message, 25)); ?></span>
                                    </span>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\agent\dashboard.blade.php ENDPATH**/ ?>