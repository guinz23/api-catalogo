<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Validator;

class ResgisterController extends BaseController
{
    public $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        if (Self::ValidateRequest($request)->fails()) {
            return $this->sendError('Validation Error.', Self::ValidateRequest($request)->errors());
        }
        $input = $request->all();
        $success['data'] = $this->authService->register($input);
        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {
        if ($this->authService->login($request) !== "") {
            return $this->sendResponse($this->authService->login($request), 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    private function ValidateRequest($request)
    {
        if($request->get("id")){
            $validator = Validator::Make($request->all(), [
                'name' => 'required',
                'lastname' => 'required',
                'rol' => 'required',
                'phoneNumber' => 'required',
                'state' => 'required',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);
            return $validator;
        }else{
            $validator = Validator::Make($request->all(), [
                'name' => 'required',
                'lastname' => 'required',
                'rol' => 'required',
                'phoneNumber' => 'required',
                'state' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);
            return $validator;
        }
       
    }
}
