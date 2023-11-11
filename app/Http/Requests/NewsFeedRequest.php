<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class NewsFeedRequest extends FormRequest
{

    //Determine if the user is authorized to make this request.
    public function authorize()
    {
        return true;
    }


    //Get the validation rules that apply to the request.
    public function rules()
    {
        return [
            'title'    => ['required'  , 'string' , 'min:20' , 'max:400'] ,
            'place'    => ['required' , 'string' , 'min:3' , 'max:20'] ,
            'order'    => ['numeric' , 'integer' , 'min:1' , 'between:1,20'],
            'path'     => ['required','string', 'min:10', 'max:100'],
            'newsDate' => ['required']
        ];
    }

     //if there is an error with the validation display the error as a Json response.
     protected function failedValidation(Validator $validator)
     {
         throw new HttpResponseException(response()->json([
             'message' => 'Validation Error',
             'errors' => $validator->errors(),
         ], 422));
     }
}
