<?php

namespace App\Services\ImportCSV;

use Exception;

/**
 * バリデーションエラー時に投げる例外
 * Controllerでキャッチして422を返す
 * Class ImportedCSVException
 * @package App\Services\ImportCSV
 */
class ImportedCSVException extends Exception
{

}