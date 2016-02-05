Base On Laravel Framework

#Note
    Add this to Pinpong Routing\Controller
<?php

namespace Pingpong\Modules\Routing;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Cache;
use Modules\Siswa\Entities\Config;

abstract class Controller extends BaseController
{
    use DispatchesCommands, ValidatesRequests;

    public function __construct() {

        //        $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;

        $year = Cache::remember('year', 720, function()
        {
            return Config::where('slug', '=', 'tahun-ajar')->first()->value;
        });

        \View::share ( 'year', $year );

    }
}
