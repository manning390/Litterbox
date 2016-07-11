<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreThreadRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100'
            'link' => 'url'
            'nsfw' = 'required|boolean'
            'body' => 'required|max:300',
            'syntax' => 'required|enum:SyntaxType'
        ];
    }
}
