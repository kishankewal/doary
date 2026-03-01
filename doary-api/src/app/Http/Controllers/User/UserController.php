<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller {
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function register(Request $request) {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:6',
                'phoneCountryCode' => 'nullable|string|max:3',
                'phoneNumber' => 'nullable|string|max:15',
            ]);

            $user = $this->userService->register(
                $validated,
                $request->ip()
            );

            return response()->json([
                'message' => 'User registered successfully',
                'data' => [
                    'userId' => $user->id,
                    'email' => $user->email,
                ]
            ], 201);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (Exception $e) {
            $message = sprintf("Error in UserController@register: %s \n Stack : %s", $e->getMessage(), $e->getTraceAsString());
            Log::error($message);

            return response()->json([
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    public function checkEmail(Request $request)
    {
        try {

            $validated = $request->validate([
                'email' => 'required|email|max:255',
            ]);

            $exists = $this->userService
                ->checkEmailExists($validated['email']);

            return response()->json([
                'email' => $validated['email'],
                'exists' => $exists
            ]);

        } catch (Exception $e) {

            return response()->json([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}