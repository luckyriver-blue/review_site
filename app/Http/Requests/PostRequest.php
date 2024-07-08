<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'post.disease' => 'nullable|string|max:30',
            'post.star' => 'required',
            'post.body' => 'nullable|string|max:500',
        ];
    }
}
