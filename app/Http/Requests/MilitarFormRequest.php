<?php

namespace App\Http\Requests;

use App\Models\Militar;
use Illuminate\Foundation\Http\FormRequest;

class MilitarFormRequest extends FormRequest
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
        // recupera as patentes e as transforma em string através da string ',' para ser usada na validação do "in"
        $patentes = implode(',', Militar::patentes);
        
        return [
            'nome' => 'required|min:5|max:100',
            'data_nascimento' => 'required|min:10|max:10|date_format:d/m/Y|before:18 years ago',
            'servico_militar_obrigatorio' => 'required|boolean',
            'patente' => "required|in:$patentes",
            'identidade' => 'required|max:20'
        ];
    }
}
