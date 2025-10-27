<?php

namespace App\Http\Requests;

use App\Models\LeaveType;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplyLeaveRequest extends FormRequest
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
            'leave_type_id' => ['required'],
            'day_type'      => ['required', 'in:half,single,multiple'],
            'shift'         => ['nullable'],
            'start_date'    => ['required', 'date'],
            'end_date'      => ['nullable', 'date', 'after_or_equal:start_date'],
            'reason'        => ['required']
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('end_date', 'required', function ($input) {
            return $input->day_type === 'multiple';
        });
        $validator->sometimes('shift', 'required', function ($input) {
            return $input->day_type === 'half';
        });
    }

    public function messages()
    {
        if ($this->input('day_type') === LeaveType::LEAVE_DAY_TYPE_HALF || $this->input('day_type') === LeaveType::LEAVE_DAY_TYPE_SINGLE) {
            return [
                'start_date.required' => 'The date field is required'
            ];
        } else {
            return ['start_date.required' => 'The start date field is required'];
        }
    }
}
