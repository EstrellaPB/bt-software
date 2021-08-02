<?php

namespace publicity\Http\Controllers;

use publicity\Message;
use Illuminate\Http\Request;
use DB;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = DB::table('Messages')
                        ->join('CompanyClients', 'CompanyClients.id', 'Messages.id_company')
                        ->join('CompanyDetails', 'CompanyClients.id', 'CompanyDetails.id_company')
                        ->orderBy('CompanyDetails.is_premium', 'DESC')
                        ->orderBy('Messages.clicked', 'DESC')
                        ->select('Messages.id', 'Messages.urlImage as image', 'Messages.message as message', 'CompanyClients.name as companyName', 'CompanyDetails.is_premium', 'Messages.clicked')
                        ->get();
                        // dd($messages);
       // $messages = Message::all();
        return view('index', compact('messages'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \publicity\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \publicity\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \publicity\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \publicity\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
