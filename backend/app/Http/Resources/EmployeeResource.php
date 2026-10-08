<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_code' => $this->employee_code,

            'first_name' => $this->first_name,
            'last_name' => $this->last_name,

            'email' => $this->email,
            'phone' => $this->phone,

            'date_of_birth' => $this->date_of_birth?->format('Y-m-d'),
            'gender' => $this->gender,

            'date_of_joining' => $this->date_of_joining?->format('Y-m-d'),

            'department_id' => $this->department_id,
            'designation_id' => $this->designation_id,
            'manager_id' => $this->manager_id,

            'employment_type' => $this->employment_type,
            'status' => $this->status,

            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'pincode' => $this->pincode,

            'emergency_contact_name' => $this->emergency_contact_name,
            'emergency_contact_phone' => $this->emergency_contact_phone,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
