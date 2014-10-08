<?php

namespace Site;

use Divide\CMS\Document;
use Divide\CMS\DocumentCategory;
use Input;
use View;

class DocumentController extends \BaseController
{

    protected $layout = '_frontend.master';

    /**
     * Display a listing of the resource.
     * GET /site\document
     *
     * @return Response
     */
    public function index()
    {
        View::share('title', 'Dokumentumok');

        if (Input::has('category')) {
            $catId = Input::get('category');

            $doc = Document::whereHas('categories', function($q) use($catId)
            {
                $q->where('documentcategory_id', '=', $catId);

            })->get();


        } else {
            $doc = Document::all();
            $catId = 0;
        }

        $this->layout->content = View::make('site.document.index')->with('documents', $doc)->with('categories', DocumentCategory::getCategoriesforPublic())->with('catId',$catId);
    }

}
