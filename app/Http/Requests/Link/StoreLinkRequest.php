<?php

namespace App\Http\Requests\Link;

use App\Models\Link;
use Illuminate\Support\Facades\Gate;

class StoreLinkRequest extends BaseLinkRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create', Link::class);
    }
}
