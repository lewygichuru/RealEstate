<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Post;
use App\Models\Property;
use App\Models\Setting;
use App\Models\Message;
use App\Models\Tag;
use App\Models\Unit;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.daisy');
        Paginator::defaultSimpleView('vendor.pagination.daisy-simple');

        View::composer(['backend.partials.navbar', 'backend.partials.sidebar'], function ($view) {
            $userId = Auth::id();
            $view->with([
                'countmessages'  => Message::where('receiver_id', '=', $userId, 'and')->whereNull('read_at')->count('*'),
                'navbarmessages' => Message::latest('created_at')->where('receiver_id', '=', $userId, 'and')->take(5)->get(),
            ]);
        });

        View::composer('pages.blog.sidebar', function ($view) {
            $view->with([
                'popularposts' => Post::where('status', '=', 'published', 'and')
                    ->orderByDesc('published_at')
                    ->take(5)
                    ->get(),
                'categories'   => Category::withCount('posts')->get(),
                'tags'         => Tag::all(),
                'archives'     => DB::table('posts')
                                    ->selectRaw('MONTHNAME(created_at) as month, YEAR(created_at) as year, COUNT(*) as published', [])
                                    ->where('status', '=', 'published', 'and')
                                    ->groupBy('year', 'month')
                                    ->orderByDesc('year')
                                    ->orderByDesc('month')
                                    ->get()
                                    ->map(fn($r) => (array) $r)
                                    ->toArray(),
            ]);
        });

        View::composer('*', function ($view) {
            static $shared = null;
                if ($shared === null) {
                    $shared = [
                        'footerproperties' => Schema::hasTable('properties') ? Property::latest('created_at')->take(3)->get() : collect(),
                        'footersettings'   => Schema::hasTable('settings') ? Setting::all()->toArray() : [],
                        'citylist'         => Schema::hasTable('properties') ? Property::select('city')->distinct()->pluck('city')->map(fn($c) => ucfirst($c))->toArray() : [],
                        'bedroomdistinct'  => Schema::hasTable('units') ? Unit::select('bedrooms as bedroom')->distinct()->orderBy('bedrooms')->get() : collect(),
                        'bathroomdistinct' => Schema::hasTable('units') ? Unit::select('bathrooms as bathroom')->distinct()->orderBy('bathrooms')->get() : collect(),
                    ];
                }
            $view->with($shared);
        });
    }
}
