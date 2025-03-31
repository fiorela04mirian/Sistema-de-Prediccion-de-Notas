<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParametroRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
            'fecha' => 'required|date',
        ];

        // Reglas dinámicas para los 3 conjuntos de parámetros del formulario
        for ($i = 1; $i <= 3; $i++) {
            $rules["hora{$i}"] = 'required';
            $rules["ce{$i}"] = 'required|numeric';
            $rules["ph{$i}"] = 'required|numeric';
            $rules["temp_amb{$i}"] = 'required|numeric';
            $rules["temp_sol{$i}"] = 'required|numeric';
        }

        return $rules;
    }
}
