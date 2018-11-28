<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebApi\UploadWysiwygImageRequest;

class UploadWysiwygImageController extends Controller
{
    private $path;

    /**
     * UploadWysiwygImageController constructor.
     */
    public function __construct()
    {
        $this->path = config('send_magazine.wysiwyg_image_storage_path');
    }

    /**
     * 外部ストレージ使用する場合は書き換え必要
     * @param UploadWysiwygImageRequest $request
     * @return string
     */
    public function upload(UploadWysiwygImageRequest $request): string
    {
        $path = ($request->file('file')->store($this->path, 'public'));

        return asset('storage/' . $path);
    }
}
