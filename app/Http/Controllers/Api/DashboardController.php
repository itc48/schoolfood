<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetDashboardRequest;
use App\Http\Requests\GetDashboardSchoolRequest;
use App\Http\Resources\DashboardDateValue;
use App\Http\Resources\DashboardPositiveNegative;
use App\Http\Resources\DashboardPositiveNegativeSchools;
use App\Http\Resources\DashboardSchoolValue;
use App\Repositories\DashboardRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private $repository;

    public function __construct() {
        $this->repository = new DashboardRepository();
    }

    public function schools() {
        return $this->repository->getAllForPublic();
    }

    public function everydayCount(GetDashboardRequest $request) {
        $data = $this->repository->getEveryDayCount($request);

        return new DashboardDateValue($data);
    }

    public function everydayNegativeCount(GetDashboardRequest $request) {
        $data = $this->repository->getEverydayNegativeCount($request);

        return new DashboardDateValue($data);
    }

    public function schoolPositiveCount(GetDashboardSchoolRequest $request) {
        $data = $this->repository->getSchoolPositiveCount($request);

        return new DashboardSchoolValue($data);
    }

    public function schoolsCount() {
        $data = $this->repository->getSchoolsCount();

        return new DashboardSchoolValue($data);
    }

    public function schoolsSummaryCount(GetDashboardSchoolRequest $request) {
        $data = $this->repository->getSchoolsSummaryCount($request);

        return new DashboardSchoolValue($data);
    }

    public function everydayPositiveNegativeCount(GetDashboardRequest $request) {
        $data = $this->repository->getEverydayPositiveNegativeCount($request);

        return new DashboardPositiveNegative($data);
    }

    public function schoolsPositiveNegativeCount(GetDashboardRequest $request) {
        $data = $this->repository->getSchoolsPositiveNegativeCount($request);

        return new DashboardPositiveNegativeSchools($data);
    }

}
