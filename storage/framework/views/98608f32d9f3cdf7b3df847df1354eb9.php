<?php
    $amenityOptions = $amenityOptions ?? ['Parking', 'Pool', 'Gym', 'Security', 'Elevator', 'Garden', 'Backup Power', 'Water Tank', 'Internet', 'Furnished'];
    $selectedAmenities = old('amenities', $property?->amenities ?? []);
    $selectedAmenities = is_array($selectedAmenities) ? $selectedAmenities : [];
?>

<div>
    <h4 class="text-sm font-semibold mb-2">Amenities</h4>
    <div class="flex flex-wrap gap-2">
        <?php $__currentLoopData = $amenityOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <label class="label cursor-pointer gap-1.5 bg-base-200 rounded-lg px-3 py-1.5">
            <input type="checkbox" name="amenities[]" value="<?php echo e($amenity); ?>" class="checkbox checkbox-primary checkbox-xs"
                   <?php if(in_array($amenity, $selectedAmenities, true)): echo 'checked'; endif; ?>>
            <span class="text-sm"><?php echo e($amenity); ?></span>
        </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\projo\RealEstate-1\resources\views/partials/property-amenities.blade.php ENDPATH**/ ?>