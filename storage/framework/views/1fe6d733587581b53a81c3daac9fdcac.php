<?php $__env->startSection('content'); ?>
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <aside><?php echo $__env->make('agent.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></aside>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-0">
                        <div class="px-4 py-3 border-b border-base-200 flex items-center justify-between">
                            <h2 class="font-bold text-lg">Property List</h2>
                            <a href="<?php echo e(route('agent.properties.create')); ?>" class="btn btn-primary btn-sm gap-1">
                                <span class="material-icons text-sm">add</span> Add Property
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="table table-zebra">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>City</th>
                                        <th>Price</th>
                                        <th>Beds</th>
                                        <th>Baths</th>
                                        <th>Featured</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td class="max-w-40 truncate" title="<?php echo e($property->title); ?>">
                                            <?php echo e(\Illuminate\Support\Str::limit($property->title, 30)); ?>

                                        </td>
                                        <td><?php echo e(ucfirst($property->type)); ?></td>
                                        <td><?php echo e(ucfirst($property->status)); ?></td>
                                        <td><?php echo e(ucfirst($property->city)); ?></td>
                                        <td>Ksh <?php echo e(number_format($property->price ?? 0)); ?></td>
                                        <td><?php echo e($property->bedroom); ?></td>
                                        <td><?php echo e($property->bathroom); ?></td>
                                        <td>
                                            <?php if($property->is_featured): ?>
                                                <span class="badge badge-warning badge-sm">Featured</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="flex gap-1">
                                                <a href="<?php echo e(route('property.show', $property->slug)); ?>" target="_blank" class="btn btn-success btn-xs" title="View">
                                                    <span class="material-icons text-sm">visibility</span>
                                                </a>
                                                <a href="<?php echo e(route('agent.properties.edit', $property->id)); ?>" class="btn btn-warning btn-xs" title="Edit">
                                                    <span class="material-icons text-sm">edit</span>
                                                </a>
                                                <button type="button" class="btn btn-error btn-xs" onclick="deleteProperty('<?php echo e($property->id); ?>')" title="Delete">
                                                    <span class="material-icons text-sm">delete</span>
                                                </button>
                                                <form action="<?php echo e(route('agent.properties.destroy', $property->id)); ?>" method="POST" id="del-property-<?php echo e($property->id); ?>" class="hidden">
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
                            <?php echo e($properties->links()); ?>

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
function deleteProperty(id) {
    swal({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', buttons: ["Cancel", "Yes, delete it!"], dangerMode: true })
    .then((value) => {
        if (value) { document.getElementById('del-property-' + id).submit(); }
    });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/agent/properties/index.blade.php ENDPATH**/ ?>