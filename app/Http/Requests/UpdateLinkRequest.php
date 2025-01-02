<?php

namespace App\Http\Requests;

use App\Models\Link;

class UpdateLinkRequest extends BaseLinkRequest
{

    public function authorize(): bool
    {
        return true;
    }
}
