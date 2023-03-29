<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\SchoolRepository;
use App\Traits\CoordinatesDistance;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SchoolController extends Controller {

    use CoordinatesDistance;

    private $repository;

    public function __construct() {
        $this->repository = new SchoolRepository();
    }

    public function show(Request $request, string $uuid) {
        if (!Str::isUuid($uuid)) {
            return response('', 404);
        }

        $school = $this->repository->getByUuidForPublic($uuid);

        if ($request->longitude && $request->latitude) {
            $distance = $this->getDistance($school->latitude, $school->longitude, $request->latitude, $request->longitude);

            if ($distance > 500) {
                return response('Вы находитесь за пределом радиуса школы', 404);
            }
        }

        return $school;
    }

    public function qrCode(string $uuid) {
        $school = $this->repository->getByUuidForPublic($uuid);
        $domain = 'https://' . $_SERVER['HTTP_HOST'] . '/review/' . $uuid;

        return view('qrcode');
    }
}