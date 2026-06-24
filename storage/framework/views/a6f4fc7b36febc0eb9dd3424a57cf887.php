<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>


<div class="stats stats-vertical sm:stats-horizontal shadow w-full mb-6">
    <div class="stat">
        <div class="stat-figure text-primary">
            <span class="material-icons text-4xl">home</span>
        </div>
        <div class="stat-title">Total Properties</div>
        <div class="stat-value text-primary"><?php echo e($propertycount); ?></div>
        <div class="stat-desc">Listed on the site</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-secondary">
            <span class="material-icons text-4xl">article</span>
        </div>
        <div class="stat-title">Total Posts</div>
        <div class="stat-value text-secondary"><?php echo e($postcount); ?></div>
        <div class="stat-desc">Published articles</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-accent">
            <span class="material-icons text-4xl">comment</span>
        </div>
        <div class="stat-title">Total Comments</div>
        <div class="stat-value text-accent"><?php echo e($commentcount); ?></div>
        <div class="stat-desc">Across all content</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-warning">
            <span class="material-icons text-4xl">people</span>
        </div>
        <div class="stat-title">Total Users</div>
        <div class="stat-value text-warning"><?php echo e($usercount); ?></div>
        <div class="stat-desc">Registered accounts</div>
    </div>
</div>

