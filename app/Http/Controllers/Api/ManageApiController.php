<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EnquieryMail;
use App\Mail\HrConsultancyMail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ManageApiController extends Controller
{
    public function Enquery(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required',
                'category' => 'required|string',
                'service' => 'required|string',
                'message' => 'required|string',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => $validate->errors(),
                    'status' => false,
                ], 422);
            }
            $data = $validate->validate();
            Mail::to('officewedotgroup@gmail.com')->send(new EnquieryMail($data));

            return response()->json([
                'message' => 'Thanks for you connected with me',
                'status' => true,
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
                'status' => false,
            ], 500);
        }

    }

    public function HrConsulation(Request $request)
    {
        try {

            $validate = Validator::make($request->all(), [
                'companyName' => 'required|string|max:255',
                'contactPerson' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'jobTitle' => 'required|string|max:255',
                'jobLocation' => 'required|string|max:255',
                'employmentType' => 'required|string|max:100',
                'experience' => 'required|string|max:100',
                'salaryRange' => 'required|string|max:100',
                'department' => 'required|string|max:255',
                'jobDescription' => 'required|string',
                'skills' => 'required|string',
                'qualifications' => 'required|string',

                // Files
                'supporting_files' => 'nullable|array',
                'supporting_files.*' => 'file|max:10240',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => $validate->errors(),
                    'status' => false,
                ], 422);
            }

            $hrdata = $validate->validated();

            $files = $request->file('supporting_files', []);

            Mail::to('officewedotgroup@gmail.com')
                ->send(new HrConsultancyMail($hrdata, $files));

            return response()->json([
                'message' => 'HR consultation submitted successfully.',
                'status' => true,
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Something went wrong',
                'status' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function SingUp(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|min:3',
                'email' => 'required|string|email',
                'phone' => 'required|string',
                'password' => 'required|min:6|confirmed',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'status' => false,
                    'error' => $validate->errors(),
                ], 500);
            }

            $check = User::where('email', $request->email)->first();
            if ($check) {
                return response()->json([
                    'message' => 'Use Already Exist',
                    'status' => false,
                ], 500);
            }
            $data = $validate->validate();
            $data['password'] = Hash::make($data['password']);
            $createUser = User::create($validate->validate());
            if ($createUser) {
                return response()->json([
                    'message' => 'User Registre SuccessFull',
                    'status' => true,
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'message' => 'Registration Failde',
                    'status' => false,
                    'data' => [],
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'status' => false,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ], 400);
        }

    }

    public function SingIn(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:6|confirmed',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'status' => false,
                    'error' => $validate->errors(),
                ], 500);
            }
            $data = $validate->validate();

            $user = User::where('email', $data['email'])->first();

            if (! $user) {
                return response()->json([
                    'message' => 'User Not Found',
                    'status' => false,
                ]);
            }

            if ($user->role == 'user') {
                if (Auth::guard('user')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    $user = Auth::guard('user')->user();
                    $token = $user->createToken('user-token')->plainTextToken;

                    return response()->json([
                        'message' => 'User Login Successfully',
                        'token' => $token,
                        'user' => $user,
                        'status' => true,
                    ]);

                } else {
                    return response()->json([
                        'message' => 'Authentication Failed',
                        'status' => false,
                    ]);
                }

            } else {
                return response()->json([
                    'message' => 'Your Role is Incorect',
                    'status' => false,
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }

    }

    public function LogoutUser(Request $request)
{
    try {
        Auth::guard('user')->logout();
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logged Out Successfully',
            'status' => true,
        ], 200);

    } catch (\Exception $e) {

        return response()->json([
            'message' => 'Something went wrong',
            'status' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
}

    
}
