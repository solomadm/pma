<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditConferenceRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
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
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:conferences',
            'admin_theme' => 'required',
            'frontend_theme' => 'required',
            'url_slug' => 'required|unique:conferences',
        ];
    }
}
