<?php

namespace App\Services\Magazine;

use App\Eloquents\MagazineLog;
use App\Mail\SentMagazine;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use InvalidArgumentException;
use DB;

class Magazine
{
    /** @var Collection */
    private $sends;

    /** @var MagazineLog */
    private $magazineLog;

    /**
     * Magazine constructor.
     * @param MagazineLog $magazineLog
     */
    public function __construct(MagazineLog $magazineLog)
    {
        $this->sends = collect([]);

        $this->magazineLog = $magazineLog;
    }

    /**
     * @param Collection $sends ['name' => name, 'email' => email]
     * @return Magazine
     */
    public function to(Collection $sends): self
    {
        $this->sends = $sends;

        return $this;
    }

    /**
     * @param Carbon $sendAt
     * @param string $title
     * @param string $description
     * @param string|null $footer
     */
    public function send(Carbon $sendAt, string $title, string $description, ?string $footer): void
    {
        if ($this->sends->isEmpty()) {
            throw new InvalidArgumentException('to()メソッドで送信先のセットが必要');
        }

        foreach ($this->sends as $row) {
            Mail::to($row['email'])
                ->later(
                    $sendAt->gt(now()) ? $sendAt : now(), //過去日付の場合は現在日時で送信
                    new SentMagazine($row['email'], $row['name'], $title, $description, $footer)
                );
        }

        $this->createLog($sendAt, $title, $description, $footer);
    }

    /**
     * insertが万単位になるならキューイング必要
     * @param Carbon $sendAt
     * @param string $title
     * @param string $description
     * @param string|null $footer
     */
    private function createLog(Carbon $sendAt, string $title, string $description, ?string $footer): void
    {
        DB::transaction(function () use ($sendAt, $title, $description, $footer) {
            $magazineLog = $this->magazineLog->create([
                'title' => $title,
                'description' => $description,
                'footer' => $footer,
                'send_at' => $sendAt,
            ]);

            foreach ($this->sends as $row) {
                $magazineLog->magazineUserLogs()->create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                ]);
            }
        });
    }
}