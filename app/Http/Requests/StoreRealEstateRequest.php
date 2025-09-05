<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRealEstateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // For this challenge, we'll allow anyone to make requests.
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

        return [
            'name' => 'required|string|min:1|max:128',
            'real_state_type' => ['required', 'string', Rule::in(['house', 'department', 'land', 'commercial_ground'])],
            'street' => 'required|string|min:1|max:128',
            'external_number' => 'required|string|min:1|max:12|regex:/^[a-zA-Z0-9\-]+$/',
            'internal_number' => [
                Rule::requiredIf(in_array($this->input('real_state_type'), ['department', 'commercial_ground'])),
                'nullable',
                'string',
                'max:12',
                'regex:/^[a-zA-Z0-9\-\s]+$/'
            ],
            'neighborhood' => 'required|string|min:1|max:128',
            'city' => 'required|string|min:1|max:64',
            'country' => 'required|string|size:2',
            'rooms' => ['required', 'integer', $isLandType ? 'size:0' : 'min:1'],
            'bathrooms' => ['required', 'integer', $isLandType ? 'size:0' : 'min:1'],
            'comments' => 'nullable|string|min:1|max:128',
        ];
    }
}