<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title'      => ['required'],
            'type'       => ['required', 'in:in_house,client'],
            'manager_id' => [],
            'start_date' => ['required'],
            'end_date'   => [],
            'status'     => ['required', 'in:pending,in_progress,completed,on_hold,cancelled'],
        ];
    }
}
