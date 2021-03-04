<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewMessageNotification;
use App\Events\PublicPost;
use Illuminate\Support\Facades\Auth; 
use App\Models\Message;
use App\Models\User;
class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   /*
        if($request->input('to') !== null){
            $oldMessages = Message::Where('to', $request->input('to'))->orderByDesc('created_at')->get();
        }else{
            $oldMessages = Message::where('from', Auth::user()->id)->orWhere('to', 'public')->orderByDesc('created_at')->get();
        }
        */
        $oldMessages = Message::Where('to','public' )->orderByDesc('created_at')->get();
        $users= User::select('id','name')->where('id','!=',Auth::user()->id)->get();
        $nameOfUser= User::select('name')->where('id',Auth::user()->id)->get();
        $data["user_id"] = Auth::user()->id;
        $data["old_messages"] = $oldMessages;
        $data["users"] = $users;
        $data["nameOfUser"] = $nameOfUser;
        return view('facebook', $data);
    }

    public function indexSelection($to)
    {   
        if($to == "public"){
            $oldMessages = Message::Where('to', $to)->orderByDesc('created_at')->get();
        }else{
            $oldMessages = Message::where('from', Auth::user()->id)->Where('to', $to)->get();
        }
        $data["old_messages"] = $oldMessages;
        $data["userName"] = User::All();
        
        return  $data;
    }

    public function send(Request $request){
        $request->validate([
            'message' => 'required'
        ]);
        $message = new Message;
        $message->setAttribute('from', Auth::user()->id);
        $message->setAttribute('to', $request->input('to'));
        $message->setAttribute('message', $request->input('message'));
        $message->save();
        if($request->input('to') == "public"){
            event(new PublicPost($message));
        }else{
            event(new NewMessageNotification($message));
        }
        
        $data["user_id"] = Auth::user()->id;
        return $this->index();
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
