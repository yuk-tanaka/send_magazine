<?php

namespace App\Http\Requests\WebApi;

use Illuminate\Foundation\Http\FormRequest;

class UploadWysiwygImageRequest extends FormRequest
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
            'file' => ['required', 'image']
        ];
    }
}