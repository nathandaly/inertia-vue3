<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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
        Inertia::version(static function () {
            return md5_file(public_path('mix-manifest.json'));
        });

        Inertia::share([
            'auth' => static function () {
                return [
                    'user' => Auth::user() ? [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                    ] : null,
                ];
            },
            'flash' => static function () {
                return [
                    'success' => Session::get('success'),
                    'status' => Session::get('status')
                ];
            },
            'errors' => static function () {
                return Session::get('errors')
                    ? Session::get('errors')
                        ->getBag('default')
                        ->getMessages()
                    : (object) [];
            },
        ]);
    }
}
