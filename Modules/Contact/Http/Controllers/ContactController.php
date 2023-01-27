<?php

namespace Modules\Contact\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Contact\Entities\Contact;
use Illuminate\Contracts\Support\Renderable;
use Modules\Contact\Repositories\ContactRepositories;
use Modules\Contact\Notifications\ContactNotification;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!userCan('contact.view'), 403);

        $contacts = Contact::all();
        return view('contact::index', compact('contacts'));
    }




    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|min:3",
            'email' => "required",
            'subject' => "required|min:5",
            'message' => "required|min:10",
        ]);

        $contact = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        if (checkMailConfig()) {
            Admin::all()->each(function ($admin) use ($contact) {
                $admin->notify(new ContactNotification($contact));
            });
        }

        flashSuccess('Contact message sent Successfully');
        return back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        if (!enableModule('contact')) {
            abort(404);
        }
        $contact = Contact::find($id);

        return [
            'name' => $contact->name,
            'email' => $contact->email,
            'message' => $contact->message,
        ];
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        session()->flash('success', 'Contact Deleted Successfully!');
        return back();
    }

    /**
     * Remove multiple resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
}
