<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Immunization;
use App\Post;
use App\Vaccine;
use Session;

class ImmunizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
         $this->validate($request, [
                'p_id' => 'required|max:255|numeric',
                'vaccination_received' => 'required|max:255|date',
                'midwife' => 'required|max:255',
                'vaccine_id' => 'required|numeric|same:expected_vaccine',
                'description' => 'required|max:255',
                'weight' => 'required|max:255|numeric',
                'height' => 'required|max:255|numeric',
        ]);
        $immunizationstatus = new Immunization;

        $immunizationstatus->p_id = $request->p_id;
        $immunizationstatus->vaccination_received = $request->vaccination_received;
        $immunizationstatus->midwife = $request->midwife;
        $immunizationstatus->vaccine_id = $request->vaccine_id;
        $immunizationstatus->description = $request->description;
        $immunizationstatus->weight = $request->weight;
        $immunizationstatus->height = $request->height;

        $immunizationstatus->save();

        Session::flash('success' , 'Successfully Added.');
        return redirect()->route('immunization.show',$immunizationstatus->p_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $immunizationstatus = Immunization::join('vaccines', 'vaccines.id', '=', 'immunizations.vaccine_id')
            ->select('immunizations.*', 'vaccines.name')
            ->where('p_id','=', $id)
            ->get();

        $TookVaccine = Vaccine::whereDoesntHave('users', function($q) use($id) {
         $q->where('posts.id', $id);
        })->get();

        if ($TookVaccine->isEmpty()) {
            echo 'sdfsd';
         }

        $vaccine = Vaccine::all();
        return view('immunization.show')->withPosts($post)
        ->withImmunizationstatuses($immunizationstatus)
        ->withTookvaccines($TookVaccine)->withVaccines($vaccine);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'p_id' => 'required|max:255|numeric',
            'vaccination_received' => 'required|max:255|date',
            'midwife' => 'required|max:255',
            'vaccine_id' => 'required|numeric',
            'description' => 'required|max:255',
            'weight' => 'required|max:255|numeric',
            'height' => 'required|max:255|numeric',
        ]);

        $immunizationstatus = Immunization::find($id);

        $immunizationstatus->vaccination_received = $request->vaccination_received;
        $immunizationstatus->midwife = $request->midwife;
        $immunizationstatus->vaccine_id = $request->vaccine_id;
        $immunizationstatus->description = $request->description;
        $immunizationstatus->weight = $request->weight;
        $immunizationstatus->height = $request->height;


        $immunizationstatus->save();

        Session::flash('success' , 'Changes Successfully saved.');
        return redirect()->route('immunization.show',$immunizationstatus->p_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
