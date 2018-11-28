<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebApi\ImportCsvRequest;
use App\Http\Requests\WebApi\SendMagazineRequest;
use App\Services\ImportCSV\ImportedCSVException;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use ImportCSV;
use Magazine;

class SendMagazineController extends Controller
{
    /**
     * @return string
     */
    public function footer(): string
    {
        return config('send_magazine.default_footer');
    }

    /**
     * @return Collection
     */
    public function rule(): Collection
    {
        return collect([
            'isValidate' => config('send_magazine.is_send_column_number'),
            'isSendColumnNumber' => config('send_magazine.is_send_column_number'),
            'isSendValidateString' => config('send_magazine.is_send_validate_string'),
            'nameColumnNumber' => config('send_magazine.name_column_number'),
            'emailColumnNumber' => config('send_magazine.email_column_number'),
        ]);
    }

    /**
     * @param ImportCsvRequest $request
     * @return Response
     */
    public function importCsv(ImportCsvRequest $request): Response
    {
        $file = $request->file('file');

        try {

            $import = ImportCSV::import($file);
            info($import);
            return response($import->toJson(), 200);

        } catch (ImportedCSVException $e) {
            info($e);
            return response($e->getMessage(), 422);

        }
    }

    /**
     * @param SendMagazineRequest $request
     * @return Response
     */
    public function send(SendMagazineRequest $request): Response
    {
        $sendAt = Carbon::parse($request->send_at);
        $sends = collect($request->sends);

        Magazine::to($sends)
            ->send($sendAt, $request->title, $request->description, $request->footer);

        return response('success', 200);
    }
}
