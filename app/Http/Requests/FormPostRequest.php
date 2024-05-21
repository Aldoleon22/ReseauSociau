<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:8'],
            'slug' => ['required', 'min8', 'regex:/^[0-9a-z\-]+$/', Rule::unique('posts')->ignore($this->route()->parametre('post'))],
            'content' => ['required'],
            'category' => ['required', 'exists:categories,id'],
            'tags' => ['array', 'exist:tags,id', 'required'],
            'image' => ['image', 'max2000']
        ];
    }
}
