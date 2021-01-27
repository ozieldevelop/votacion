<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
     
		$file1 = app_path('helper/GeneralHelper.php');
		require_once($file1);
		$file2 = app_path('helper/EnvioEmail.php.php');
		require_once($file2);

		/*foreach (glob(app_path() . '/helper/*.php') as $file) {
			require_once($file);
		}*/
	
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
