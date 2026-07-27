<?php $__env->startSection('content'); ?>
<section class="py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Blog</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            
            <div class="lg:col-span-2 space-y-6">
                <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card card-side bg-base-100 shadow-sm hover:shadow-md transition-shadow">
                    <?php if(Storage::disk('public')->exists('posts/'.$post->image) && $post->image): ?>
                    <figure class="w-44 shrink-0">
                        <img src="<?php echo e(Storage::url('posts/'.$post->image)); ?>" alt="<?php echo e($post->title); ?>"
                             class="h-full w-full object-cover">
                    </figure>
                    <?php endif; ?>
                    <div class="card-body p-4">
                        <a href="<?php echo e(route('blog.show', $post->slug)); ?>">
                            <h2 class="card-title text-base hover:text-primary transition-colors line-clamp-2">
                                <?php echo e($post->title); ?>

                            </h2>
                        </a>
                        <p class="text-sm text-base-content/60 line-clamp-2">
                            <?php echo \Illuminate\Support\Str::limit(strip_tags($post->body), 120); ?>

                        </p>
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-2 text-xs text-base-content/50">
                            <a href="<?php echo e(route('blog.author', $post->user->id)); ?>" class="flex items-center gap-1 hover:text-primary">
                                <span class="material-icons text-sm">person</span> <?php echo e($post->user->name); ?>

                            </a>
                            <span class="flex items-center gap-1">
                                <span class="material-icons text-sm">schedule</span> <?php echo e($post->created_at->diffForHumans()); ?>

                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-icons text-sm">comment</span> <?php echo e($post->comments_count); ?>

                            </span>
                        </div>
                        <div class="flex flex-wrap gap-1 mt-2">
                            <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('blog.categories', $category->slug)); ?>" class="badge badge-outline badge-xs hover:badge-primary">
                                    <?php echo e($category->name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('blog.tags', $tag->slug)); ?>" class="badge badge-ghost badge-xs">
                                    <?php echo e($tag->name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="alert"><span class="material-icons">info</span> No posts found.</div>
                <?php endif; ?>

                <div class="mt-6 flex justify-center">
                    <?php echo e($posts->links()); ?>

                </div>
            </div>

            
            <aside>
                <?php echo $__env->make('pages.blog.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </aside>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/pages/blog/index.blade.php ENDPATH**/ ?>