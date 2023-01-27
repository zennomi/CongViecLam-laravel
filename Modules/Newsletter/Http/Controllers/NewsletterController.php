<?php

namespace Modules\Newsletter\Http\Controllers;

// use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Newsletter\Entities\Email;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;
use Modules\Newsletter\Emails\NewsletterMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ViewErrorBag;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:emails,email'
        ]);
        Email::create(['email' => $request->email]);
        flashSuccess('Your subscription added successfully!');

        return back();
    }

    public function sendMail()
    {
        abort_if(!userCan('newsletter.sendmail'), 403);

        $data['emails'] = Email::get();
        return view('newsletter::send-mail', $data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        abort_if(!userCan('newsletter.view'), 403);

        $data['emails'] = Email::latest()->paginate(20);
        return view('newsletter::index', $data);
    }

    public function destroy(Email $email)
    {
        $deleted = $email->delete();
        $deleted ? flashSuccess('Email Deleted Successfully') : flashError();
        return back();
    }

    public function submitMail(Request $request)
    {
        abort_if(!userCan('newsletter.sendmail'), 403);

        $request->validate([
            'emails' => 'required',
            'subject' => 'required',
            'body' => 'required'
        ]);

        $arrayEmails = $request->emails;
        $emailSubject = $request->subject;
        $emailBody = $request->body;

        foreach ($arrayEmails as $email) {
            Mail::to($email)->send(new NewsletterMail($emailSubject, $emailBody));
        };

        flashSuccess('Mail Sent Successfully');
        return back();
    }
}
