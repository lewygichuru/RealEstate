<section class="bg-base-200 border-b border-base-300 py-4">
    <div class="container mx-auto px-4">
        <form action="<?php echo e(route('search')); ?>" method="GET">
            <div class="flex flex-wrap gap-3 items-end justify-center">

                <fieldset class="fieldset py-0">
                    <legend class="fieldset-legend text-xs font-semibold uppercase tracking-wide">City</legend>
                          <input type="text" name="city" list="city-datalist" value="<?php echo e(request('city')); ?>"
                              placeholder="Enter city..." autocomplete="off"
                              class="input input-sm w-40">
                    <datalist id="city-datalist">
                        <?php $__currentLoopData = $citylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($city); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </datalist>
                </fieldset>

                <fieldset class="fieldset py-0">
                    <legend class="fieldset-legend text-xs font-semibold uppercase tracking-wide">Type</legend>
                    <select name="type" class="select select-sm w-36">
                        <option value="">Any Type</option>
                        <option value="apartment" <?php echo e(request('type') == 'apartment' ? 'selected' : ''); ?>>Apartment</option>
                        <option value="house" <?php echo e(request('type') == 'house' ? 'selected' : ''); ?>>House</option>
                    </select>
                </fieldset>

                <fieldset class="fieldset py-0">
                    <legend class="fieldset-legend text-xs font-semibold uppercase tracking-wide">Status</legend>
                    <select name="status" class="select select-sm w-32">
                        <option value="">Any</option>
                        <option value="available" <?php echo e(request('status') == 'available' ? 'selected' : ''); ?>>Available</option>
                        <option value="rented" <?php echo e(request('status') == 'rented' ? 'selected' : ''); ?>>Rented</option>
                        <option value="maintenance" <?php echo e(request('status') == 'maintenance' ? 'selected' : ''); ?>>Maintenance</option>
                    </select>
                </fieldset>

                <fieldset class="fieldset py-0">
                    <legend class="fieldset-legend text-xs font-semibold uppercase tracking-wide">Beds</legend>
                    <select name="bedroom" class="select select-sm w-28">
                        <option value="">Any</option>
                        <?php if(isset($bedroomdistinct)): ?>
                            <?php $__currentLoopData = $bedroomdistinct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($b->bedroom); ?>" <?php echo e(request('bedroom') == $b->bedroom ? 'selected' : ''); ?>><?php echo e($b->bedroom); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </fieldset>

                <fieldset class="fieldset py-0">
                    <legend class="fieldset-legend text-xs font-semibold uppercase tracking-wide">Max Price</legend>
                          <input type="number" name="maxprice" value="<?php echo e(request('maxprice')); ?>" placeholder="Max price"
                              class="input input-sm w-32">
                </fieldset>

                <div class="self-end">
                    <button type="submit" class="btn btn-primary btn-sm gap-1">
                        <span class="material-icons text-sm">search</span> Search
                    </button>
                </div>

            </div>
        </form>
    </div>
</section>
<?php /**PATH C:\projo\RealEstate-1\resources\views\frontend\partials\search.blade.php ENDPATH**/ ?>