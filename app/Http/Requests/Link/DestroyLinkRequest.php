<?php

namespace App\Http\Requests\Link;

use Illuminate\Support\Facades\Gate;

class DestroyLinkRequest extends BaseLinkRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $link = $this->route('link');

        return Gate::allows('delete', $link);
    }
}
