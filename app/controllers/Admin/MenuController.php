<?php

namespace Admin;

use Divide\CMS\Menu;
use Divide\CMS\MenuItem;
use Divide\Helper\Tag;
use View;
use Response;
use Exception;
use Input;
use Str;

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
            ->with('types', MenuItem::types())
            ->with('articleTags', MenuItem::types())
            ->with('articles', MenuItem::types())
            ->with('eventTags', MenuItem::types())
            ->with('events', MenuItem::types())
            ->with('galleries', MenuItem::types())
            ->with('pages', MenuItem::types());

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


        if (Input::has('type')) {
            switch (Input::get('type')) {
                case 'fooldal':
                    $menuItem->url = '/';
                    break;
                case 'kulso-hivatkozas':
                    $menuItem->url = Input::get('url');
                    break;
                case 'bejegyzesek':
                    if (false) {
                        $menuItem->url = route('hirek.index');
                    } else {
                        $tags = Tag::find(Input::get('tag'))->select(['id', 'slug']);
                        $menuItem->url = route('hirek.tag', array('id' => $tag->id, 'tagSlug' => Str::slug($tag->slug)));
                    }
                    break;
                case 'egy-bejegyzes':
                    break;
                case 'esemenyek':
                    $tags = Tag::find(Input::get('tag'))->select(['id', 'slug']);
                    $menuItem->url = route('esemenyek.tag', array('id' => $tag->id, 'tagSlug' => Str::slug($tag->slug)));
                    break;
                case 'egy-esemeny':
                    break;
                case 'galeriak':
                    $menuItem->url = route('galeriak.index');
                    break;
                case 'egy-galeria':
                    $menuItem->url = route('galeriak.show');
                    break;
                case 'egy-oldal':
                    $menuItem->url = route('oldalak.show');
                    break;
                case 'dokumentumok':
                    $menuItem->url = route('dokumentumok.index');
                    break;
                default:
                    break;
            }
        }

        dd($menuItem);
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