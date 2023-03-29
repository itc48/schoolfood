<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\SchoolRepository;
use App\Traits\CoordinatesDistance;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    use CoordinatesDistance;

    private $repository;

    public function __construct() {
        $this->repository = new SchoolRepository();
    }
    
    public function qrcode(string $uuid) {
        $school = $this->repository->getByUuidForPublic($uuid);
        $domain = 'https://' . $_SERVER['HTTP_HOST'] . '/review/' . $uuid;

        $qr = QrCode::encoding('UTF-8')->size(500)->generate("Оценить питание в $school->title $domain");
        return view('qrcode', ['school' => $school, 'domain' => $domain]);
    }
}