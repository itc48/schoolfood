<?php

namespace App\Console\Commands;

use App\Models\School;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class GenerateSchoolsCoordinates extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schools:coordinates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating and storing schools coordinates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {

        $schools = School::all();
        $client = new Client();

        foreach ($schools as $school) {
            $address = urlencode($school->address);
            $url = "http://api.admlr.lipetsk.ru/address/api/v1/coords?address=$address";

            try {
                $res = $client->request('GET', $url, [
                    'headers' => [
                        'Authorization' => 'Bearer 84a7c7f3c7d014a2486aa8c035ad0a436c4d89818e817c874c5392198e829461',
                    ]
                ]);

                $data = json_decode($res->getBody());

                if ($data->data) {
                    $school->latitude = $data->data->geo_lat ?? $school->latitude;
                    $school->longitude = $data->data->geo_lon ?? $school->longitude;
                    $school->save();
                    $this->info($school->address . " success");
                }
            } catch (\Exception $e) {
                $this->error($school->address . " error");
            }
        }

        $this->info('Successful generating schools coordinates');

        return 0;
    }
}
