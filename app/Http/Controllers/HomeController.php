<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home');
    }

    public function contact(ContactRequest $request): JsonResponse|RedirectResponse
    {
        $payload = $request->validated();
        $message = 'Thank you. Your message has been received.';

        try {
            Mail::to(config('mail.contact_to'))
                ->send(new ContactFormMail($payload));
        } catch (Throwable $exception) {
            report($exception);

            $error = 'Unable to send your message right now. Please try again later.';

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $error,
                ], 500);
            }

            return back()->withErrors(['contact' => $error])->withInput();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return back()->with('contact_status', $message);
    }
}
