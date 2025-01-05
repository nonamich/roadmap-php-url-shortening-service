<?php

namespace App\Http\Requests\Link;

use Illuminate\Support\Facades\Gate;

class StoreLinkRequest extends BaseLinkRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $link = $this->route('link');

        return Gate::allows('create', $link);
    }
}
