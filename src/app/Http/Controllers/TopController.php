<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view(
            'top.index',
            compact('user')
        );
    }
}
