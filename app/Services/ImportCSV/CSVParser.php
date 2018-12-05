<?php

namespace App\Services\ImportCSV;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use SplFileObject;

class CSVParser
{
    /** @var bool */
    private $isValidate = false;
    /** @var null|int */
    private $validateColumnNumber;
    /** @var null|string */
    private $validateString;
    /** @var int */
    private $nameColumnNumber;
    /** @var int */
    private $emailColumnNumber;
    /** @var int 名前最大長 現状バリデーション関係はほぼハードコーディングしている */
    private $maxNameLength = 255;
    /** @var Collection */
    private $parsed;

    public function __construct()
    {
        if (is_int(config('send_magazine.is_send_column_number'))) {
            $this->isValidate = true;
            $this->validateColumnNumber = config('send_magazine.is_send_column_number');
            $this->validateString = config('send_magazine.is_send_validate_string');
        }

        $this->nameColumnNumber = config('send_magazine.name_column_number');
        $this->emailColumnNumber = config('send_magazine.email_column_number');

        $this->parsed = collect([]);
    }

    /**
     * @param UploadedFile $file
     * @return Collection
     * @throws ImportedCSVException
     */
    public function parse(UploadedFile $file): Collection
    {
        foreach ($this->newSplFileObject($file->path()) as $i => $row) {
            if (!$row) {
                continue;
            }

            if (!$this->isSend($row)) {
                continue;
            }

            $this->parsed->push([
                'name' => $this->validateName($row, $i),
                'email' => $this->validateEmail($row, $i),
            ]);
        }

        return $this->parsed;
    }

    /**
     * SJIS→UTF8に変換したデータを作成し、そのデータをもとにSplFileObjectインスタンスを生成する
     * @param string $filePath
     * @return SplFileObject
     */
    private function newSplFileObject(string $filePath)
    {
        //文字コード変換した一時ファイルを作成する（メソッドを分割するとtmpFileが消滅する）
        $data = file_get_contents($filePath);
        $utf = mb_convert_encoding($data, 'UTF-8', 'SJIS-win');
        $temp = tmpfile();
        fwrite($temp, $utf);
        rewind($temp);

        //SplFileObject生成
        $splFileObject = new SplFileObject(stream_get_meta_data($temp)['uri']);
        $splFileObject->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);

        return $splFileObject;
    }

    /**
     * @param array $row
     * @return bool
     * @throws ImportedCSVException
     */
    private function isSend(array $row): bool
    {
        if (!$this->isValidate) {
            return true;
        }

        $str = $this->validateColumn($row, $this->validateColumnNumber, '送信可否判定カラム');

        return $str === $this->validateString;
    }

    /**
     * 帰り値はトリムする
     * @param array $row
     * @param int $number
     * @param string $columnName
     * @return string|int
     * @throws ImportedCSVException
     */
    private function validateColumn(array $row, int $number, string $columnName)
    {
        if (!isset($row[$number])) {
            throw new ImportedCSVException($columnName . 'カラムが存在しない');
        }

        return trim($row[$number]);
    }

    /**
     * @param array $row
     * @param int $i
     * @return string
     * @throws ImportedCSVException
     */
    private function validateName(array $row, int $i): string
    {
        $name = $this->validateColumn($row, $this->nameColumnNumber, '送信先氏名カラム');

        if (!$name) {
            throw new ImportedCSVException('送信先氏名が空欄：' . $i . '行目');
        };

        if (mb_strlen($name) > $this->maxNameLength) {
            throw new ImportedCSVException('送信先氏名の長さが超過：' . $i . '行目');
        }

        return $name;
    }

    /**
     * @param array $row
     * @param int $i
     * @return string
     * @throws ImportedCSVException
     */
    private function validateEmail(array $row, int $i): string
    {
        $email = $this->validateColumn($row, $this->emailColumnNumber, '送信先メールアドレスカラム');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ImportedCSVException('メールアドレスの値が不正：' . $i . '行目');
        };

        return $email;
    }
}