<div class="stats stats-vertical sm:stats-horizontal shadow w-full mb-6">
    <div class="stat">
        <div class="stat-figure text-info">
            <span class="material-icons text-4xl">admin_panel_settings</span>
        </div>
        <div class="stat-title">Roles</div>
        <div class="stat-value text-info"><?php echo e($rolecount); ?></div>
        <div class="stat-desc">Access groups in the backend</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-secondary">
            <span class="material-icons text-4xl">verified_user</span>
        </div>
        <div class="stat-title">Permissions</div>
        <div class="stat-value text-secondary"><?php echo e($permissioncount); ?></div>
        <div class="stat-desc">Granted abilities</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-success">
            <span class="material-icons text-4xl">how_to_reg</span>
        </div>
        <div class="stat-title">Registrations Today</div>
        <div class="stat-value text-success"><?php echo e($todayregistrations); ?></div>
        <div class="stat-desc">New users in the last 24h</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-accent">
            <span class="material-icons text-4xl">calendar_month</span>
        </div>
        <div class="stat-title">Registrations This Week</div>
        <div class="stat-value text-accent"><?php echo e($weekregistrations); ?></div>
        <div class="stat-desc">New users since Monday</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    
    <div>
        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-sm uppercase tracking-wide">Recent Properties</h2>
            <a href="<?php echo e(route('admin.properties.index')); ?>" class="btn btn-ghost btn-xs">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Price</th>
                        <th>Badge</th>
                        <th>Agent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-10 h-10 rounded-box">
                                        <?php ($cover = $property->gallery->first()); ?>
                                        <?php ($legacy = $property->image ? (Storage::disk('public')->exists('property/'.$property->image) ? 'property/'.$property->image : (Storage::disk('public')->exists('property/gallery/'.$property->image) ? 'property/gallery/'.$property->image : null)) : null); ?>
                                        <?php if($cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path)): ?>
                                            <img src="<?php echo e(Storage::url($cover->file_path)); ?>" alt="<?php echo e($property->title); ?>">
                                        <?php elseif($legacy): ?>
                                            <img src="<?php echo e(Storage::url($legacy)); ?>" alt="<?php echo e($property->title); ?>">
                                        <?php else: ?>
                                            <div class="bg-base-300 w-full h-full flex items-center justify-center rounded-box">
                                                <span class="material-icons text-base-content/40 text-lg">home</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm leading-tight"><?php echo e(\Illuminate\Support\Str::limit($property->title, 22)); ?></div>
                                    <div class="text-xs text-base-content/50"><?php echo e(ucfirst($property->city)); ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="font-semibold text-success text-sm">Ksh <?php echo e(number_format($property->price)); ?></td>
                        <td>
                            <?php if($property->is_featured): ?>
                                <span class="badge badge-warning badge-sm gap-1">
                                    <span class="material-icons text-xs">star</span> Featured
                                </span>
                            <?php else: ?>
                                <span class="badge badge-ghost badge-sm">Standard</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar placeholder">
                                    <div class="bg-neutral text-neutral-content rounded-full w-7">
                                        <span class="text-xs"><?php echo e(strtoupper(substr($property->user->name, 0, 1))); ?></span>
                                    </div>
                                </div>
                                <span class="text-sm"><?php echo e(strtok($property->user->name, ' ')); ?></span>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div>
        <div class="flex items-center justify-between mb-3">
            <h2 class="font-bold text-sm uppercase tracking-wide">Recent Posts</h2>
            <a href="<?php echo e(route('admin.posts.index')); ?>" class="btn btn-ghost btn-xs">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Post</th>
                        <th>Comments</th>
                        <th>Status</th>
                        <th>Author</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-10 h-10 rounded-box">
                                        <?php if($post->image && Storage::disk('public')->exists('posts/'.$post->image)): ?>
                                            <img src="<?php echo e(Storage::url('posts/'.$post->image)); ?>" alt="<?php echo e($post->title); ?>">
                                        <?php else: ?>
                                            <div class="bg-base-300 w-full h-full flex items-center justify-center rounded-box">
                                                <span class="material-icons text-base-content/40 text-lg">article</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="font-semibold text-sm leading-tight"><?php echo e(\Illuminate\Support\Str::limit($post->title, 28)); ?></div>
                            </div>
                        </td>
                        <td>
                            <div class="badge badge-primary badge-sm"><?php echo e($post->comments_count); ?></div>
                        </td>
                        <td>
                            <?php if($post->status): ?>
                                <span class="badge badge-success badge-sm">Published</span>
                            <?php else: ?>
                                <span class="badge badge-warning badge-sm">Draft</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-sm"><?php echo e(strtok($post->user->name, ' ')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    
    <div>
        <h2 class="font-bold text-sm uppercase tracking-wide mb-3">Recent Registrations</h2>
        <div class="overflow-x-auto">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-9 h-9 rounded-full">
                                        <?php if($user->image && Storage::disk('public')->exists('users/'.$user->image)): ?>
                                            <img src="<?php echo e(Storage::url('users/'.$user->image)); ?>" alt="<?php echo e($user->name); ?>">
                                        <?php else: ?>
                                            <div class="bg-base-300 w-9 h-9 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-semibold"><?php echo e(strtoupper(substr($user->name, 0, 1))); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm"><?php echo e($user->name); ?></div>
                                    <div class="text-xs text-base-content/50"><?php echo e($user->email); ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php ($role = $user->roles->first()); ?>
                            <?php if($role?->id === 1): ?>
                                <span class="badge badge-sm badge-error"><?php echo e($role->name); ?></span>
                            <?php elseif($role?->id === 2): ?>
                                <span class="badge badge-sm badge-primary"><?php echo e($role->name); ?></span>
                            <?php else: ?>
                                <span class="badge badge-sm badge-ghost"><?php echo e($role->name ?? 'No role'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-xs text-base-content/50"><?php echo e($user->created_at->diffForHumans()); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div>
        <h2 class="font-bold text-sm uppercase tracking-wide mb-3">Recent Comments</h2>
        <div class="overflow-x-auto">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Author</th>
                        <th>When</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="max-w-44">
                            <p class="text-sm truncate" title="<?php echo e($comment->body); ?>"><?php echo e(\Illuminate\Support\Str::limit($comment->body, 35)); ?></p>
                        </td>
                        <td>
                            <?php if($comment->approved == 1): ?>
                                <span class="badge badge-success badge-sm">Approved</span>
                            <?php else: ?>
                                <span class="badge badge-warning badge-sm">Pending</span>
                            </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar placeholder">
                                    <div class="bg-accent text-accent-content rounded-full w-7">
                                        <span class="text-xs"><?php echo e(strtoupper(substr($comment->user?->name ?? 'U', 0, 1))); ?></span>
                                    </div>
                                </div>
                                <span class="text-sm"><?php echo e($comment->user ? strtok($comment->user->name, ' ') : 'Unknown'); ?></span>
                            </div>
                        </td>
                        <td class="text-xs text-base-content/50"><?php echo e($comment->created_at->diffForHumans()); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>