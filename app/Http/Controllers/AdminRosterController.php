<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \App\Models\Roster;
use \App\Models\Role;

//Controlador para la gestion de los roster de los trabajadores

class AdminRosterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $rosters = Roster::all();
        return view("admin.rosters.index", compact("rosters"));          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->authorizeRoles(['user', 'administrador']);
        return view('admin.rosters.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['user', 'administrador']);
        $roster = new Roster;        
        $roster ->name = $request->name;        
        $roster->save();

        return redirect("/admin/rosters");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Auth::user()->authorizeRoles(['user', 'administrador']);
        $roster = Roster::findOrFail($id);
        return view("admin.rosters.view", compact("roster"));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->authorizeRoles(['user', 'administrador']);
        $roster = Roster::findOrFail($id);
        return view("admin.rosters.edit", compact("roster")); 
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
        Auth::user()->authorizeRoles(['user', 'administrador']);
        $roster = Roster::findOrFail($id);        
        $roster ->name = $request->name;
        
        $roster->update();
      
        return redirect("/admin/rosters");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        Auth::user()->authorizeRoles(['user', 'administrador']);
        $roster = Roster::findOrFail($id);
        $roster ->delete();        
    }
}
