<?php

namespace Admin;

use Divide\CMS\Menu;
use Divide\CMS\MenuItem;
use View;
use Response;
use Exception;
use Input;

class MenuController extends \BaseController
{

    protected $layout = '_backend.master';

    /**
     * Show the form for creating a new resource.
     * GET /admin/menu/create
     *
     * @return Response
     */
    public function create()
    {
        View::share('title', 'Menüpontok');

        $this->layout->content = View::make('admin.menu.create')
            ->with('menuItems', MenuItem::all())
            ->with('menus', Menu::getMenus())
            ->with('parents', MenuItem::getMenuItems())
            ->with('types', MenuItem::types());
    }

    /**
     * Store a newly created resource in storage.
     * POST /admin/menu
     *
     * @return Response
     */
    public function store()
    {
        $menuItem = new MenuItem();

        dd(Input::all());
        if (Input::has('type')) {
            switch (Input::get('type')) {
                case 1:
                    $menuItem->url = '/';
                    break;
                case 2:
                    $menuItem->url = Input::get('url');
                    break;
                case 3:
                    break;
                case 4:
                    break;
                case 5:
                    break;
                case 6:
                    break;
                case 7:
                    break;
                case 8:
                    break;
                case 9:
                    break;
            }
        }
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