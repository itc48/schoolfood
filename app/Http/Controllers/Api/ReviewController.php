<?php

namespace App\Http\Controllers\Api;

use App\Builders\ReviewBuilder;
use App\Builders\ReviewLogBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReviewRequest;
use App\Repositories\ReviewRepository;
use App\Repositories\SchoolRepository;
use App\Traits\CoordinatesDistance;

class ReviewController extends Controller {

    use CoordinatesDistance;

    protected $builder;

    protected $log_builder;

    protected $repository;

    protected $school_repository;

    public function __construct() {
        $this->builder = new ReviewBuilder();
        $this->log_builder = new ReviewLogBuilder();
        $this->repository = new ReviewRepository();
        $this->school_repository = new SchoolRepository();
    }

    public function store(CreateReviewRequest $request) {
        $this->log_builder
            ->createEmpty()
            ->setFingerprint($request->uuid)
            ->setLongitude($request->longitude)
            ->setLatitude($request->latitude);

        $last_review = $this->repository->getLastByFingerprint($request->fingerprint);
        $school = $this->school_repository->getByUuidForAdmin($request->uuid);

        if ($request->longitude && $request->latitude) {
            $distance = $this->getDistance($school->latitude, $school->longitude, $request->latitude, $request->longitude);

            if ($distance > 500) {
                $this->log_builder->save();
                return response('Ошибка! Вы находитесь за пределом радиуса школы!', 400);
            }
        } else {
            $this->log_builder->save();
            return response('Ошибка! Вы находитесь за пределом радиуса школы!', 400);
        }

        if (!$last_review) {
            $this->builder
                ->createEmpty()
                ->setSchoolUuid($request->uuid)
                ->setFingerprint($request->fingerprint)
                ->setScore($request->score)
                ->setFile($request->file);

            if ($request->score < 0) {
                $this->builder
                    ->setText($request->text);
            }

            $this->builder->save();

            $this->log_builder
                ->setReviewUuid($this->builder->getModel()->uuid)
                ->save();

            return response('Спасибо! Ваш голос принят!', 400);
        } else {
            $this->log_builder->save();
            return response('Ошибка! Вы уже голосовали сегодня! Попробуйте ещё раз через 24 часа.', 400);
        }
    }
}
