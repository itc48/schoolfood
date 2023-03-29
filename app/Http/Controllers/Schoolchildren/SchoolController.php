<?php

namespace App\Http\Controllers\Schoolchildren;

use App\Builders\SchoolBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSchoolRequest;
use App\Repositories\SchoolRepository;

class SchoolController extends Controller {

    protected $repository;

    protected $builder;


    public function __construct() {
        $this->repository = new SchoolRepository();
        $this->builder = new SchoolBuilder();
    }


    public function index() {
        $schools = $this->repository->getAllForSchoolchildren();

        return view('schoolchildren.school.index', compact('schools'));
    }


    public function edit(string $uuid) {
        $school = $this->repository->getByUuidForAdmin($uuid);

        return view('schoolchildren.school.edit', compact('school'));
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
                ->save();
        }

        return redirect('/schoolchildren/schools');
    }


    public function reviews(string $uuid) {
        $school = $this->repository->getByUuidForAdmin($uuid);

        return view('schoolchildren.school.reviews', compact('school'));
    }

}
