<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class ClientController extends Controller
{

    public function __construct()
    {
        if (!session('clients')) {
            session(['clients' => $this->createClients()]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.index')->with('clients', session('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = [
            'name' => 'required|max:20',
            'age' => 'required|numeric|between:18,50'
        ];

        $request->validate($rules);
        
        $clients = session('clients');
        $lastId = 0;
        if($clients){
            $lastIndex = count($clients) - 1;
            $lastId = $clients[$lastIndex]->id;
        }
        $c = new stdClass;
        $c->id = $lastId + 1;
        $c->name = $request->input('name');
        $c->age = $request->input('age');
        $clients[] = $c;
        session(['clients' => $clients]);
        return view('client.index')->with('clients', $clients);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clients = session('clients');
        $obj = $this->arrayFind($clients, $id);
        if($obj){
            return view('client.show')->with('client', $obj);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = session('clients');
        $c = $this->arrayFind($clients, $id);
        return view('client.update')->with('client', $c);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clients = session('clients');
        $i = $this->arraySearch($clients, 'id', $id);
        $clients[$i]->name = $request->input('name');
        $clients[$i]->age = $request->input('age');

        session(['clients' => $clients]);
        return view('client.index')->with('clients', $clients);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clients = session('clients');
        $i = $this->arraySearch($clients, 'id', $id);        
        if($i >= 0){
            unset($clients[$i]);
            $clients = array_values($clients);
            session(['clients' => $clients]);

        }
        return view('client.index')->with('clients', session('clients'));
    }

    public function createClients()
    {
        $clients = [];

        $client = new stdClass;
        $client->id = 1;
        $client->name = 'Luke Skywalker';
        $client->age = 40;
        $clients[] = $client;

        $client = new stdClass;
        $client->id = 2;
        $client->name = 'Lea Organa';
        $client->age = 40;
        $clients[] = $client;

        return $clients;
    }

    private function arrayFind(array $array, int $id)
    {
        if ($array) {
            foreach ($array as $obj) {
                if ($obj->id == $id)
                    return $obj;
            }
            return null;
        }
    }

    private function arraySearch(array $array, string $key, int $search)
    {
        if($array){
            for($i = 0; $i <= count($array) - 1; $i++){
                if($array[$i]->$key == $search){
                    return $i;
                }
            }
            return -1;
        }
    }

}
