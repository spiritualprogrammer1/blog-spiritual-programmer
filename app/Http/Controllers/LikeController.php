<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Like;
use App\Model\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }

    public function LiketIt(Reply $reply)
    {
        $reply->like()->create([
            'user_id'=> auth()->user()->id,

        ]);

        /*******broadcasting******/
        broadcast(new LikeEvent($reply->id,1))->toOthers();
    }
    public function unLiketIt(Reply $reply)
    {
        $reply->like()->where('user_id',auth()->id())->first()->delete();

        broadcast(new LikeEvent($reply->id,0))->toOthers();

      //  $reply->like()->where('user_id','1')->first()->delete();

    }
}
