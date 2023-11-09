<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BreakingNewsRequest extends FormRequest
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
            'filename' => ['required','image|mimes:jpg,png,jpeg,gif,svg','max:2048'],
            'path'     => ['required','string', 'min:10', 'max:100'],
            'title'     => ['required','string', 'min:15', 'max:100'],
            'description'     => ['required','string', 'min:15', 'max:300'],
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
