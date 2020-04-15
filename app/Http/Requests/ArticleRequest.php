<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *Å
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
            'title' => 'required|max:150|unique:articles,title,',
            'resume' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'visible' => 'required|integer',
            'tags' => 'required',
            'publish_date' => '',
            'image' => 'required|max:5120|mimes:jpg,png,jpeg',
        ];
    }
}
