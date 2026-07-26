<?php $__env->startSection('title', 'Posts'); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Post List</h2>
        <a href="<?php echo e(route('admin.posts.create')); ?>" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Post
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Views</th>
                        <th>Approved</th>
                        <th>Status</th>
                        <th>Comments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td>
                            <?php if(Storage::disk('public')->exists('posts/'.$post->image)): ?>
                                <img src="<?php echo e(Storage::url('posts/'.$post->image)); ?>" alt="<?php echo e($post->title); ?>" class="w-14 h-10 object-cover rounded">
                            <?php endif; ?>
                        </td>
                        <td class="max-w-32 truncate" title="<?php echo e($post->title); ?>">
                            <?php echo e(\Illuminate\Support\Str::limit($post->title, 20)); ?>

                        </td>
                        <td class="text-sm"><?php echo e($post->user->name); ?></td>
                        <td class="text-sm">
                            <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($i != 0): ?><span>,</span><?php endif; ?>
                                <?php echo e($category->name); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td><?php echo e($post->view_count); ?></td>
                        <td>
                            <?php if($post->is_approved): ?>
                                <span class="badge badge-success badge-sm">Approved</span>
                            <?php else: ?>
                                <span class="badge badge-warning badge-sm">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($post->status): ?>
                                <span class="badge badge-success badge-sm">Published</span>
                            <?php else: ?>
                                <span class="badge badge-warning badge-sm">Draft</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($post->comments_count); ?></td>
                        <td>
                            <div class="flex gap-1">
                                <a href="<?php echo e(route('admin.posts.show', $post->slug)); ?>" class="btn btn-success btn-xs"><span class="material-icons text-sm">visibility</span></a>
                                <a href="<?php echo e(route('admin.posts.edit', $post->slug)); ?>" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deletePost(<?php echo e($post->id); ?>)"><span class="material-icons text-sm">delete</span></button>
                                <form action="<?php echo e(route('admin.posts.destroy', $post->slug)); ?>" method="POST" id="del-post-<?php echo e($post->id); ?>" class="hidden">
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
function deletePost(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-post-' + id).submit(); } });
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>