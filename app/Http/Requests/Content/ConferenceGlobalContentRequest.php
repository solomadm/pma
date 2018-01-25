<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class ConferenceGlobalContentRequest extends FormRequest
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
            'primary_color_1'         => 'required',
            'primary_color_2'         => 'required',
            'primary_text_1'          => 'required',
            'primary_text_2'          => 'required',
            'forum_title'             => 'required',
            'forum_date'              => 'required',
            'forum_venue'             => 'required',
            'event_logo'              => 'required',
            'footer_background_image' => 'required',
            'footer_copyright_text'   => 'required',
        ];
    }
}
