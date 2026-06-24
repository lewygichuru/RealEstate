<?php $__env->startSection('content'); ?>
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body gap-4">
                    <h1 class="card-title text-2xl justify-center"><?php echo e(__('Forgot Password')); ?></h1>
                    <p class="text-sm text-base-content/60 text-center">
                        Enter your email address and we'll send you a password reset link.
                    </p>

                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <span class="material-icons">check_circle</span>
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('password.email')); ?>" class="flex flex-col gap-4">
                        <?php echo csrf_field(); ?>

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend"><?php echo e(__('E-Mail Address')); ?></legend>
                            <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>"
                                   class="input w-full <?php echo e($errors->has('email') ? 'input-error' : ''); ?>"
                                   required autofocus>
                            <?php if($errors->has('email')): ?>
                                <p class="fieldset-label text-error"><?php echo e($errors->first('email')); ?></p>
                            <?php endif; ?>
                        </fieldset>

                        <button type="submit" class="btn btn-primary w-full">
                            <?php echo e(__('Send Password Reset Link')); ?>

                        </button>

                        <div class="text-center">
                            <a href="<?php echo e(route('login')); ?>" class="link link-primary text-sm">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\auth\passwords\email.blade.php ENDPATH**/ ?>