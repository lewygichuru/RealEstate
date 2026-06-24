<?php $__env->startSection('title', 'Read Message'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-base-100 shadow-sm max-w-2xl">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Message</h2>
            <a href="<?php echo e(route('admin.message')); ?>" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>

        <div class="bg-base-200 rounded-box p-4 space-y-1 text-sm">
            <p><strong>From:</strong> <?php echo e($message->name); ?> &lt;<?php echo e($message->email); ?>&gt;</p>
            <?php if($message->phone): ?><p><strong>Phone:</strong> <?php echo e($message->phone); ?></p><?php endif; ?>
        </div>

        <div class="bg-base-100 border border-base-300 rounded-box p-4">
            <p class="text-sm font-semibold mb-2">Message:</p>
            <p class="text-base-content/80"><?php echo $message->message; ?></p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">
            <a href="<?php echo e(route('admin.message.replay', $message->id)); ?>" class="btn btn-primary btn-sm gap-1">
                <span class="material-icons text-sm">reply</span> Reply
            </a>
            <form action="<?php echo e(route('admin.message.readunread')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="status" value="<?php echo e($message->status); ?>">
                <input type="hidden" name="messageid" value="<?php echo e($message->id); ?>">
                <button type="submit" class="btn btn-warning btn-sm gap-1">
                    <span class="material-icons text-sm">local_library</span>
                    <?php echo e($message->status ? 'Mark Unread' : 'Mark Read'); ?>

                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\settings\messages\readmessage.blade.php ENDPATH**/ ?>