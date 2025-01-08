<?php

namespace App\Http\Controllers;

use App\Http\Requests\Link\DestroyLinkRequest;
use App\Http\Requests\Link\StoreLinkRequest;
use App\Http\Requests\Link\UpdateLinkRequest;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $query = Link::query();

        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->get('sort'), $request->get('direction'));
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $links = $query->paginate(10)->withQueryString();

        return view('pages.links')->with([
            'links' => $links,
        ]);
    }

    public function store(StoreLinkRequest $request)
    {
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

        return $this->response(
            function () use ($link) {
                $link->incrementCount();

                return redirect()->to($link->url);
            },
            function () use ($link) {
                return response()->json($link);
            }
        );
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

    public function destroy(DestroyLinkRequest $request, Link $link)
    {
        $link->forceDelete();

        return $this->response(function () {
            return redirect()->to('/links');
        }, function () use ($link) {
            return response()->json($link);
        });
    }
}
