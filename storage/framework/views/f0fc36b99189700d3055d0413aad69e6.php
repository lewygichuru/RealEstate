<?php $__env->startSection('content'); ?>
<section class="py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Contact Us</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            
            <div class="lg:col-span-2">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body gap-4">
                        <h2 class="card-title">Send a Message</h2>
                        <form id="contact-us" action="" method="POST" class="flex flex-col gap-4">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="mailto" value="<?php echo e($footersettings['email'] ?? ''); ?>">
                            <?php if(auth()->guard()->check()): ?>
                                <input type="hidden" name="user_id" value="<?php echo e(auth()->id()); ?>">
                            <?php endif; ?>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Your Name</legend>
                                <?php if(auth()->guard()->check()): ?>
                                    <input type="text" name="name" value="<?php echo e(auth()->user()->name); ?>" readonly
                                           class="input w-full bg-base-200">
                                <?php else: ?>
                                    <input type="text" name="name" placeholder="Your full name" class="input w-full">
                                <?php endif; ?>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Email Address</legend>
                                <?php if(auth()->guard()->check()): ?>
                                    <input type="email" name="email" value="<?php echo e(auth()->user()->email); ?>" readonly
                                           class="input w-full bg-base-200">
                                <?php else: ?>
                                    <input type="email" name="email" placeholder="your@email.com" class="input w-full">
                                <?php endif; ?>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Phone Number</legend>
                                <input type="number" name="phone" placeholder="Your phone number" class="input w-full">
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Message</legend>
                                <textarea name="message" rows="5" placeholder="Write your message..."
                                          class="textarea w-full"></textarea>
                            </fieldset>

                            <button id="msgsubmitbtn" type="submit" class="btn btn-primary gap-2 w-fit">
                                <span class="material-icons text-sm">send</span> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            
            <aside>
                <div class="card bg-base-100 shadow-sm sticky top-20">
                    <div class="card-body gap-6">
                        <h2 class="card-title text-base">Get In Touch</h2>

                        <?php if(!empty($footersettings['phone'])): ?>
                        <div class="flex items-start gap-3">
                            <span class="material-icons text-primary mt-0.5">call</span>
                            <div>
                                <p class="text-xs text-base-content/50 uppercase font-semibold tracking-wide">Call Us Now</p>
                                <p class="font-semibold"><?php echo e($footersettings['phone']); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($footersettings['email'])): ?>
                        <div class="flex items-start gap-3">
                            <span class="material-icons text-primary mt-0.5">mail</span>
                            <div>
                                <p class="text-xs text-base-content/50 uppercase font-semibold tracking-wide">Email</p>
                                <p class="font-semibold"><?php echo e($footersettings['email']); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($footersettings['address'])): ?>
                        <div class="flex items-start gap-3">
                            <span class="material-icons text-primary mt-0.5">map</span>
                            <div>
                                <p class="text-xs text-base-content/50 uppercase font-semibold tracking-wide">Address</p>
                                <p class="font-semibold"><?php echo $footersettings['address']; ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
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
    $(document).on('submit', '#contact-us', function(e) {
        e.preventDefault();
        var btn = $('#msgsubmitbtn');
        btn.addClass('loading').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: "<?php echo e(route('contact.message')); ?>",
            data: $(this).serialize(),
            success: function(data) { if (data.message) toastr.success(data.message); },
            error: function() { toastr.error('Failed to send message.'); },
            complete: function() {
                $('form#contact-us')[0].reset();
                btn.removeClass('loading').prop('disabled', false);
            },
            dataType: 'json'
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projo\RealEstate-1\resources\views\pages\contact.blade.php ENDPATH**/ ?>