<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boxs;

class BoxsController extends Controller
{
    public function liste(){
        
        $iduser=Auth()->id();
        
        $boxs = Boxs::where('user_id',$iduser)->get();

        return view('boxs.index',['boxs'=>$boxs]);
    }


}
