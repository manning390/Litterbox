<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUserProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $user->id === Auth::user()->id || $user->hasPermission('manage_profiles'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => 'image|max:2000'
            'color' => 'required|hexcolor',
            'syntax' => 'required|enum:SyntaxType',
            'mentionsEmail' => 'boolean',
            'pmsEmail' => 'boolean',
            'nsfw' => 'boolean',
            'profile' => 'max:1000'
        ];
    }
}
