<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Http\Resources\LinkApiResource;
use App\Models\Link;

use Illuminate\Support\Facades\Gate;

class LinkApiController extends Controller
{

    public function update(UpdateLinkRequest $request, Link $link)
    {
        $link->url = $request->input('url');

        $link->saveOrFail();

        return response()->json($link);
    }

    // public function create(StoreLinkRequest $request)
    // {
    //     $link = Link::create([
    //         'url' => $request->input('url'),
    //     ]);

    //     $link->refresh();

    //     return redirect()->to("/$link->code/edit");
    // }

    public function destroy(Link $link)
    {
        $link->delete();

        return response()->json($link);
    }

    // public function links()
    // {
    //     $links = Link::whereOwner()->get();

    //     return view('pages.links')->with([
    //         'links' => $links,
    //     ]);
    // }

    public function show(Link $link)
    {
        return response()->json($link);
    }

    // public function edit(Link $link)
    // {
    //     return view('pages.single-link.edit', [
    //         'link' => $link,
    //     ]);
    // }
}
