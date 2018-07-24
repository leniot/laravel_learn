<?php

namespace App\Http\Controllers\Admin\Site;

use App\DataTables\OAuthUserDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\OAuthUser;
use Illuminate\Http\Request;

class OAuthUserController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param OAuthUserDataTable $dataTable
     * @return mixed
     */
    public function index(OAuthUserDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('site.oAuthUser.index'));
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
        $oAuthUser = OAuthUser::find($id);
        return view(admin_view_path('site.oAuthUser.edit'))->with([
            'oAuthUser' => $oAuthUser,
        ]);
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
}
