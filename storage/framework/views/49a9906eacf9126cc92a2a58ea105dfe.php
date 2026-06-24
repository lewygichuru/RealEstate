<?php $__env->startSection('content'); ?>
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside><?php echo $__env->make('agent.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></aside>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body gap-4">
                        <h2 class="card-title">Change Password</h2>

                        <form action="<?php echo e(route('agent.changepassword.update')); ?>" method="POST" class="flex flex-col gap-4 max-w-md">
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
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\agent\changepassword.blade.php ENDPATH**/ ?>