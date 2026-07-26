<?php $__env->startSection('content'); ?>
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body gap-4">
                    <h1 class="card-title text-2xl justify-center"><?php echo e(__('Login')); ?></h1>

                    <form method="POST" action="<?php echo e(route('login')); ?>" class="flex flex-col gap-4">
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

                        <fieldset class="fieldset">
                            <legend class="fieldset-legend"><?php echo e(__('Password')); ?></legend>
                            <input id="password" type="password" name="password"
                                   class="input w-full <?php echo e($errors->has('password') ? 'input-error' : ''); ?>"
                                   required>
                            <?php if($errors->has('password')): ?>
                                <p class="fieldset-label text-error"><?php echo e($errors->first('password')); ?></p>
                            <?php endif; ?>
                        </fieldset>

                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm"
                                   <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <span class="text-sm"><?php echo e(__('Remember Me')); ?></span>
                        </label>

                        <div class="flex items-center gap-4 mt-1">
                            <button type="submit" class="btn btn-primary flex-1"><?php echo e(__('Login')); ?></button>
                            <a href="<?php echo e(route('password.request')); ?>" class="link link-primary text-sm whitespace-nowrap">
                                <?php echo e(__('Forgot Password?')); ?>

                            </a>
                        </div>

                        <div class="divider text-xs my-0">Don't have an account?</div>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-outline btn-sm w-full">
                            <?php echo e(__('Create Account')); ?>

                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/auth/login.blade.php ENDPATH**/ ?>