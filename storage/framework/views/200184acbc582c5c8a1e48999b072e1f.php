<?php $__env->startSection('title', 'Properties'); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-lg">Property List</h2>
        <a href="<?php echo e(route('admin.properties.create')); ?>" class="btn btn-primary btn-sm gap-1">
            <span class="material-icons text-sm">add</span> Create Property
        </a>
    </div>
    <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Owner</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Beds</th>
                        <th>Baths</th>
                        <th><span class="material-icons text-sm">comment</span></th>
                        <th><span class="material-icons text-sm">stars</span></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td>
                            <?php ($cover = $property->gallery->first()); ?>
                            <?php if($cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path)): ?>
                                <img src="<?php echo e(Storage::url($cover->file_path)); ?>" alt="<?php echo e($property->title); ?>" class="w-14 h-10 object-cover rounded">
                            <?php elseif($property->image && (Storage::disk('public')->exists('property/'.$property->image) || Storage::disk('public')->exists('property/gallery/'.$property->image))): ?>
                                <?php ($legacyImg = Storage::disk('public')->exists('property/'.$property->image) ? 'property/'.$property->image : 'property/gallery/'.$property->image); ?>
                                <img src="<?php echo e(Storage::url($legacyImg)); ?>" alt="<?php echo e($property->title); ?>" class="w-14 h-10 object-cover rounded">
                            <?php endif; ?>
                        </td>
                        <td class="max-w-32 truncate" title="<?php echo e($property->title); ?>"><?php echo e(\Illuminate\Support\Str::limit($property->title, 18)); ?></td>
                        <td class="text-sm"><?php echo e($property->user->name); ?></td>
                        <td><span class="badge badge-outline badge-sm"><?php echo e($property->type); ?></span></td>
                        <td><span class="badge badge-outline badge-sm"><?php echo e(ucfirst($property->status)); ?></span></td>
                        <td class="text-sm">Ksh <?php echo e(number_format($property->price ?? 0)); ?></td>
                        <td><?php echo e($property->bedroom); ?></td>
                        <td><?php echo e($property->bathroom); ?></td>
                        <td><span class="badge badge-primary badge-sm"><?php echo e($property->comments_count); ?></span></td>
                        <td>
                            <?php if($property->is_featured): ?>
                                <span class="badge badge-warning badge-sm"><span class="material-icons text-xs">star</span></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="flex gap-1">
                                <a href="<?php echo e(route('admin.properties.show', $property->id)); ?>" class="btn btn-success btn-xs"><span class="material-icons text-sm">visibility</span></a>
                                <a href="<?php echo e(route('admin.properties.edit', $property->id)); ?>" class="btn btn-info btn-xs"><span class="material-icons text-sm">edit</span></a>
                                <button type="button" class="btn btn-error btn-xs" onclick="deleteProperty(<?php echo e($property->id); ?>)"><span class="material-icons text-sm">delete</span></button>
                                <form action="<?php echo e(route('admin.properties.destroy', $property->id)); ?>" method="POST" id="del-property-<?php echo e($property->id); ?>" class="hidden">
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
function deleteProperty(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => { if (value) { document.getElementById('del-property-' + id).submit(); } });
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/admin/properties/index.blade.php ENDPATH**/ ?>