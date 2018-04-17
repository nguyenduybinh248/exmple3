<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostEditRequest extends FormRequest
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
			'title'=>'required',
			'description'=>'required',
			'contents'=>'required',
			'tags'=>'required',

		];
	}

	public function messages()
	{
		return [
			'title.required'=>"please add posts's title",
			'description.required'=>"please add posts's description",
			'contents.required'=>"please add posts's content",
			'tags.required'=>"please add posts's tags",

		];
	}
}
