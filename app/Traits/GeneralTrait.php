<?php

namespace App\Traits;

trait GeneralTrait {

    // <!-- get current language -->
    public function getCurrentLang(){
        return app()->getLocale();
    }

    // <!-- Error Message -->
    public function ErrMsg($errNum='',$msg=''){
        return response()->json([
            'status' => false,
            'errorNum' => $errNum,
            'message' => $msg
            ]);
    }

    // <!-- Success Message -->
    public function SuccessMsg($errNum='',$msg=''){
    return response()->json([
        'status' => true,
        'errorNum' => $errNum,
        'message' => $msg
        ]);
    }

    // <!-- Return Data -->
    public function ReturnData($key, $value ,$msg=''){
    return response()->json([
        'status' => true,
        'errorNum' => '200',
        'message' => $msg,
        $key => $value
        ]);
    }

    // 
    public function returnCodeAccordingToInput($validator){
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input){
        if($input == "name") return 'E0011';
        else if($input == "password") return 'E0002';
        else if($input == "email") return 'E0003';
    }

    public function returnValidationError($code , $validator){
        return $this->ErrMsg($code, $validator->errors()->first());
    }
}