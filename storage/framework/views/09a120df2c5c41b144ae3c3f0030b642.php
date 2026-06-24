<aside class="bg-base-100 border-r border-base-300 min-h-full w-64 flex flex-col">

    
    <div class="p-4 border-b border-base-300">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-2 text-primary font-bold text-lg">
            <span class="material-icons">location_city</span>
            Real Estate
        </a>
        <p class="text-xs text-base-content/50 mt-0.5">Administration</p>
    </div>

    
    <ul class="menu menu-sm p-3 gap-0.5 flex-1">

        <li class="menu-title text-xs">Main</li>

        <li>
            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">dashboard</span> Dashboard
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.sliders.index')); ?>"
               class="<?php echo e(request()->routeIs('admin.sliders.*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">burst_mode</span> Sliders
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.properties.index')); ?>"
               class="<?php echo e(request()->routeIs('admin.properties.*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">home</span> Properties
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.features.index')); ?>"
               class="<?php echo e(request()->routeIs('admin.features.*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">star</span> Features
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.services.index')); ?>"
               class="<?php echo e(request()->routeIs('admin.services.*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">wb_sunny</span> Services
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.testimonials.index')); ?>"
               class="<?php echo e(request()->routeIs('admin.testimonials.*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">view_carousel</span> Testimonials
            </a>
        </li>

        <li class="menu-title text-xs mt-2">Blog</li>

        <li>
            <a href="<?php echo e(route('admin.categories.index')); ?>"
               class="<?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">category</span> Categories
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.tags.index')); ?>"
               class="<?php echo e(request()->routeIs('admin.tags.*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">label</span> Tags
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.posts.index')); ?>"
               class="<?php echo e(request()->routeIs('admin.posts.*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">library_books</span> Posts
            </a>
        </li>

        <li class="menu-title text-xs mt-2">Other</li>

        <li>
            <a href="<?php echo e(route('admin.album')); ?>"
               class="<?php echo e(request()->routeIs('admin.album*') || request()->routeIs('admin.galleries*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">photo_library</span> Gallery
            </a>
        </li>

        <li class="menu-title text-xs mt-2">Settings</li>

        <li>
            <a href="<?php echo e(route('admin.settings')); ?>"
               class="<?php echo e(request()->routeIs('admin.settings*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">settings</span> Site Settings
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.profile')); ?>"
               class="<?php echo e(request()->routeIs('admin.profile*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">person</span> Profile
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.changepassword')); ?>"
               class="<?php echo e(request()->routeIs('admin.changepassword*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">lock</span> Change Password
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.message')); ?>"
               class="<?php echo e(request()->routeIs('admin.message*') || request()->routeIs('admin.messages.*') ? 'active' : ''); ?>">
                <span class="material-icons text-sm">message</span> Messages
                <?php if($countmessages > 0): ?>
                    <span class="badge badge-primary badge-sm ml-auto"><?php echo e($countmessages); ?></span>
                <?php endif; ?>
            </a>
        </li>

    </ul>

</aside>
<?php /**PATH C:\projo\RealEstate-1\resources\views\backend\partials\sidebar.blade.php ENDPATH**/ ?>