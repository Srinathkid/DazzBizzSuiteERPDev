<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_code' => [
                'required',
                'string',
                'max:50',
                'unique:employees,employee_code',
            ],

            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:employees,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'date_of_birth' => [
                'nullable',
                'date',
            ],

            'gender' => [
                'nullable',
                'string',
                Rule::in(['male', 'female', 'other']),
            ],

            'date_of_joining' => [
                'required',
                'date',
            ],

            'department_id' => [
                'nullable',
                'integer',
            ],

            'designation_id' => [
                'nullable',
                'integer',
            ],

            'manager_id' => [
                'nullable',
                'integer',
                'exists:employees,id',
            ],

            'employment_type' => [
                'required',
                'string',
                Rule::in([
                    'full_time',
                    'part_time',
                    'contract',
                    'intern',
                ]),
            ],

            'status' => [
                'required',
                'string',
                Rule::in([
                    'active',
                    'inactive',
                    'resigned',
                    'terminated',
                    'suspended',
                    'on_leave',
                    'on_probation',
                    'on_training',
                ]),
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'state' => [
                'nullable',
                'string',
                'max:100',
            ],

            'pincode' => [
                'nullable',
                'string',
                'max:20',
            ],

            'emergency_contact_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'emergency_contact_phone' => [
                'nullable',
                'string',
                'max:30',
            ],
        ];
    }
}
