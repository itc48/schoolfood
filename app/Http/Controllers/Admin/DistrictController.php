<?php

namespace App\Http\Controllers\Admin;

use App\Builders\DistrictBuilder;
use App\Builders\SchoolBuilder;
use App\Exports\SchoolsUsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDistrictRequest;
use App\Imports\SchoolsImport;
use App\Repositories\DistrictRepository;
use App\Repositories\SchoolRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use function PHPUnit\Framework\countOf;

class DistrictController extends Controller {

    protected $builder;

    protected $repository;


    public function __construct() {
        $this->builder = new DistrictBuilder();
        $this->school_builder = new SchoolBuilder();
        $this->repository = new DistrictRepository();
        $this->school_repository = new SchoolRepository();
    }


    public function index() {
        $districts = $this->repository->getAllForAdmin();

        return view('admin.district.index', compact('districts'));
    }


    public function create() {
        return view('admin.district.create');
    }


    public function store(CreateDistrictRequest $request) {
        $this->builder
            ->createEmpty()
            ->setTitle($request->title)
            ->save();

        return redirect('/admin/districts');
    }


    public function edit(int $id) {
        $district = $this->repository->getByIdForAdmin($id);

        return view('admin.district.edit', compact('district'));
    }


    public function update(CreateDistrictRequest $request, int $id) {
        if ($district = $this->repository->getByIdForAdmin($id)) {
            $this->builder
                ->loadModel($district)
                ->setTitle($request->title)
                ->save();
        }

        return redirect('/admin/districts');
    }


    public function destroy(int $id) {
        $district = $this->repository->getByIdForAdmin($id);

        $district->delete();

        return redirect('/admin/districts');
    }


    public function import(Request $request) {
        if ($request->hasFile('file')) {
            $schools = $this->school_repository->getAllForAdmin();

            $items = Excel::toCollection(new SchoolsImport(), $request->file('file'))->toArray();
            array_shift($items[0]);
            $items = collect($items[0]);

            $districts = $items->unique(2)->values();

            foreach ($districts as $district) {
                if (!is_null($district[2])) {
                    $this->builder
                        ->createEmpty()
                        ->setTitle($district[2])
                        ->save();
                }
            }

            $districts_models = $this->repository->getAllForAdmin();

            $items = $items->filter(function ($item) {
                return $item[5];
            })->map(function ($item) use ($districts_models) {
                return [
                    'id' => $item[0],
                    'district_title' => $item[2],
                    'district_id' => $districts_models->filter(function ($district) use ($item) {
                        return $district->title === $item[2];
                    })->first(),
                    'title' => $item[5],
                    'clear_title' => $this->getClearTitle($item[5]),
                    'address' => $item[6],
                    'clear_address' => $this->getClearAddress($item[6]),
                ];
            });

            $test = [];

            foreach ($schools as $school) {
                $district = $items->filter(function ($item) use ($school) {
                    return count(array_uintersect(
                            $item['clear_address'],
                            $this->getClearAddress($school->address),
                            "strcasecmp"
                        )) >= 3 || ($this->getClearTitle($school->title) === $item['clear_title']);
                })->first();

                if ($district) {
                    $this->school_builder
                        ->loadModel($school)
                        ->setDistrictId($district['district_id']->id)
                        ->save();
                } else {
                    $test[] = [
                        'title' => $school->title,
                        'address' => $school->address,
                    ];
                }
            }

            return $test;
        }
    }

    private function getClearAddress($input_address) {
        $address = explode(' ', $input_address);
        preg_match_all('!\d+!', $address[0], $digits);
        if (count($digits[0]) > 0) {
            array_shift($address);
        }
        $splitted_address = [];


        foreach ($address as $el) {
            $el = str_replace([',', '.'], ' ', $el);
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
