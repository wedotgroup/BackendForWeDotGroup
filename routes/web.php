<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/test-mail', function () {
    try {
        Mail::raw('Laravel SMTP test successful.', function ($message) {
            $message->to('developerabhi2026@gmail.com')
                ->subject('Laravel SMTP Test');
        });

        return response()->json([
            'status' => true,
            'message' => 'Mail sent successfully',
        ]);

    } catch (Throwable $e) {

        return response()->json([
            'status' => false,
            'message' => 'Mail failed',
            'error' => $e->getMessage(),
        ], 500);
    }
});
