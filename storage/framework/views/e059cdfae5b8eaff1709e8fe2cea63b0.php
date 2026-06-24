<?php $__env->startSection('title', 'Features'); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Feature List</h2>
        <a href="<?php echo e(route('admin.features.create')); ?>" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Feature
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td><?php echo e($feature->name); ?></td>
                        <td class="text-sm text-base-content/60"><?php echo e($feature->slug); ?></td>
                        <td>
                            <div class="flex gap-1">
                                <a href="<?php echo e(route('admin.features.edit', $feature->id)); ?>" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteFeature(<?php echo e($feature->id); ?>)"><span class="material-icons text-sm">delete</span></button>
                                <form action="<?php echo e(route('admin.features.destroy', $feature->id)); ?>" method="POST" id="del-feature-<?php echo e($feature->id); ?>" class="hidden">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function deleteFeature(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-feature-' + id).submit(); } });
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\features\index.blade.php ENDPATH**/ ?>