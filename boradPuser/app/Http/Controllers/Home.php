<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewMessageNotification;
use App\Events\PublicPost;
use Illuminate\Support\Facades\Auth; 
use App\Models\Message;
use App\Models\Likes;
use App\Models\Comment;
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
        $oldMessages = Message::with("comments")->with("likes")->withCount("likes")->withCount("comments")->Where('to','public' )->orderByDesc('created_at')->get();
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
            $oldMessages = Message::with("comments")->with("likes")->withCount("likes")->withCount("comments")->
            Where('to', $to)->orderByDesc('created_at')->get();
        }else{
            $oldMessages = Message::where('from', Auth::user()->id)->Where('to', $to)->orWhere(function($query) use ($to) {
                $query->where('from', $to)
                        ->Where('to', Auth::user()->id);
            })->get();
        }
        $data["old_messages"] = $oldMessages;
        $data["userName"] = User::All();
        
        return  $data;
    }

    public function send(Request $request){
        
        $message = new Message;
        $request->validate([
            'message' => 'required'
        ]);
        if($request->imagen != "undefined"){
            $request->validate([
                'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg'
            ]);
            $imagenUp = $request->file('imagen');
            $nameimagen = time().$imagenUp->getClientOriginalName();
            $imagenUp->move(public_path().'/img/',$nameimagen);
            $message->setAttribute('imagePath', $nameimagen);
            $resp["img"]=$nameimagen;
        }
        if(Auth::user()->id < $request->input('to')){
            $chanelTo = Auth::user()->id.$request->input('to');
        }else{
            $chanelTo = $request->input('to').Auth::user()->id;
        }
        $message->setAttribute('from', Auth::user()->id);
        $message->setAttribute('to', $request->input('to'));
        $message->setAttribute('message', $request->input('message'));
        $message->save();
        if($request->input('to') == "public"){
            event(new PublicPost($message));
        }else{
            event(new NewMessageNotification($message));  
        }
        //event(new NewMessageNotification($message));
        $data["user_id"] = Auth::user()->id;
        $resp["message_id"]=$message->id;
        return $resp;
    }

    public function comment(Request $request){
        $register = new Comment;
        $register->setAttribute('message_id',Message::find($request->input('idPost'))->id);
        $register->setAttribute('user_id',Auth::user()->id);
        $register->setAttribute('comment',$request->input('comment'));
        $saved = $register->save();
        if(!$saved){
            App::abort(500, 'No se ha guardado.');
        }else{
            return response('Se ha guardado.', 200);
        }
    }

    public function like(Request $request){
        $register = new Likes;
        $register->setAttribute('message_id',Message::find($request->input('idPost'))->id);
        $register->setAttribute('user_id',Auth::user()->id);
        if(!Likes::where("message_id", $request->input('idPost'))->where("user_id", Auth::user()->id)->exists()){
            $saved = $register->save();
            if(!$saved){
                App::abort(500, 'No se ha guardado.');
            }
        }else{
            Likes::where("message_id", $request->input('idPost'))->where("user_id", Auth::user()->id)->delete();
        }

        return response('Se ha guardado.', 200);
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
