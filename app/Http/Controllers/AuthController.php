<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request) {
        try {
            // recuperar info del body
            $name = $request->input('name');
            $password = $request->input('password');
            $email = $request->input('email');

            // validar esa info

            // tratar los datos
            $encryptedPassword = bcrypt($password);

            // guardar esos datos
            $newUser = User::create(
                [
                    "name" => $name,
                    "email" => $email,
                    "password" => $encryptedPassword
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
}
