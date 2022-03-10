<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\Models\Core\Module;
use App\Models\ContactRequests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use App\Lib\DocumentRepository;

class ContactRequestsController extends Controller
{
    protected $document;

    public function __construct(DocumentRepository $documentRepository)
    {

        $this->middleware(function ($request, $next) {
        
            return $next($request);
        });
        
        $this->document = $documentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Module::find(5));

        $requests = ContactRequest::orderBy('created_at', 'desc')->get();

        return view('admin.pages.requests.listing')->with('requests', $requests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $cr = new ContactRequest();
        $cr->name = $request->name;
        $cr->surname = $request->surname;
        $cr->email = $request->email;
        $cr->phone = isset($request->phone) ? $request->phone : '';
        $cr->message = $request->message;

        

        if (Input::get('g-recaptcha-response') != ""){

            $cr->save();

            //EMAIL THANKS TO USER
            Mail::send('email.out-contact-0', ['cr' => $cr ], function ($m) use ($cr) {
                $m->to($cr->email, $cr->name. " ".$cr->surname)->subject(trans('email.obj-thanks'));
            });

            //EMAIL INTERNA
            Mail::send('email.in-contact-0i', ['cr' => $cr ], function ($m) use ($cr) {
                $m->from('commerciale@celatorito.it','Celato Rito website')->to(config('mail.from.address'), config('mail.from.name'))->subject('Richiesta di contatto');
            });

        }

        return redirect(trans("website.contact"))->with('message', trans('website-text.tks-request'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ContactRequest $cr)
    {
        $this->authorize('view', Module::find(5));

        return view('admin.pages.requests.show')->with('request', $cr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactRequest $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactRequest $cr)
    {
        if(isset($request->response)){
            $cr->response = $request->response;
            $cr->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ContactRequest $cr)
    {

        $cr->delete();

    }

    
    public function uploadFls(ContactRequest $cr)
    {
        $doc = Input::all();
        $response = $this->document->upload($doc, $cr);

        $doc_id = $response->getData()->id;
        
        return $response;
    }

}
