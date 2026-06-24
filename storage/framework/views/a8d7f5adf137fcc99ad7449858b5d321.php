<?php $__env->startSection('title', 'Messages'); ?>

<?php $__env->startSection('content'); ?>
<div>
    <h2 class="font-bold text-lg mb-4">Messages</h2>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="<?php echo e($message->status == 0 ? 'font-semibold' : ''); ?>">
                        <td><?php echo e($key + 1); ?></td>
                        <td><?php echo e($message->name); ?></td>
                        <td class="text-sm"><?php echo e($message->email); ?></td>
                        <td class="text-sm"><?php echo e($message->phone); ?></td>
                        <td class="max-w-48 truncate text-sm"><?php echo e(\Illuminate\Support\Str::limit($message->message, 40)); ?></td>
                        <td>
                            <div class="flex gap-1">
                                <?php if($message->status == 0): ?>
                                    <a href="<?php echo e(route('admin.message.read', $message->id)); ?>" class="btn btn-warning btn-xs" title="Unread"><span class="material-icons text-sm">local_library</span></a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('admin.message.read', $message->id)); ?>" class="btn btn-success btn-xs" title="Read"><span class="material-icons text-sm">done</span></a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('admin.message.replay', $message->id)); ?>" class="btn btn-primary btn-xs" title="Reply"><span class="material-icons text-sm">reply</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteMessage(<?php echo e($message->id); ?>)" title="Delete"><span class="material-icons text-sm">delete</span></button>
                                <form action="<?php echo e(route('admin.messages.destroy', $message->id)); ?>" method="POST" id="del-message-<?php echo e($message->id); ?>" class="hidden">
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
function deleteMessage(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-message-' + id).submit(); } });
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/admin/settings/messages/index.blade.php ENDPATH**/ ?>