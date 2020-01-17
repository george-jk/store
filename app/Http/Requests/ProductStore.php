<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStore extends FormRequest
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
            'name'=>['required','min:3','max:255'],
            'manifacture'=>['required','min:2','max:255'],
            'description'=>['required','min:3'],
            'exserpt_description'=>['required','min:3','max:255'],
            'category_id'=>['required','exists:categories,id'],
            'price'=>['required','numeric'],
            'currency'=>['required','max:255'],
            'image_id'=>'required',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'name.required'=> 'Задължително поле',
            'name.min' => 'Твърде кратко име',
            'name.max' => 'Твърде дълго име',
            'manifacture.required' => 'Задължително поле',
            'manifacture.min' => 'Твърде кратко име',
            'manifacture.max' => 'Твърде дълго име',
            'description.required' => 'Задължително поле',
            'description.min' => 'Твърде кратко описание',
            'exserpt_description.required' => 'Задължително поле',
            'exserpt_description.min' => 'Твърде кратко описание',
            'exserpt_description.max' => 'Твърде дълго кратко описание :)',
            'category_id.required' => 'Задължително поле',
            'category_id.exists' => 'Категорията не съществува',
            'price.required' => 'Задължително поле',
            'price.numeric' => 'Използвай само цифри',

        ];
    }
}
