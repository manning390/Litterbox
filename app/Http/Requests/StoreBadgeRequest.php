<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreBadgeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $user->can('manage_badges');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|alpha_dash',
            'image' => 'required|image|max:500'
        ];
    }
}
