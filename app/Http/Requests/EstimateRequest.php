<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimateRequest extends FormRequest
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
            'client_id'     => 'required|exists:clients,id',
            'employee_id'   => 'required|exists:employees,id',
            'description'   => 'required|min:3|max:10000',
            'value'         => "regex:/^\d+(\.\d{1,2})?$/",
        ];
    }
}
