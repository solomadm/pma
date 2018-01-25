<?php

namespace App\Http\Controllers\Frontend;

use App\Conference;
use App\Contact;
use App\Content;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactNotification;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class ContactController extends Controller
{

    public function index(Conference $conference)
    {

        return view(
            'frontend.themes.'.$conference->frontend_theme.'.contact',
            [
                'global'    => Content::GetContent('global', $conference),
                'contact'   => Content::GetContent('contact', $conference),
                'countries' => Country::select(['name as value', 'full_name as text'])->get()->toArray(),
            ]
        );
    }


    public function store(ContactRequest $request)
    {
        $data = $request->all();
        if (!empty($data['countries_operate']) && is_array($data['countries_operate'])) {
            $data['countries_operate'] = implode(', ', $data['countries_operate']);
        }
        try {
            $contact = new Contact($data);
            $contact->save();
            \Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactNotification($contact));
        } catch (\Exception $e) {
            \Log::info('ContactController@store: ', [$e->getFile(), $e->getLine(), $e->getMessage()]);

            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }
}
