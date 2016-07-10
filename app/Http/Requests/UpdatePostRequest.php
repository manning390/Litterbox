<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePostRequest extends Request
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
            'thread_id' => 'required|exists:threads',
            'parent_id' => 'exists:posts',
            'body' => 'required|max:300',
            'syntax' => 'required|enum:SyntaxType'
        ];
    }
}
