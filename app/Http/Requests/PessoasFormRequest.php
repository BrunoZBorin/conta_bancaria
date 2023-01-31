<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoasFormRequest extends FormRequest
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
    public function getValidatorInstance()
    {
        $this->cleanCPF();
        return parent::getValidatorInstance();
    }

    protected function cleanCPF()
    {
        if ($this->request->has('cpf')) {
            $this->merge([
                'cpf' => str_replace(['-', '.', ' '], '', $this->request->get('cpf'))
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'=>['required','min:3'],
            'cpf'=>['required','min:11', 'max:11']
        ];
    }

    public function messages()
    {
        return [
            'nome.*' => 'O campo nome é obrigatório e deve conter ao menos 3 caracteres',
            'cpf.*' => 'O campo CPF deve conter 11 caracteres'
        ];
    }
}
