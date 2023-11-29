<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            // validar la data del user
            $validator = $this->validateDataUser($request);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Error registering user",
                        "error" => $validator->errors()
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

            // // recuperar info del body
            // $name = $request->input('name');
            // $password = $request->input('password');
            // $email = $request->input('email');

            // // tratar los datos
            // $encryptedPassword = bcrypt($password);

            // guardar esos datos
            $newUser = User::create(
                [
                    "name" => $request->input('name'),
                    "email" => $request->input('email'),
                    "password" => bcrypt($request->input('password'))
                ]
            );

            // enviar email de bienvenida

            // Devolver una respueta
            return response()->json(
                [
                    "success" => true,
                    "message" => "user registered",
                    "data" => $newUser
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering user"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    private function validateDataUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|max:12',
        ]);

        return $validator;
    }

    public function login(Request $request)
    {
        try {
            // validar email
            $validator = Validator::make($request->all(), [
                'email' => 'required | email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Error login user",
                        "error" => $validator->errors()
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

            //recuperar data user login

            $email = $request->input('email');
            $password = $request->input('password');

            $user = User::query()->where('email', $email)->first();
            
            // Validamos si el usuario existe
            if (!$user) {
                return response(
                    [
                        "success" => false, 
                        "message" => "Email or password are invalid 1"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            // Validamos la contraseña
            if (!Hash::check($password, $user->password)) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password are invalid 2"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            // creamos token
            $token = $user->createToken('apiToken')->plainTextToken;

            // devolver la info con el token
            return response()->json(
                [
                    "success" => true,
                    "message" => "User Logged",
                    "token" => $token,
                    "data" => $user
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error login user"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
