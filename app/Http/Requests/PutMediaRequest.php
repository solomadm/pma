<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PutMediaRequest extends FormRequest
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
            'title'                => 'required',
            'job_title'            => 'required',
            'first_name'           => 'required',
            'last_name'            => 'required',
            'age_group'            => 'required',
            'nationality'          => 'required',
            'country_of_residence' => 'required',
            'phone_mobile'         => 'required',
            'industry'             => 'required',
//        	'photo' => 'required',
            'email'                => 'required|email',

            'organisation'  => 'required',
            'designation'   => 'required',
            'address1'      => 'required',
            'address2'      => 'required',
            'city'          => 'required',
            'country'       => 'required',
            'po_box'        => 'required',
            'phone_company' => 'required',
            'website'       => 'required',
        ];
    }
}
