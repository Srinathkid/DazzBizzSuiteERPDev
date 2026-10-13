<?php

namespace App\Http\Requests;

use App\Models\Designation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDesignationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $designationId = $this->route('designation');

        if ($designationId instanceof Designation) {
            $designationId = $designationId->id;
        }

        return [

            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('designations', 'name')->ignore($designationId),
            ],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('designations', 'code')->ignore($designationId),
            ],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
