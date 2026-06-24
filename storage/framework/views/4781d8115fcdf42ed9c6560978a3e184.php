<?php $__env->startSection('title', 'Reply Message'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-base-100 shadow-sm max-w-2xl">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Reply to Message</h2>
            <a href="<?php echo e(route('admin.message')); ?>" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">arrow_back</span> Back
            </a>
        </div>

        <?php if($message->user_id): ?>
        <form action="<?php echo e(route('admin.message.send')); ?>" method="POST" class="flex flex-col gap-4">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="agent_id" value="<?php echo e($message->user_id); ?>">
            <input type="hidden" name="user_id" value="<?php echo e(auth()->id()); ?>">
            <input type="hidden" name="name" value="<?php echo e(auth()->user()->name); ?>">
            <input type="hidden" name="email" value="<?php echo e(auth()->user()->email); ?>">

            <div class="bg-base-200 rounded-box p-3 text-sm">
                <strong>Reply To:</strong> <?php echo e($message->email); ?>

            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Phone</legend>
                <input type="number" name="phone" class="input w-full">
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Message</legend>
                <textarea name="message" rows="5" class="textarea w-full"></textarea>
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">reply</span> Send Reply
                </button>
            </div>
        </form>
        <?php else: ?>
        <form action="<?php echo e(route('admin.message.mail')); ?>" method="POST" class="flex flex-col gap-4">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="name" value="<?php echo e($message->name); ?>">
            <input type="hidden" name="mailfrom" value="<?php echo e(auth()->user()->email); ?>">

            <fieldset class="fieldset">
                <legend class="fieldset-legend">To</legend>
                <input type="email" name="email" value="<?php echo e($message->email); ?>" class="input w-full bg-base-200" readonly>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Subject</legend>
                <input type="text" name="subject" class="input w-full">
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Message</legend>
                <textarea name="message" rows="5" class="textarea w-full"></textarea>
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">send</span> Send Email
                </button>
            </div>
        </form>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\settings\messages\replaymessage.blade.php ENDPATH**/ ?>