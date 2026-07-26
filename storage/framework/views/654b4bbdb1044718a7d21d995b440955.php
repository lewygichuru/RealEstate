<?php $__env->startSection('content'); ?>
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            
            <div class="lg:col-span-2">
                
                <div class="card card-side bg-base-100 shadow-sm mb-8">
                    <figure class="w-32 shrink-0">
                        <img src="<?php echo e(Storage::url('users/'.$agent->image)); ?>" alt="<?php echo e($agent->name); ?>"
                             class="h-full w-full object-cover">
                    </figure>
                    <div class="card-body p-5">
                        <h2 class="card-title"><?php echo e($agent->name); ?></h2>
                        <p class="text-sm text-base-content/60"><?php echo e($agent->email); ?></p>
                        <p class="text-sm text-base-content/70"><?php echo e($agent->about); ?></p>
                    </div>
                </div>

                <h2 class="text-xl font-bold mb-4">Properties by <?php echo e($agent->name); ?></h2>

                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="card card-side bg-base-100 shadow-sm hover:shadow-md transition-shadow">
                        <figure class="w-36 shrink-0">
                            <?php ($cover = $property->gallery->first()); ?>
                            <div class="h-full w-full bg-cover bg-center"
                                 style="background-image: url('<?php echo e($cover && $cover->file_path && Storage::disk('public')->exists($cover->file_path) ? Storage::url($cover->file_path) : ($property->image ? Storage::url('property/'.$property->image) : '')); ?>')"></div>
                        </figure>
                        <div class="card-body p-4">
                            <a href="<?php echo e(route('property.show', $property->slug)); ?>">
                                <h3 class="card-title text-base hover:text-primary transition-colors line-clamp-1">
                                    <?php echo e(\Illuminate\Support\Str::limit($property->title, 40)); ?>

                                </h3>
                            </a>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-primary">
                                    Ksh <?php echo e(number_format($property->price)); ?>

                                    <?php if($property->type === 'apartment' && optional($property->units->first())->rent_amount): ?>
                                        <span class="text-xs font-normal">/mo</span>
                                    <?php endif; ?>
                                </span>
                                <span class="badge badge-outline badge-sm"><?php echo e(ucfirst($property->type)); ?> · <?php echo e($property->status); ?></span>
                            </div>
                            <div class="flex gap-3 text-xs text-base-content/60">
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">bed</span> <?php echo e($property->bedroom); ?></span>
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">bathtub</span> <?php echo e($property->bathroom); ?></span>
                                <span class="flex items-center gap-1"><span class="material-icons text-sm">square_foot</span> <?php echo e($property->area); ?> sqft</span>
                                <?php if($property->is_featured): ?>
                                    <span class="badge badge-warning badge-sm ml-auto">Featured</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="alert"><span>No properties listed by this agent yet.</span></div>
                    <?php endif; ?>
                </div>

                <div class="mt-8 flex justify-center">
                    <?php echo e($properties->links()); ?>

                </div>
            </div>

            
            <aside>
                <div class="card bg-base-100 shadow-sm sticky top-20">
                    <div class="card-body gap-3">
                        <h2 class="card-title text-base">Send a Message</h2>
                        <form class="agent-message-box flex flex-col gap-3 mt-1" action="" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="agent_id" value="<?php echo e($agent->id); ?>">
                            <input type="hidden" name="user_id" value="<?php echo e(auth()->id()); ?>">
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Name</legend>
                                <input type="text" name="name" placeholder="Your Name" class="input input-sm w-full">
                            </fieldset>
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Email</legend>
                                <input type="email" name="email" placeholder="Your Email" class="input input-sm w-full">
                            </fieldset>
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Phone</legend>
                                <input type="number" name="phone" placeholder="Your Phone" class="input input-sm w-full">
                            </fieldset>
                            <fieldset class="fieldset py-0">
                                <legend class="fieldset-legend">Message</legend>
                                <textarea name="message" rows="4" placeholder="Your Message" class="textarea textarea-sm w-full"></textarea>
                            </fieldset>
                            <button id="msgsubmitbtn" type="submit" class="btn btn-primary btn-sm w-full gap-1">
                                <span class="material-icons text-sm">send</span> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(function(){
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $(document).on('submit', '.agent-message-box', function(e) {
        e.preventDefault();
        var btn = $('#msgsubmitbtn');
        btn.addClass('loading').prop('disabled', true);
        $.ajax({
            type: 'POST', url: "<?php echo e(route('property.message')); ?>",
            data: $(this).serialize(),
            success: function(data) { if (data.message) toastr.success(data.message); },
            error: function() { toastr.error('Failed to send message.'); },
            complete: function() { btn.removeClass('loading').prop('disabled', false); $('form.agent-message-box')[0].reset(); },
            dataType: 'json'
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views/pages/agents/single.blade.php ENDPATH**/ ?>