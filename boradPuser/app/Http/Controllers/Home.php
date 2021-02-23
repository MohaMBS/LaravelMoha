<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewMessageNotification;
use Illuminate\Support\Facades\Auth; 
use App\Models\Message;
class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $oldMessages = Message::where('from', Auth::user()->id)->get();
        $data["user_id"] = Auth::user()->id;
        $data["old_messages"] = $oldMessages;
        return view('facebook', $data);

    }

    public function send(){
        $message = new Message;
        $message->setAttribute('from', Auth::user()->id);
        $message->setAttribute('to', 2);
        $message->setAttribute('message', 'Demo message from user 1 to user 2');
        $message->save();
        event(new NewMessageNotification($message));
        return "done";
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
