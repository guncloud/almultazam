Base On Laravel Framework

#Note
    Add this to Pinpong Controller
    public function __construct() {

    //        $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;

            $year = Cache::remember('year', 720, function()
            {
                return Config::where('slug', '=', 'tahun-ajar')->first()->value;
            });

            \View::share ( 'year', $year );

        }