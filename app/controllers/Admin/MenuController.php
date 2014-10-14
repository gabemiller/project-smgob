<?php

namespace Admin;

use Symfony\Component\Console\Helper\Helper;

class MenuController extends \BaseController{

    protected $layout = '_backend.master';

    /**
     * Display a listing of the resource.
     * GET /admin/menu
     *
     * @return Response
     */
    public function index(){
        View::share('title', 'Oldalak');

        $this->layout->content = View::make('admin.menu.index')->with('menus', Event::all(['id','title','start_at','end_at']));
    }

    /**
     * Show the form for creating a new resource.
     * GET /admin/menu/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /admin/menu
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /admin/menu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * GET /admin/menu/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /admin/menu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /admin/menu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}