<?php $__env->startSection('content'); ?>
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside><?php echo $__env->make('agent.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></aside>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body gap-4">
                        <h2 class="card-title">Profile</h2>

                        <form action="<?php echo e(route('agent.profile.update')); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                            <?php echo csrf_field(); ?>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Name</legend>
                                    <input type="text" name="name" value="<?php echo e($profile->name); ?>" class="input w-full" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Username</legend>
                                    <input type="text" name="username" value="<?php echo e($profile->username ?? ''); ?>" class="input w-full">
                                </fieldset>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Email</legend>
                                    <input type="email" name="email" value="<?php echo e($profile->email); ?>" class="input w-full" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend">Profile Image</legend>
                                    <input type="file" name="image" accept=".png,.jpg,.jpeg" class="file-input w-full">
                                </fieldset>
                            </div>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">About</legend>
                                <textarea name="about" rows="4" class="textarea w-full"><?php echo e($profile->about ?? ''); ?></textarea>
                            </fieldset>

                            <div>
                                <button type="submit" class="btn btn-primary gap-2">
                                    <span class="material-icons text-sm">save</span> Save Changes
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

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/agent/profile.blade.php ENDPATH**/ ?>