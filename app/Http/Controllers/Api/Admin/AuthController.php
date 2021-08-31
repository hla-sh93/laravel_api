<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validator;



class AuthController extends Controller
{
    use GeneralTrait;
    //
    public function login(Request $request){

    try{
        // validation
        $rules =[
            'email' => 'required|exists:admin,email',
            'password' => 'required'
        ];
        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){

            $code = $this->returnCodeAccordingToInput($validation);
            return $this->returnValidationError($code, $validation);
        }

        // login
        

        // return token



    }catch(\Exception $ex){
        return $this->ErrMsg($ex->getCode(), $ex->getMessage());

    }





    }




}
