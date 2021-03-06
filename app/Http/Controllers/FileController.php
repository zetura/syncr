<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;
use App\Copydeck;
use App\File;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FileController extends Controller
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
    public function create($project_id, $copydeck_id)
    {
        return view('files.create', ['copydeck' => Copydeck::find($copydeck_id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id, $copydeck_id)
    {
        $this->validate($request, [
            'link' => 'required_without:tinycontent',
            'tinycontent' => 'not_with:link',
            'version1' => 'required',
            'version2' => 'required'
        ]);

        // TODO Block previous versions for non-admin

        $version = floatval($request->input('version1').'.'.$request->input('version2'));

        $file = new File;
        $file->link = $request->input('link');
        $file->content = $request->input('tinycontent');
        $file->version = $version;
        $file->user_id = Auth::user()->id;
        Copydeck::find($copydeck_id)->files()->save($file);

        return redirect()->route('copydeck.show', $copydeck_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::find($id);
        return view('files.show', ['file' => $file, 'copydeck' => $file->copydeck]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = File::find($id);
        return view('files.edit', ['file' => $file, 'copydeck' => $file->copydeck]);
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
            'link' => 'required_without:tinycontent',
            'tinycontent' => 'not_with:link'
        ]);

        $file = File::find($id);
        $file->link = $request->input('link');
        $file->content = $request->input('tinycontent');
        $file->user_id = Auth::user()->id;
        $file->save();

        return redirect()->route('copydeck.show', $file->copydeck->id);
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

    /**
     * Compare 2 versions of a file
     *
     * @param $id
     * @param $otherId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function compare($id, $otherId){
        return view('files.comparator', ['file1' => File::find($id), 'file2' => File::find($otherId)]);
    }

    /**
     * Change status of a file
     *
     * @param $id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus($id, $status){
        $file = File::find($id);
        $file->status = $status;
        $file->status_updated_at = Carbon::now();
        $file->save();

        // TODO Send mails to subscribers

        return redirect()->route('copydeck.show', $file->copydeck->id);
    }
}
