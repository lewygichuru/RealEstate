<?php $__env->startComponent('mail::message'); ?>
# Hello, <?php echo e($name); ?>

<?php echo e($message); ?>


<?php $__env->startComponent('mail::button', ['url' => '']); ?>
Button Text
<?php echo $__env->renderComponent(); ?>

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\projo\RealEstate-1\resources\views\emails\contact.blade.php ENDPATH**/ ?>