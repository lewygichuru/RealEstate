<?php $__env->startSection('content'); ?>
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body gap-4">
                    <h1 class="card-title text-2xl justify-center"><?php echo e(__('Reset Password')); ?></h1>

                    <form method="POST" action="<?php echo e(route('password.update')); ?>" class="flex flex-col gap-4">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="token" value="<?php echo e($token); ?>">

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend"><?php echo e(__('E-Mail Address')); ?></legend>
                            <input id="email" type="email" name="email" value="<?php echo e($email ?? old('email')); ?>"
                                   class="input w-full <?php echo e($errors->has('email') ? 'input-error' : ''); ?>"
                                   required autofocus>
                            <?php if($errors->has('email')): ?>
                                <p class="fieldset-label text-error"><?php echo e($errors->first('email')); ?></p>
                            <?php endif; ?>
                        </fieldset>

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend"><?php echo e(__('New Password')); ?></legend>
                            <input id="password" type="password" name="password"
                                   class="input w-full <?php echo e($errors->has('password') ? 'input-error' : ''); ?>"
                                   required>
                            <?php if($errors->has('password')): ?>
                                <p class="fieldset-label text-error"><?php echo e($errors->first('password')); ?></p>
                            <?php endif; ?>
                        </fieldset>

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend"><?php echo e(__('Confirm Password')); ?></legend>
                            <input id="password-confirm" type="password" name="password_confirmation"
                                   class="input w-full" required>
                        </fieldset>

                        <button type="submit" class="btn btn-primary w-full mt-1">
                            <?php echo e(__('Reset Password')); ?>

                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\auth\passwords\reset.blade.php ENDPATH**/ ?>