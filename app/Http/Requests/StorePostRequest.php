<?php

namespace App\Http\Requests;

use Post;
use App\Http\Requests\Request;

class StorePostRequest extends Request
{
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
