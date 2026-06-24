<?php $__env->startSection('title', 'Settings'); ?>

<?php $__env->startSection('content'); ?>
<div class="card bg-base-100 shadow-sm max-w-2xl">
    <div class="card-body gap-4">
        <div class="flex items-center justify-between">
            <h2 class="card-title">General Settings</h2>
            <a href="<?php echo e(route('admin.profile')); ?>" class="btn btn-outline btn-sm gap-1">
                <span class="material-icons text-sm">person</span> Profile
            </a>
        </div>
        <form action="<?php echo e(route('admin.settings.store')); ?>" method="POST" class="flex flex-col gap-4">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Site Title</legend>
                    <input type="text" name="name" value="<?php echo e(old('name', $settings['name'] ?? '')); ?>" class="input w-full">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Email</legend>
                    <input type="email" name="email" value="<?php echo e(old('email', $settings['email'] ?? '')); ?>" class="input w-full">
                </fieldset>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Phone</legend>
                    <input type="text" name="phone" value="<?php echo e(old('phone', $settings['phone'] ?? '')); ?>" class="input w-full">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Footer Text</legend>
                    <input type="text" name="footer" value="<?php echo e(old('footer', $settings['footer'] ?? '')); ?>" class="input w-full">
                </fieldset>
            </div>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Address</legend>
                <input type="text" name="address" value="<?php echo e(old('address', $settings['address'] ?? '')); ?>" class="input w-full">
                <p class="fieldset-label">HTML tags allowed</p>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">About Us</legend>
                <textarea name="aboutus" rows="4" class="textarea w-full"><?php echo e(old('aboutus', $settings['aboutus'] ?? '')); ?></textarea>
            </fieldset>

            <div class="divider text-sm">Social Links</div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Facebook</legend>
                    <input type="url" name="facebook" value="<?php echo e(old('facebook', $settings['facebook'] ?? '')); ?>" class="input w-full" placeholder="https://facebook.com/...">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Twitter</legend>
                    <input type="url" name="twitter" value="<?php echo e(old('twitter', $settings['twitter'] ?? '')); ?>" class="input w-full" placeholder="https://twitter.com/...">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">LinkedIn</legend>
                    <input type="url" name="linkedin" value="<?php echo e(old('linkedin', $settings['linkedin'] ?? '')); ?>" class="input w-full" placeholder="https://linkedin.com/in/...">
                </fieldset>
            </div>

            <div>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="material-icons text-sm">save</span> Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\settings\setting.blade.php ENDPATH**/ ?>