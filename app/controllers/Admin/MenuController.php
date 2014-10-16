<?php

namespace Admin;

use Divide\CMS\Article;
use Divide\CMS\Event;
use Divide\CMS\Gallery;
use Divide\CMS\Menu;
use Divide\CMS\MenuItem;
use Divide\CMS\Page;
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
            ->with('articleTags', Tag::getArray())
            ->with('articles', Article::getArray())
            ->with('eventTags', Tag::getArray())
            ->with('events', Event::getArray())
            ->with('galleries', Gallery::getGalleries())
            ->with('pages', Page::getArray());

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
                    $generatedUrl = '/';
                    break;
                case 'kulso-hivatkozas':
                    $generatedUrl = Input::get('url');
                    break;
                case 'bejegyzesek':
                    if (false) {
                        $generatedUrl = route('hirek.index');
                    } else {
                        $tag = Tag::find(Input::get('tag'));
                        $generatedUrl = route('hirek.tag', array('id' => $tag->id, 'tagSlug' => Str::slug($tag->slug)));
                    }
                    break;
                case 'egy-bejegyzes':
                    $article = Article::find(Input::get('article_id'));
                    $generatedUrl = route('hirek.show',array('id' => $article->id,'title'=>Str::slug($article->title)));
                    break;
                case 'esemenyek':
                    if (false) {
                        $generatedUrl = route('esemenyek.index');
                    } else {
                        $tag = Tag::find(Input::get('tag'));
                        $generatedUrl = route('esemenyek.tag', array('id' => $tag->id, 'tagSlug' => Str::slug($tag->slug)));
                    }
                    break;
                case 'egy-esemeny':
                    $event = Event::find(Input::get('event_id'));
                    $generatedUrl = route('esemenyek.show',array('id' => $event->id,'title'=>Str::slug($event->title)));
                    break;
                case 'galeriak':
                    $generatedUrl = route('galeriak.index');
                    break;
                case 'egy-galeria':
                    $gallery = Gallery::find(Input::get('gallery_id'));
                    $generatedUrl = route('galeriak.show',array('id' => $gallery->id,'title'=>Str::slug($gallery->name)));
                    break;
                case 'egy-oldal':
                    $page = Page::find(Input::get('page_id'));
                    $generatedUrl = route('oldalak.show',array('id' => $page->id,'title'=>Str::slug($page->title)));
                    break;
                case 'dokumentumok':
                    $generatedUrl = route('dokumentumok.index');
                    break;
                default:
                    break;
            }
        }

        $menuItem->url = $generatedUrl;

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