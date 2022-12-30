<?php

namespace App\Providers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Movie_Genre;
use App\Models\Rating;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $tcategory=Category::all()->count();
        $tgenre=Genre::all()->count();
        $tcountry=Country::all()->count();
        $tmovie=Movie::all()->count();
        $tview=Movie::sum('count_views');
        $user_name=Movie::sum('count_views');

        View::share([
            'tcategory'=>$tcategory,
            'tgenre'=>$tgenre,
            'tcountry'=>$tcountry,
            'tmovie'=>$tmovie,
            'tview'=>$tview,
        ]);
    }
}
