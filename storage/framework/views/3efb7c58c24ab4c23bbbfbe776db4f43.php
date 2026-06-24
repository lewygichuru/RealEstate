<div class="navbar bg-primary text-primary-content shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 w-full flex items-center">

        
        <div class="flex-1">
            <a href="<?php echo e(route('home')); ?>" class="btn btn-ghost text-xl font-bold gap-1">
                <span class="material-icons">location_city</span>
                <?php if(!empty($footersettings['name'])): ?>
                    <?php echo e($footersettings['name']); ?>

                <?php else: ?>
                    Real Estate
                <?php endif; ?>
            </a>
        </div>

        
        <div class="hidden lg:flex">
            <ul class="menu menu-horizontal px-1 gap-1">
                <li><a href="<?php echo e(route('home')); ?>" class="<?php echo e(Request::is('/') ? 'underline underline-offset-4' : ''); ?>">Home</a></li>
                <li><a href="<?php echo e(route('property')); ?>" class="<?php echo e(Request::is('property*') ? 'underline underline-offset-4' : ''); ?>">Properties</a></li>
                <li><a href="<?php echo e(route('agents')); ?>" class="<?php echo e(Request::is('agents*') ? 'underline underline-offset-4' : ''); ?>">Agents</a></li>
                <li><a href="<?php echo e(route('gallery')); ?>" class="<?php echo e(Request::is('gallery') ? 'underline underline-offset-4' : ''); ?>">Gallery</a></li>
                <li><a href="<?php echo e(route('blog')); ?>" class="<?php echo e(Request::is('blog*') ? 'underline underline-offset-4' : ''); ?>">Blog</a></li>
                <li><a href="<?php echo e(route('contact')); ?>" class="<?php echo e(Request::is('contact') ? 'underline underline-offset-4' : ''); ?>">Contact</a></li>
            </ul>
        </div>

        
        <div class="flex items-center gap-2 ml-2">
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-ghost btn-sm hidden sm:flex">Login</a>
                <a href="<?php echo e(route('register')); ?>" class="btn btn-sm bg-white text-primary hover:bg-base-200">Register</a>
            <?php else: ?>
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-sm gap-2">
                        <img src="<?php echo e(Storage::url('users/'.auth()->user()->image)); ?>"
                             class="w-7 h-7 rounded-full object-cover ring-2 ring-white/40"
                             alt="<?php echo e(auth()->user()->name); ?>">
                        <span class="hidden md:inline text-sm"><?php echo e(ucfirst(auth()->user()->username)); ?></span>
                        <span class="material-icons text-sm">arrow_drop_down</span>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu menu-sm bg-base-100 text-base-content rounded-box shadow-xl w-48 mt-2 z-50">
                        <?php if(auth()->user()->hasRole('admin')): ?>
                            <li><a href="<?php echo e(route('admin.dashboard')); ?>"><span class="material-icons text-sm">dashboard</span> Dashboard</a></li>
                        <?php elseif(auth()->user()->hasRole('staff')): ?>
                            <li><a href="<?php echo e(route('agent.dashboard')); ?>"><span class="material-icons text-sm">dashboard</span> Dashboard</a></li>
                        <?php elseif(auth()->user()->hasRole('tenant')): ?>
                            <li><a href="<?php echo e(route('user.dashboard')); ?>"><span class="material-icons text-sm">dashboard</span> Dashboard</a></li>
                        <?php endif; ?>
                        <li class="divider m-0"></li>
                        <li>
                            <a href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="material-icons text-sm">power_settings_new</span> Logout
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="hidden"><?php echo csrf_field(); ?></form>
                </div>
            <?php endif; ?>

            
            <div class="dropdown dropdown-end lg:hidden">
                <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                    <span class="material-icons">menu</span>
                </div>
                <ul tabindex="0" class="dropdown-content menu menu-sm bg-base-100 text-base-content rounded-box shadow-xl w-52 mt-2 z-50">
                    <li><a href="<?php echo e(route('home')); ?>"><span class="material-icons text-sm">home</span> Home</a></li>
                    <li><a href="<?php echo e(route('property')); ?>"><span class="material-icons text-sm">apartment</span> Properties</a></li>
                    <li><a href="<?php echo e(route('agents')); ?>"><span class="material-icons text-sm">people</span> Agents</a></li>
                    <li><a href="<?php echo e(route('gallery')); ?>"><span class="material-icons text-sm">photo_library</span> Gallery</a></li>
                    <li><a href="<?php echo e(route('blog')); ?>"><span class="material-icons text-sm">article</span> Blog</a></li>
                    <li><a href="<?php echo e(route('contact')); ?>"><span class="material-icons text-sm">mail</span> Contact</a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
<?php /**PATH C:\projo\RealEstate-1\resources\views/frontend/partials/navbar.blade.php ENDPATH**/ ?>