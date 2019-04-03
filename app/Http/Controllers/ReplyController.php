<?php

namespace App\Http\Controllers;


use App\Events\DeleteReplyEvent;
use App\Http\Resources\ReplyResource;
use App\Model\Question;
use App\Model\Reply;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {


    //   return $question->replies;
   // return   new ReplyResource::collection($question->replies);
      //  return Reply::latest()->get();

     return   ReplyResource::collection($question->replies);
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
    public function store(Question $question,Request $request)
    {
        $reply= $question->replies()->create($request->all());
               /******pour faire la notifications******/
        $user = $question->user;

        /*******empecher d enregistrer plusieurs une notification pour une meme categorie d'un utlisateur precis****/
        if($reply->user_id !== $question->user_id)
        {
            $user->notify(new NewReplyNotification($reply));
        }

        return response(['reply'=> new ReplyResource($reply) ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question,Reply $reply)
    {
        return  new ReplyResource($reply)  ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question,Request $request, Reply $reply)
    {
        $reply->update($request->all());
        return response('update',Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question,Reply $reply)
    {
        $reply->delete();

        broadcast(new DeleteReplyEvent($reply->id))->toOthers();

        return response('delete',Response::HTTP_NO_CONTENT);
    }
}
