<?php

namespace App\Http\Controllers\WebApi;

use App\Eloquents\MagazineLog;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResourceCollections\MagazineLogResourceCollection;

class MagazineLogController extends Controller
{
    /** @var MagazineLog */
    private $magazineLog;

    /**
     * MagazineLogController constructor.
     * @param MagazineLog $magazineLog
     */
    public function __construct(MagazineLog $magazineLog)
    {
        $this->magazineLog = $magazineLog;
    }

    /**
     * @return MagazineLogResourceCollection
     */
    public function get(): MagazineLogResourceCollection
    {
        return new MagazineLogResourceCollection($this->magazineLog->get());
    }

}