<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRealEstateRequest extends FormRequest
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
        $isLandType = in_array($this->input('real_state_type'), ['land', 'commercial_ground']);
        
        // The 'sometimes' rule means the field is only validated if it's present in the request.
        // This is perfect for PATCH/PUT requests.
        return [
            'name' => 'sometimes|required|string|min:1|max:128',
            'real_state_type' => ['sometimes', 'required', 'string', Rule::in(['house', 'department', 'land', 'commercial_ground'])],
            'street' => 'sometimes|required|string|min:1|max:128',
            'external_number' => 'sometimes|required|string|min:1|max:12|regex:/^[a-zA-Z0-9\-]+$/',
            'internal_number' => [
                'sometimes',
                Rule::requiredIf(in_array($this->input('real_state_type'), ['department', 'commercial_ground'])),
                'nullable',
                'string',
                'max:12',
                'regex:/^[a-zA-Z0-9\-\s]+$/'
            ],
            'neighborhood' => 'sometimes|required|string|min:1|max:128',
            'city' => 'sometimes|required|string|min:1|max:64',
            'country' => 'sometimes|required|string|size:2',
            'rooms' => ['sometimes', 'required', 'integer', $isLandType ? 'size:0' : 'min:1'],
            'bathrooms' => ['sometimes', 'required', 'integer', $isLandType ? 'size:0' : 'min:1'],
            'comments' => 'nullable|string|min:1|max:128',
        ];
    }
}