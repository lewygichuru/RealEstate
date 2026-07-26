<?php $__env->startSection('title', 'Tags'); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Tag List</h2>
        <a href="<?php echo e(route('admin.tags.create')); ?>" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Tag
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Posts</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td><?php echo e($tag->name); ?></td>
                        <td><?php echo e($tag->posts->count()); ?></td>
                        <td class="text-sm text-base-content/60"><?php echo e($tag->slug); ?></td>
                        <td>
                            <div class="flex gap-1">
                                <a href="<?php echo e(route('admin.tags.edit', $tag->id)); ?>" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteTag(<?php echo e($tag->id); ?>)"><span class="material-icons text-sm">delete</span></button>
                                <form action="<?php echo e(route('admin.tags.destroy', $tag->id)); ?>" method="POST" id="del-tag-<?php echo e($tag->id); ?>" class="hidden">
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
function deleteTag(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-tag-' + id).submit(); } });
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/admin/tags/index.blade.php ENDPATH**/ ?>