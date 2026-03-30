<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            "receiver_wallet_id" => ["required", "exists:wallets,id"],
            "amount" => ["required", "numeric", "min:0"]
        ];
    }

    public function messages()
    {
        return [
            "receiver_wallet_id.required" => "Le wallet destinataire est obligatoire.",
            "amount.min" => "Le montant doit être supérieur à 0.",
            "receiver_wallet_id.exists" => "Le wallet destinataire est introuvable."
        ];
    }
}