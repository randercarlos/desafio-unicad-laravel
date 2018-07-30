<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryFormRequest extends FormRequest
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
            'client' => 'required|min:5|max:100',
            'delivery_date' => 'required|min:10|max:10|date_format:d/m/Y|after_or_equal:today',
            'starting_point' => 'required|min:5|max:200',
            'endpoint' => 'required|min:5|max:200',
        ];
    }
}
