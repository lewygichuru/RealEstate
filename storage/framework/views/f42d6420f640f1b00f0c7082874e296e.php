<?php $__env->startSection('title', 'View Post'); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 space-y-6">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold"><?php echo e($post->title); ?></h2>
                        <p class="text-sm text-base-content/60 mt-1">
                            Posted by <strong><?php echo e($post->user->name); ?></strong> on <?php echo e($post->created_at->toFormattedDateString()); ?>

                        </p>
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <a href="<?php echo e(route('admin.posts.edit', $post->slug)); ?>" class="btn btn-info btn-sm gap-1">
                            <span class="material-icons text-sm">edit</span> Edit
                        </a>
                        <a href="<?php echo e(route('admin.posts.index')); ?>" class="btn btn-outline btn-sm gap-1">
                            <span class="material-icons text-sm">arrow_back</span> Back
                        </a>
                    </div>
                </div>
                <div class="divider my-0"></div>
                <div class="prose max-w-none">
                    <?php echo $post->body; ?>

                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body p-0">
                <div class="px-4 py-3 border-b border-base-200">
                    <h3 class="font-bold"><?php echo e($post->comments_count); ?> Comments</h3>
                </div>
                <div class="divide-y divide-base-200">
                    <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($comment->parent_id == null): ?>
                        <div class="flex gap-3 p-4">
                            <div class="avatar shrink-0">
                                <div class="w-9 h-9 rounded-full bg-base-200 overflow-hidden">
                                    <img src="<?php echo e(Storage::url('users/'.$comment->users->image)); ?>" alt="<?php echo e($comment->users->name); ?>">
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-sm"><?php echo e($comment->users->name); ?></span>
                                    <span class="text-xs text-base-content/50"><?php echo e($comment->created_at->diffForHumans()); ?></span>
                                </div>
                                <p class="text-sm text-base-content/80 mt-1"><?php echo e($comment->body); ?></p>
                                <?php $__currentLoopData = $comment->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex gap-3 mt-3 pl-4 border-l-2 border-base-200">
                                    <div class="avatar shrink-0">
                                        <div class="w-7 h-7 rounded-full bg-base-200 overflow-hidden">
                                            <img src="<?php echo e(Storage::url('users/'.$reply->users->image)); ?>" alt="<?php echo e($reply->users->name); ?>">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold text-sm"><?php echo e($reply->users->name); ?></span>
                                            <span class="text-xs text-base-content/50"><?php echo e($reply->created_at->diffForHumans()); ?></span>
                                        </div>
                                        <p class="text-sm text-base-content/80 mt-1"><?php echo e($reply->body); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold text-sm">Categories</h3>
                <div class="flex flex-wrap gap-2">
                    <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge badge-primary"><?php echo e($category->name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold text-sm">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge badge-outline"><?php echo e($tag->name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php if(Storage::disk('public')->exists('posts/'.$post->image)): ?>
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body gap-3">
                <h3 class="font-bold text-sm">Featured Image</h3>
                <img src="<?php echo e(Storage::url('posts/'.$post->image)); ?>" alt="<?php echo e($post->title); ?>" class="w-full rounded-box object-cover">
            </div>
        </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\posts\show.blade.php ENDPATH**/ ?>