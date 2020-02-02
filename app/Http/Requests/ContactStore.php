<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
<<<<<<< HEAD
        return true;
=======
        return фал;
>>>>>>> staging
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['required','min:3','max:100'],
            'phone'=>['required','min:8','max:12'],
            'email'=>['required'],
            'message'=>['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Задължително поле име',
            'name.min' => 'Твърде кратко име',
            'name.max' => 'Твърде дълго име',
            'phone.required'=> 'Задължително поле телефон',
            'phone.min' => 'Твърде кратък номер',
            'phone.max' => 'Твърде дълъг номер',
            'email.required'=> 'Задължително поле email',
            'message.required'=> 'Задължително поле съобщение',
        ];
    }
}
