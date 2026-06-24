<?php $__env->startSection('content'); ?>
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            
            <div class="lg:col-span-2 space-y-6">
                <div class="card bg-base-100 shadow-sm">
                    <?php if(Storage::disk('public')->exists('posts/'.$post->image)): ?>
                    <figure>
                        <img src="<?php echo e(Storage::url('posts/'.$post->image)); ?>" alt="<?php echo e($post->title); ?>"
                             class="w-full max-h-80 object-cover">
                    </figure>
                    <?php endif; ?>
                    <div class="card-body">
                        <h1 class="text-2xl font-bold"><?php echo e($post->title); ?></h1>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-base-content/50 mt-1">
                            <a href="<?php echo e(route('blog.author', $post->user->username)); ?>" class="flex items-center gap-1 hover:text-primary">
                                <span class="material-icons text-sm">person</span> <?php echo e($post->user->name); ?>

                            </a>
                            <span class="flex items-center gap-1">
                                <span class="material-icons text-sm">schedule</span> <?php echo e($post->created_at->diffForHumans()); ?>

                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-icons text-sm">visibility</span> <?php echo e($post->view_count); ?> views
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-1 mt-2">
                            <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('blog.categories', $category->slug)); ?>" class="badge badge-primary badge-sm"><?php echo e($category->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('blog.tags', $tag->slug)); ?>" class="badge badge-outline badge-sm"><?php echo e($tag->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="divider my-2"></div>
                        <div class="prose max-w-none"><?php echo $post->body; ?></div>
                    </div>
                </div>

                
                <div class="card bg-base-100 shadow-sm" id="comments">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo e($post->comments_count); ?> Comments</h2>

                        <div class="space-y-4 mt-4">
                            <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($comment->parent_id == null): ?>
                                <div class="flex gap-3">
                                    <div class="avatar shrink-0">
                                        <div class="w-9 h-9 rounded-full">
                                            <img src="<?php echo e(Storage::url('users/'.$comment->users->image)); ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-sm"><?php echo e($comment->users->name); ?></span>
                                            <span class="text-xs text-base-content/50"><?php echo e($comment->created_at->diffForHumans()); ?></span>
                                            <?php if(auth()->guard()->check()): ?>
                                            <button class="ml-auto text-xs text-primary hover:underline blog-reply-btn"
                                                    data-id="<?php echo e($comment->id); ?>">Reply</button>
                                            <?php endif; ?>
                                        </div>
                                        <p class="text-sm mt-1"><?php echo e($comment->body); ?></p>
                                        <div id="comment-<?php echo e($comment->id); ?>"></div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if($comment->children->count() > 0): ?>
                                    <?php $__currentLoopData = $comment->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex gap-3 ml-10">
                                        <div class="avatar shrink-0">
                                            <div class="w-8 h-8 rounded-full">
                                                <img src="<?php echo e(Storage::url('users/'.$child->users->image)); ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2">
                                                <span class="font-semibold text-sm"><?php echo e($child->users->name); ?></span>
                                                <span class="text-xs text-base-content/50"><?php echo e($child->created_at->diffForHumans()); ?></span>
                                            </div>
                                            <p class="text-sm mt-1"><?php echo e($child->body); ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <?php if(auth()->guard()->check()): ?>
                        <form action="<?php echo e(route('blog.comment', $post->id)); ?>" method="POST" class="mt-6 flex flex-col gap-2">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="parent" value="0">
                            <textarea name="body" rows="3" placeholder="Leave a comment..."
                                      class="textarea w-full"></textarea>
                            <button type="submit" class="btn btn-primary btn-sm w-fit">Post Comment</button>
                        </form>
                        <?php endif; ?>
                        <?php if(auth()->guard()->guest()): ?>
                        <div class="alert mt-4">
                            <span>Please <a href="<?php echo e(route('login')); ?>" class="link link-primary">login</a> to comment.</span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <aside>
                <?php echo $__env->make('pages.blog.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </aside>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).on('click', '.blog-reply-btn', function() {
    var id = $(this).data('id');
    var action = "<?php echo e(route('blog.comment', $post->id)); ?>";
    $('#comment-' + id).html(
        '<form action="' + action + '" method="POST" class="mt-3 flex flex-col gap-2">' +
        '<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">' +
        '<input type="hidden" name="parent" value="1">' +
        '<input type="hidden" name="parent_id" value="' + id + '">' +
        '<textarea name="body" rows="2" placeholder="Your reply..." class="textarea textarea-sm w-full"></textarea>' +
        '<button type="submit" class="btn btn-primary btn-xs w-fit">Reply</button>' +
        '</form>'
    );
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\pages\blog\single.blade.php ENDPATH**/ ?>