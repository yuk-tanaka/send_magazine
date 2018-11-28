<?php

namespace App\Http\Requests\WebApi;

use Illuminate\Foundation\Http\FormRequest;

class SendMagazineRequest extends FormRequest
{
    use ReturnedErrorToJson;

    /**
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \Exception
     */
    public function rules()
    {
        return [
            'send_at' => ['required', 'date', 'after_or_equal:today'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:10000'],
            'footer' => ['nullable', 'string', 'max:10000'],
            'sends' => ['required', 'array'],
            'sends.*.name' => ['required', 'string', 'max:255'],
            'sends.*.email' => ['required', 'email'],
        ];
    }
}