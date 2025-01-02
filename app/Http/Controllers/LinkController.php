<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use Illuminate\Support\Facades\Gate;

class LinkController extends Controller
{
    public function update(UpdateLinkRequest $request, Link $link)
    {
        Gate::authorize('only-link-owner', $link);

        $link->url = $request->input('url');

        $link->saveOrFail();

        return redirect()
            ->back()
            ->with('message', 'The link has been updated successfully');

    }

    public function create(StoreLinkRequest $request)
    {
        $link = Link::create([
            'url' => $request->input('url'),
        ]);

        $link->refresh();

        return redirect()->to("/$link->code/edit");
    }

    public function destroy(Link $link)
    {
        Gate::authorize('only-link-owner', $link);

        $link->delete();

        return redirect()->to('/links');
    }

    public function links()
    {
        $links = Link::whereOwner()->get();

        return view('pages.links')->with([
            'links' => $links,
        ]);
    }

    public function redirect(Link $link)
    {
        $link->incrementCount();

        return redirect($link->url);
    }

    public function edit(Link $link)
    {
        return view('pages.single-link.edit', [
            'link' => $link,
        ]);
    }
}
