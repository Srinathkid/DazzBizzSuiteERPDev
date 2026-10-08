<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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

        $employeeId = $this->route('employee');

        return [
            'employee_code' => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('employees', 'employee_code')
                    ->ignore($employeeId),
            ],

            'first_name' => [
                'sometimes',
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
                Rule::unique('employees', 'email')
                    ->ignore($employeeId),
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
                'sometimes',
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
                'different:employee',
            ],

            'employment_type' => [
                'sometimes',
                'string',
                Rule::in([
                    'full_time',
                    'part_time',
                    'contract',
                    'intern',
                ]),
            ],

            'status' => [
                'sometimes',
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
