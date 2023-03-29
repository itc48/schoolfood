<?php

namespace App\Builders;


use App\Models\Review;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;


class ReviewBuilder extends CoreBuilder {

    public function createEmpty(): CoreBuilder {
        $this->model = new Review();

        return $this;
    }

    public function setSchoolUuid($uuid): CoreBuilder {
        try {
            $this->model->school_uuid = $uuid;

            return $this;
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function setFile(UploadedFile $file = null): CoreBuilder {
        if ($file) {

            if (!Storage::disk('public')->exists('/files/')) {
                Storage::disk('public')->makeDirectory('/files/');
            }

            if (!Storage::disk('public')->exists('/files_preview/')) {
                Storage::disk('public')->makeDirectory('/files_preview/');
            }

            $file_name = Str::random(32) . "." . $file->extension();

            $this->model->file = $file_name;

            Storage::disk('public')->putFileAs('/files/', $file, $file_name);

            $img = Image::make(storage_path("app/public/files/$file_name"));

            $img->resize(140, 140, function ($const) {
                $const->aspectRatio();
            })->save(storage_path("app/public/files_preview/$file_name"));
        }

        return $this;
    }

}