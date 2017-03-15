<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactType;
use App\Repositories\ContactRepository as Repo;
use Cache;
use Caffeinated\Themes\Facades\Theme;
use Illuminate\Support\Facades\Input;
use Redirect;
use Request;
use Session;

class ContactController extends Controller
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $contactTypeList =  Cache::remember('contactTypeList', 1000, function() {
            return ContactType::contacctTypeList();
        });

        return Theme::view('frontend.contact',compact('contactTypeList'));
    }

    public function store(Request $request)
    {
        $input = Input::all();

        $v = Contact::validate($input);

        if ($v->fails()) {
            return Redirect::back()
                ->withErrors($v)
                ->withInput($input);
        }

        $result = $this->repo->create([
                'full_name' => strip_tags($input['full_name']),
                'subject' => strip_tags($input['subject']),
                'email' => strip_tags($input['email']),
                'phone' => strip_tags($input['phone']),
                'content' => strip_tags($input['content']),
                'is_read' => 0,
                'IP' => Request::ip(),
                'status' => 0
            ]);


        if ($result) {
            Session::flash('success_messages', trans('contact.your_message_posted'));
            return Redirect::route('contact-index');
        } else {
            return Redirect::back()
                ->withErrors(trans('common.save_failed'))
                ->withInput($input);
        }

    }

}
