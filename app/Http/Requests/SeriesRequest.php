<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class SeriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'seasons' => 'required|numeric',
            'episodes' => 'required|numeric',
            //'cover' => [
            //    'required',
            //    File::image()
            //        ->types(['png', 'jpg', 'jpeg'])
            //        ->max(1024)
            //],
        ];
    }

    public function messages()
    {
        return [
            //'name.required' => 'Nome eh obrigatorio'
        ];
    }
}
