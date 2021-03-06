<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;


class UserController extends Controller
{
    protected $jwt;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $jwt)
    {
        //
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
        $this->jwt = $jwt;
    }

    public function findById($id) {
        $user = User::find($id);
        return response()->json($user);
    }

    public function register(Request $request)
    {
        // Validate data
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        
        $input = $request->only('name', 'email', 'nit', 'password');

        // Register user
        try
        {
            $user = new User; // Create new user instance
            $user->name     = $input['name'];
            $user->nit      = $input['nit'];
            $user->email    = $input['email'];
            $user->password = app('hash')->make($input['password']);
            // Save user
            if ( $user->save() ) {
                $code = 200;
                $output = [
                    'user' => $user,
                    'code' => $code,
                    'message' => 'User created successfully.'
                ];
            } else {
                $code = 500;
                $output = [
                    'code' => $code,
                    'message' => 'An error ocurred while creating user.'
                ];
            }

        } catch (Exception $e) {
            $code = 500;
            $output = [
                'code' => $code,
                'message' => 'An error ocurred while creating user.'
            ];
        }

        
        // Return response
        return response()->json($output, $code);

    }

    public function login(Request $request)
    {
        // Validate data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $input = $request->only('email', 'password');

        if ( ! $authorized = Auth::attempt($input) ) {
            $code = 401;
            $output = [
                'code' => 401,
                'message' => 'User is not authorized.'
            ];
        } else {
            $code = 201;
            $token = $this->respondWithToken($authorized);
            $output = [
                'message' => 'User logged in successfully',
                'userId' => $this->guard()->user()->id,
                'token' => $token,
            ];
        }

        return response()->json($output, $code);

    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Logged Out.']);
    }

    public function refresh()
    {
        return $this->respondWithToken( $this->guard()->refresh() );
    }

    public function guard()
    {
        return Auth::guard();
    }

    public function me() {
        return response()->json( $this->guard()->user() );
    }

    //
}
    