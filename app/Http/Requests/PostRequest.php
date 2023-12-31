<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'post.title' => 'required|string|max:100',
            'post.body' => 'required|string|max:4000',
            'post.image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            //'child_name' => 'required|string|max:255',
        ];
    }
}