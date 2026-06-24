<?php $__env->startSection('title', 'Change Password'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-base-100 shadow-sm max-w-md">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">Change Password</h2>
            <a href="<?php echo e(route('admin.profile')); ?>" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">person</span> Profile
            </a>
        </div>
        <form action="<?php echo e(route('admin.changepassword')); ?>" method="POST" class="flex flex-col gap-4">
            <?php echo csrf_field(); ?>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Current Password</legend>
                <input type="password" name="currentpassword" class="input w-full" required>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">New Password</legend>
                <input type="password" name="newpassword" class="input w-full" required>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Confirm New Password</legend>
                <input type="password" name="newpassword_confirmation" class="input w-full" required>
            </fieldset>
            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">lock</span> Update Password
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/admin/settings/changepassword.blade.php ENDPATH**/ ?>