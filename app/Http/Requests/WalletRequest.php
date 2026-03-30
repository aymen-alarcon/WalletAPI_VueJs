<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
                "name" => ["required",'string'],
                "balance" => ["sometimes","required","numeric","min:0"],
                "currency" => ["required","string","max:3"],
        ];
    }

    public function messages(){
        return [
            "name.required" => "Le nom du wallet est obligatoire.",
            "currency.required" => "La devise sélectionnée n'est pas valide.",
        ];
    }
}
