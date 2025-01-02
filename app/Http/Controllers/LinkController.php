<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::whereOwner()->get();

        return view('pages.links')->with([
            'links' => $links,
        ]);
    }

    public function store(StoreLinkRequest $request)
    {
        $this->authorize('create', Link::class);

        $link = Link::create([
            'url' => $request->input('url'),
        ]);

        $link->refresh();

        return $this->response(function () use ($link) {
            return redirect()->to("/$link->code/edit");
        }, function () use ($link) {
            return response()->json($link);
        });
    }

    public function show(Link $link)
    {
        $this->authorize('view', $link);

        $link->incrementCount();

        return redirect()->to($link->url);
    }

    public function edit(Link $link)
    {
        $this->authorize('update', $link);

        return view('pages.single-link.edit', [
            'link' => $link,
        ]);
    }

    public function update(UpdateLinkRequest $request, Link $link)
    {
        $this->authorize('update', $link);

        $link->url = $request->input('url');

        $link->saveOrFail();

        return $this->response(
            function () {
                return redirect()->back()->with('message', 'The link has been updated successfully');
            },
            function () use ($link) {
                return response()->json($link);
            }
        );

    }

    public function destroy(Link $link)
    {
        $this->authorize('delete', $link);

        $link->forceDelete();

        return $this->response(function () {
            return redirect()->to('/links');
        }, function () use ($link) {
            return response()->json($link);
        });
    }
}
