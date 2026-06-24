<footer class="bg-base-200 border-t border-base-300 mt-auto">
    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            
            <div>
                <h3 class="font-bold text-lg mb-3 uppercase tracking-wide">About Us</h3>
                <p class="text-base-content/70 text-sm leading-relaxed">
                    <?php if(!empty($footersettings['aboutus'])): ?>
                        <?php echo e($footersettings['aboutus']); ?>

                    <?php else: ?>
                        At RealEstate, we connect buyers, sellers, and renters with trusted property listings across prime locations.
                    <?php endif; ?>
                </p>
            </div>

            
            <div>
                <h3 class="font-bold text-lg mb-3 uppercase tracking-wide">Recent Properties</h3>
                <ul class="space-y-3">
                    <?php $__currentLoopData = $footerproperties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-center gap-3">
                        <?php ($cover = $property->gallery->first()); ?>
                        <?php ($bg = $cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path) ? Storage::url($cover->file_path) : (Storage::disk('public')->exists('property/'.$property->image) ? Storage::url('property/'.$property->image) : (Storage::disk('public')->exists('property/gallery/'.$property->image) ? Storage::url('property/gallery/'.$property->image) : ''))); ?>
                        <div class="w-14 h-10 rounded shrink-0 bg-cover bg-center"
                             style="background-image:url(<?php echo e($bg); ?>)"></div>
                        <div>
                            <a href="<?php echo e(route('property.show', $property->slug)); ?>" class="text-sm font-medium hover:text-primary transition-colors line-clamp-1">
                                <?php echo e(\Illuminate\Support\Str::limit($property->title, 35)); ?>

                            </a>
                            <p class="text-xs text-base-content/60"><?php echo e($property->bedroom); ?>bd · <?php echo e($property->bathroom); ?>ba</p>
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            
            <div>
                <h3 class="font-bold text-lg mb-3 uppercase tracking-wide">Quick Links</h3>
                <ul class="space-y-1 text-sm">
                    <li><a href="<?php echo e(route('property')); ?>" class="hover:text-primary transition-colors">Properties</a></li>
                    <li><a href="<?php echo e(route('agents')); ?>" class="hover:text-primary transition-colors">Agents</a></li>
                    <li><a href="<?php echo e(route('gallery')); ?>" class="hover:text-primary transition-colors">Gallery</a></li>
                    <li><a href="<?php echo e(route('blog')); ?>" class="hover:text-primary transition-colors">Blog</a></li>
                    <li><a href="<?php echo e(route('contact')); ?>" class="hover:text-primary transition-colors">Contact</a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="border-t border-base-300 bg-base-300">
        <div class="container mx-auto px-4 py-3 flex flex-wrap items-center justify-between gap-2 text-sm text-base-content/70">
            <span>
                <?php if(!empty($footersettings['footer'])): ?>
                    <?php echo e($footersettings['footer']); ?>

                <?php else: ?>
                    &copy; <?php echo e(date('Y')); ?> Real Estate. All rights reserved.
                <?php endif; ?>
            </span>
            <div class="flex gap-3">
                <?php if(!empty($footersettings['facebook'])): ?>
                    <a href="<?php echo e($footersettings['facebook']); ?>" target="_blank" class="hover:text-primary transition-colors font-medium">Facebook</a>
                <?php endif; ?>
                <?php if(!empty($footersettings['twitter'])): ?>
                    <a href="<?php echo e($footersettings['twitter']); ?>" target="_blank" class="hover:text-primary transition-colors font-medium">Twitter</a>
                <?php endif; ?>
                <?php if(!empty($footersettings['linkedin'])): ?>
                    <a href="<?php echo e($footersettings['linkedin']); ?>" target="_blank" class="hover:text-primary transition-colors font-medium">LinkedIn</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH C:\projo\RealEstate-1\resources\views/frontend/partials/footer.blade.php ENDPATH**/ ?>