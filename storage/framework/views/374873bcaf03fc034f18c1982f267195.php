<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" data-theme="corporate">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script>(function(){var t=localStorage.getItem('daisy-theme');if(t)document.documentElement.setAttribute('data-theme',t);}());</script>
    <title>Admin · <?php echo $__env->yieldContent('title', 'Dashboard'); ?></title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-base-200 min-h-screen">

<div class="drawer lg:drawer-open">
    <input id="admin-drawer" type="checkbox" class="drawer-toggle">

    
    <div class="drawer-content flex flex-col min-h-screen">

        
        <?php echo $__env->make('backend.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        
        <main class="flex-1 p-4 lg:p-6">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

    </div>

    
    <div class="drawer-side z-20">
        <label for="admin-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <?php echo $__env->make('backend.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>

<script src="<?php echo e(asset('backend/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<?php echo Toastr::message(); ?>


<script>
    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            toastr.error('<?php echo e($error); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>
<?php echo $__env->make('partials.theme-customizer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\projo\RealEstate-1\resources\views/backend/layouts/app.blade.php ENDPATH**/ ?>