<?php $__env->startSection('content'); ?>
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside><?php echo $__env->make('agent.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></aside>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-0">
                        <div class="px-4 py-3 border-b border-base-200">
                            <h2 class="font-bold text-lg">Messages</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="table table-zebra">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="<?php echo e($message->status == 0 ? 'font-semibold' : ''); ?>">
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><?php echo e(ucfirst(strtok($message->name, ' '))); ?></td>
                                        <td class="text-sm"><?php echo e($message->email); ?></td>
                                        <td class="max-w-48 truncate text-sm" title="<?php echo e($message->message); ?>">
                                            <?php echo e(\Illuminate\Support\Str::limit($message->message, 30)); ?>

                                        </td>
                                        <td>
                                            <div class="flex gap-1">
                                                <?php if($message->status == 0): ?>
                                                    <a href="<?php echo e(route('agent.message.read', $message->id)); ?>" class="btn btn-warning btn-xs" title="Unread"><span class="material-icons text-sm">local_library</span></a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('agent.message.read', $message->id)); ?>" class="btn btn-success btn-xs" title="Read"><span class="material-icons text-sm">done</span></a>
                                                <?php endif; ?>
                                                <a href="<?php echo e(route('agent.message.replay', $message->id)); ?>" class="btn btn-primary btn-xs" title="Reply"><span class="material-icons text-sm">reply</span></a>
                                                <button type="button" class="btn btn-error btn-xs" onclick="deleteMessage(<?php echo e($message->id); ?>)" title="Delete"><span class="material-icons text-sm">delete</span></button>
                                                <form action="<?php echo e(route('agent.messages.destroy', $message->id)); ?>" method="POST" id="del-message-<?php echo e($message->id); ?>" class="hidden">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 py-3 flex justify-center">
                            <?php echo e($messages->links()); ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function deleteMessage(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => {
        if (value) { document.getElementById('del-message-' + id).submit(); }
    });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\agent\messages\index.blade.php ENDPATH**/ ?>