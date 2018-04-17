<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            //
	        'name'=>'required|min:5|max:100'
        ];
    }
    public function messages()
    {
	    return [
	    	'name.required'=>"please add category's name",
		    'name.min'=>"Category's name has at least 5 characters ",
		    'name.max'=>"Category's name has most 100 characters "
	    ];
    }
}
