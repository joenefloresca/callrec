<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use Session;

class ClientController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$client = Client::all();
        return view('clients.index')->with(array('client' => $client));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('clients.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
            'ClientName'  => 'required|unique:clients',
        );

        $validator = Validator::make(Input::all(), $rules);

        // Check if all fields is filled
        if ($validator->fails()) 
        {
            return Redirect::to('client/create')->withErrors($validator);
        }
        else
        {	
        	$client = new Client();
        	$client->ClientName = Input::get("ClientName");
        	if($client->save())
        	{
        		Session::flash('alert-success', 'Client Created Successfully.');
        	}
        	else
        	{
        		Session::flash('alert-success', 'Failed to create client. Please contact administrator.');
        	}

        	return Redirect::to('client/create');
        }

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
