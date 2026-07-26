<?php $__env->startSection('title', 'Sliders'); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Slider List</h2>
        <a href="<?php echo e(route('admin.sliders.create')); ?>" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Slider
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td>
                            <?php if(Storage::disk('public')->exists('slider/'.$slider->image)): ?>
                                <img src="<?php echo e(Storage::url('slider/'.$slider->image)); ?>" alt="<?php echo e($slider->title); ?>" class="w-24 h-14 object-cover rounded-box">
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($slider->title); ?></td>
                        <td class="max-w-48 truncate text-sm"><?php echo e($slider->description); ?></td>
                        <td>
                            <div class="flex gap-1">
                                <a href="<?php echo e(route('admin.sliders.edit', $slider->id)); ?>" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteSlider(<?php echo e($slider->id); ?>)"><span class="material-icons text-sm">delete</span></button>
                                <form action="<?php echo e(route('admin.sliders.destroy', $slider->id)); ?>" method="POST" id="del-slider-<?php echo e($slider->id); ?>" class="hidden">
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
function deleteSlider(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-slider-' + id).submit(); } });
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/admin/sliders/index.blade.php ENDPATH**/ ?>