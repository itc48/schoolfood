<?php

namespace App\Http\Controllers\Moderator;

use App\Builders\SchoolBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Repositories\DistrictRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\SchoolRepository;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller {

    protected $builder;

    protected $repository;

    protected $district_repository;


    public function __construct() {
        $this->builder = new SchoolBuilder();
        $this->repository = new SchoolRepository();
        $this->district_repository = new DistrictRepository();
    }


    public function index() {
        $schools = $this->repository->getAllForModerator();

        return view('moderator.school.index', compact('schools'));
    }


    public function create() {
        return view('moderator.school.create');
    }


    public function store(CreateSchoolRequest $request) {
        $this->builder
            ->createEmpty()
            ->setTitle($request->title)
            ->setAddress($request->address)
            ->setDistrictId(Auth::user()->district_id)
            ->setLatitude($request->latitude)
            ->setLongitude($request->longitude)
            ->setShortTitle($request->short_title)
            ->setStatus($request->status)
            ->save();

        return redirect('/moderator/schools');
    }

    public function edit(string $uuid) {
        $school = $this->repository->getByUuidForAdmin($uuid);
        $districts = $this->district_repository->getAllForAdmin();

        return view('moderator.school.edit', compact('school', 'districts'));
    }

    public function update(UpdateSchoolRequest $request, string $uuid) {
        if ($school = $this->repository->getByUuidForAdmin($uuid)) {
            $this->builder
                ->loadModel($school)
                ->setTitle($request->title)
                ->setAddress($request->address)
                ->setLatitude($request->latitude)
                ->setLongitude($request->longitude)
                ->setShortTitle($request->short_title)
                ->setStatus($request->status)
                ->save();
        }

        return redirect('/moderator/schools');
    }

    public function reviews(string $uuid) {
        $school = $this->repository->getByUuidForAdmin($uuid);

        return view('moderator.school.reviews', compact('school'));
    }

}
