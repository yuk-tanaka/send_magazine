<?php

namespace App\Services\ImportCSV;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class ImportCSV
{
    /** @var CSVParser */
    private $csvParser;

    /**
     * ImportCSV constructor.
     * @param CSVParser $csvParser
     */
    public function __construct(CSVParser $csvParser)
    {
        $this->csvParser = $csvParser;
    }

    /**
     * @param UploadedFile $file
     * @return Collection
     * @throws ImportedCSVException
     */
    public function import(UploadedFile $file): Collection
    {
        return $this->csvParser->parse($file);
    }
}