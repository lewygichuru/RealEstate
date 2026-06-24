<div class="card bg-base-100 shadow-sm">
    <div class="card-body items-center gap-2 py-5">
        <div class="avatar">
            <div class="w-20 h-20 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                <img src="<?php echo e(Storage::url('users/'.auth()->user()->image)); ?>" alt="<?php echo e(auth()->user()->name); ?>">
            </div>
        </div>
        <h3 class="font-bold text-center"><?php echo e(auth()->user()->name); ?></h3>
        <p class="text-xs text-base-content/60 text-center"><?php echo e(auth()->user()->email); ?></p>
    </div>
    <ul class="menu menu-sm px-2 pb-4 gap-0.5">
        <li>
            <a href="<?php echo e(route('user.dashboard')); ?>"
               class="<?php echo e(request()->routeIs('user.dashboard') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">dashboard</span> Dashboard
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('user.profile')); ?>"
               class="<?php echo e(request()->routeIs('user.profile*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">person</span> Profile
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('user.message')); ?>"
               class="<?php echo e(request()->routeIs('user.message*') || request()->routeIs('user.messages.*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">mail</span> Messages
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('user.changepassword')); ?>"
               class="<?php echo e(request()->routeIs('user.changepassword*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">lock</span> Change Password
            </a>
        </li>
    </ul>
</div>
<?php /**PATH C:\projo\RealEstate-1\resources\views\user\sidebar.blade.php ENDPATH**/ ?>