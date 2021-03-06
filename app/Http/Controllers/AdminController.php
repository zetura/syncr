<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
use App\Project;
use App\User;
use App\Role;
use App\Right;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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

    public function clients(){
        return view('admin.clients', ['clients' => Client::all()]);
    }

    public function projects(){
        return view('admin.projects', ['projects' => Project::all()]);
    }

    public function users(){
        $users = User::paginate(10);
        return view('admin.users', ['users' => $users, 'roles' => Role::all()]);
    }

    public function roles(){
        return view('admin.roles', ['roles' => Role::all()]);
    }

    public function rights(){
        return view('admin.rights', ['rights' => Right::all()]);
    }
}
