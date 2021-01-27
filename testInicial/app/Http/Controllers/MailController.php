<?php
namespace App\Http\Controllers; 
use Mail;
use Illuminate\Http\Request;
use App\Mail\CloudHostingProduct;
class MailController extends Controller{    
    public function mail(){
        $name = 'Cuerpo del mensaje.';      
        Mail::to('mohamoha144@gmail.com')->send(new CloudHostingProduct($name));         
        return 'Email sent Successfully';    
    }
}

?>
