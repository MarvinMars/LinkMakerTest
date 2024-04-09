<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLinkRequest $request)
    {
	    Link::create($request->all());

		return response()->redirectToRoute('links.create');
    }

    /**
     * Redirect to original link
     */
    public function redirect(Request $request, $short_link)
    {
	    if(!$short_link) {
		    abort(404);
	    }

		$link = Link::where('short_link', $short_link)->first();

		if(!$link) {
			abort(404);
		}

		if($link->isExpired() || !$link->hasRedirectAttempts()) {
			abort(404);
		}

	    $link->redirectsDecrement();

        return redirect()->away($link->original_link);
    }
}
