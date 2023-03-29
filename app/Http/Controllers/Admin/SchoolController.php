<?php

namespace App\Http\Controllers\Admin;

use App\Builders\SchoolBuilder;
use App\Builders\UserBuilder;
use App\Exports\SchoolsUsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Imports\SchoolsImport;
use App\Models\User;
use App\Repositories\DistrictRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\SchoolRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SchoolController extends Controller {

    protected $builder;

    protected $user_builder;

    protected $repository;

    protected $review_repository;

    protected $district_repository;


    public function __construct() {
        $this->builder = new SchoolBuilder();
        $this->user_builder = new UserBuilder();
        $this->repository = new SchoolRepository();
        $this->review_repository = new ReviewRepository();
        $this->district_repository = new DistrictRepository();
    }


    public function index(Request $request) {
        $schools = $this->repository->getAllForAdminFiltered($request);
        $districts = $this->district_repository->getAllForAdmin();

        return view('admin.school.index', compact('schools', 'districts'));
    }

    public function create() {
        $districts = $this->district_repository->getAllForAdmin();

        return view('admin.school.create', compact('districts'));
    }

    public function store(CreateSchoolRequest $request) {
        $this->builder
            ->createEmpty()
            ->setTitle($request->title)
            ->setAddress($request->address)
            ->setDistrictId($request->district_id)
            ->setLatitude($request->latitude)
            ->setLongitude($request->longitude)
            ->setShortTitle($request->short_title)
            ->setStatus($request->status)
            ->save();

        if ($request->name && $request->password) {
            $this->user_builder
                ->createEmpty()
                ->setName($request->name)
                ->setPassword($request->password)
                ->setRoleId(3)
                ->setSchoolUuid($this->builder->getModel()->uuid)
                ->save();
        }

        return redirect('/admin/schools');
    }

    public function edit(string $uuid) {
        $school = $this->repository->getByUuidForAdmin($uuid);
        $districts = $this->district_repository->getAllForAdmin();

        return view('admin.school.edit', compact('school', 'districts'));
    }

    public function update(UpdateSchoolRequest $request, string $uuid) {
        if ($school = $this->repository->getByUuidForAdmin($uuid)) {
            $this->builder
                ->loadModel($school)
                ->setTitle($request->title)
                ->setAddress($request->address)
                ->setDistrictId($request->district_id)
                ->setLatitude($request->latitude)
                ->setLongitude($request->longitude)
                ->setShortTitle($request->short_title)
                ->setStatus($request->status)
                ->save();
        }

        return redirect('/admin/schools');
    }

    public function destroy(string $uuid) {
        $school = $this->repository->getByUuidForAdmin($uuid);

        $school->delete();

        return redirect('/admin/schools');
    }

    public function reviews(string $uuid) {
        $school = $this->repository->getByUuidForAdmin($uuid);

        return view('admin.school.reviews', compact('school'));
    }

    public function trash(string $uuid) {
        $school = $this->repository->getByUuidForAdmin($uuid);
        $reviews_trashed = $school->reviews_trashed;

        return view('admin.school.trashed', compact('school', 'reviews_trashed'));
    }

    public function reviewDelete(string $uuid) {
        $review = $this->review_repository->getByUuidForAdmin($uuid);

        $review->delete();

        return redirect('/admin/schools');
    }

    public function export() {
        $schools = $this->repository->getAllForAdmin();

        return view('admin.school.export', compact('schools'));
    }

    public function import(Request $request) {
        if ($request->hasFile('file')) {
            $users = [
                [
                    'Логин',
                    'Пароль',
                    'UUID школы',
                    'Заголовок школы'
                ]
            ];

            $districts = $this->district_repository->getAllForAdmin();
            $schools = $this->repository->getAllForAdmin();

            $items = Excel::toCollection(new SchoolsImport(), $request->file('file'))->toArray()[0];
            array_shift($items);
            array_shift($items);

            $items = collect($items)->filter(function ($school) {
                return !is_null($school[0]);
            })->map(function ($school) use ($districts, $schools, $users) {
                $school = [
                    'index' => $school[0],
                    'district_title' => $school[1],
                    'short_title' => $school[2],
                    'title' => $school[3],
                    'clear_title' => $this->getClearAddress($school[3]),
                    'address' => $school[4],
                    'clear_address' => $this->getClearAddress($school[4]),
                    'status' => $school[5],
                    'district_model' => null,
                    'school_model' => null,
                    'user_login' => null,
                    'user_password' => null,
                    'is_created' => 'Не найдена',
                ];

                $school['district_model'] = $districts->filter(function ($district) use ($school) {
                    return $district->title === $school['district_title'];
                })->values();
                $school['district_model'] = count($school['district_model']) > 0 ? $school['district_model'][0] : null;
                $school['school_model'] = $schools->filter(function ($school_model) use ($school) {
                    return ($this->getClearAddress($school_model->title) === $school['clear_title']) ||
                        count(array_uintersect(
                            $this->getClearAddress($school_model->address),
                            $school['clear_address'],
                            "strcasecmp"
                        )) >= 4;
                })->first();

                if (!is_null($school['school_model'])) {
                    $this->builder
                        ->loadModel($school['school_model'])
                        ->setShortTitle($school['short_title'])
                        ->setStatus($school['status'])
                        ->save();

                    $school['is_created'] = 'Обновлена';
                } else if (!is_null($school['district_model'])) {
                    $this->builder
                        ->createEmpty()
                        ->setTitle($school['title'])
                        ->setAddress($school['address'])
                        ->setDistrictId($school['district_model']->id)
                        ->setShortTitle($school['short_title'])
                        ->setStatus($school['status'])
                        ->save();

                    $user = [
                        'name' => Str::random(8),
                        'password' => Str::random(16),
                        'school_uuid' => $this->builder->getModel()->uuid,
                        'school_title' => $this->builder->getModel()->title,
                    ];

                    $this->user_builder
                        ->createEmpty()
                        ->setName($user['name'])
                        ->setPassword($user['password'])
                        ->setRoleId(1)
                        ->setSchoolUuid($user['school_uuid'])
                        ->save();

                    $school['is_created'] = 'Создана';
                    $school['user_login'] = $user['name'];
                    $school['user_password'] = $user['password'];
                }

                return [
                    $school['index'],
                    $school['title'],
                    $school['is_created'],
                    $school['user_login'],
                    $school['user_password'],
                ];
            })->toArray();

            array_unshift($items, [
                '№',
                'Заголовок',
                'Действие',
                'Пользователь_логин',
                'Пользователь_пароль',
            ]);

            $export = new SchoolsUsersExport();
            $export->users = $items;

            Excel::store($export, 'new_imported_schools.xlsx');
            return Excel::download($export, 'new_imported_schools.xlsx');
        }
        return 1;
    }

    private function getClearAddress($input_address) {
        $address = explode(' ', $input_address);
        preg_match_all('!\d+!', $address[0], $digits);
        if (count($digits[0]) > 0) {
            array_shift($address);
        }
        $splitted_address = [];

        foreach ($address as $el) {
            $el = str_replace([',', '.', "\""], ' ', $el);
            $el = explode(' ', $el);
            foreach ($el as $str) {
                $splitted_address[] = $str;
            }
        }

        $clear_address = [];

        foreach ($splitted_address as $split) {
            $split = str_replace(' ', '', $split);
            $split = explode('.', $split);
            foreach ($split as $el) {
                $matches = preg_match_all('!\d+!', $el, $matches);
                $el = str_replace([' '], '', $el);
                if ((mb_strlen($el) > 3 || $matches) && !in_array($el, ['область', 'обл', 'г', 'район'])) {
                    $clear_address[] = mb_strtolower($el);
                }
            }
        }

        //        return mb_strtolower(join('', $clear_address));
        return $clear_address;
    }

    private function getClearTitle($title) {
        $title = str_replace([',', '.', ' '], ' ', $title);
        return mb_strtolower($title);
    }


}
