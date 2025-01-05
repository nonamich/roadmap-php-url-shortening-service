<?php

namespace App\Http\Requests\Link;

use App\Rules\NotContainsAppUrl;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseLinkRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'url' => [
                'required',
                'string',
                'url:http,https',
                'active_url',
                new NotContainsAppUrl,
            ],
        ];
    }
}
