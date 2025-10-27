<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'province' => 'nullable|string|max:20',
            'district' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'joined_date' => 'nullable|date',
            'job_title' => 'nullable|string|max:255',
            'employment_type' => 'nullable|in:full-time,part-time,contract',
            'status' => 'nullable|in:active,inactive',
            'profile_img' => 'nullable|image|max:2048',
        ];
    }
}
