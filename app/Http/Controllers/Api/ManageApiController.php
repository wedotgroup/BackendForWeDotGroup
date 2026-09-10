<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EnquieryMail;
use App\Mail\HrConsultancyMail;
use Illuminate\Http\Request;
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
           Mail::to('developerabhi2026@gmail.com')->send(new EnquieryMail($data));
            return response()->json([
                'message' => 'Thanks for you connected with me',
                'status' => true,
                'data'=>$data,
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

       
        Mail::to('developerabhi2026@gmail.com')
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


}
