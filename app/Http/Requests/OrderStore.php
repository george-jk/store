<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStore extends FormRequest
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
            'user_id'=>['nullable','exists:users,id'],
            'name'=>['required','min:3','max:255'],
            'family'=>['required','min:3','max:255'],
            'phone'=>['required','min:6','max:12'],
            // 'email'=>['required','email:rfc'],
            'email'=>['required'],
            'address'=>['required','min:3','max:255'],
            'province'=>['required','min:3','max:255'],
            'village'=>['required','min:3','max:255'],
            'subscribe'=>['boolean'],
            'order.*.product_id'=>['required','exists:products,id'],
            'order.*.quantity'=>['required'],
            'order.*.dimension_id'=>['required','exists:dimensions,id'],
        ];
    }
}
