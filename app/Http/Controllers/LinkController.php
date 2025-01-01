<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LinkController extends Controller
{
    public const LINK_RULES = [
        'link' => ['required', 'string', 'url:http,https', 'active_url'],
    ];

    public function update(Request $request, Link $link)
    {
        Gate::authorize('only-link-owner', $link);

        $request->validate(static::LINK_RULES);

        $link->link = $request->input('link');

        $link->saveOrFail();

        return redirect()
            ->back()
            ->with('message', 'The link has been updated successfully');
        ;
    }

    public function create(Request $request)
    {
        $request->validate(static::LINK_RULES);

        $link = Link::create([
            'link' => $request->input('link'),
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

        return redirect($link->link);
    }

    public function edit(Link $link)
    {
        return view('pages.single-link.edit', [
            'link' => $link,
        ]);
    }
}
