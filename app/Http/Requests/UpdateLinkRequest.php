<?php

namespace App\Http\Requests;

class UpdateLinkRequest extends BaseLinkRequest
{
    public function authorize(): bool
    {
        return true;
    }
}
