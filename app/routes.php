<?php

/**
 * Patterns
 */

Route::pattern('title', '[0-9A-z_-]+');
Route::pattern('id', '[0-9]+');
Route::pattern('tagSlug', '[0-9A-z_-]+');

/**
 * -----------------------------------------------------------------------------
 * Site
 * -----------------------------------------------------------------------------
 *
 * A cms-hez tarozó route-ok.
 *
 */

Route::get('/', ['uses' => 'Site\HomeController@index', 'as' => 'fooldal']);

Route::get('hirek/{id}/{title}', ['uses' => 'Site\ArticleController@show', 'as' => 'hirek.show']);

Route::get('hirek/cimke/{id}/{tagSlug}', ['uses' => 'Site\ArticleController@tag', 'as' => 'hirek.tag']);

Route::get('esemenyek', ['uses' => 'Site\EventController@index', 'as' => 'esemenyek.index']);

Route::get('esemenyek/{id}/{title}', ['uses' => 'Site\EventController@show', 'as' => 'esemenyek.show']);

Route::get('esemenyek/cimke/{id}/{tagSlug}', ['uses' => 'Site\EventController@tag', 'as' => 'esemenyek.tag']);

Route::get('galeriak', ['uses' => 'Site\GalleryController@index', 'as' => 'galeriak.index']);

Route::get('galeriak/{id}/{title}', ['uses' => 'Site\GalleryController@show', 'as' => 'galeriak.show']);

Route::get('oldal/{id}/{title}', ['uses' => 'Site\PageController@show', 'as' => 'oldalak.show']);

Route::match(['GET', 'POST'], 'dokumentumok', ['uses' => 'Site\DocumentController@index', 'as' => 'dokumentumok.index']);

/**
 * -----------------------------------------------------------------------------
 * Site menu
 * -----------------------------------------------------------------------------
 *
 * A cms-hez tarozó menu-k.
 *
 */
if (!Request::is('admin') && !Request::is('admin/*')) {

    Menu::make('mainMenu', function ($menu) {

        $menu->add('Főoldal',
            ['route' => 'fooldal']);

        //$menu->add('Események', array('route' => 'esemenyek.index'));

        //$menu->add('Galériák', array('route' => 'galeriak.index'));

        //$menu->add('Dokumentumok', array('route' => 'dokumentumok.index'));

        try {
            $pages = \Divide\CMS\Page::where('parent', '=', 0)->get();

            foreach ($pages as $page) {
                $menu->add($page->menu, array('route' => 'fooldal'));
            }
        } catch (\Exception $e) {

        }

        /*try {
            \Divide\CMS\Page::getPagesForMenu($menu, 0);

            foreach ($menu->all() as $item) {
                if ($item->hasChildren()) {
                    $item->append('<i class="fa fa-bars"></i>');
                }
            }
        } catch (\Exception $e) {
            
        }*/
    });
}


/**
 * -----------------------------------------------------------------------------
 * Admin
 * -----------------------------------------------------------------------------
 *
 * Az adminisztrációs felülethez tarozó route-ok.
 *
 */
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin'), function () {

    Route::get('bejelentkezes', ['uses' => 'UsersController@getLogin', 'as' => 'admin.bejelentkezes', 'before' => 'userLoggedIn']);

    Route::post('bejelentkezes', ['uses' => 'UsersController@postLogin', 'as' => 'admin.bejelentkezes']);

    Route::get('kijelentkezes', ['uses' => 'UsersController@getLogout', 'as' => 'admin.kijelentkezes']);
});

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'before' => 'userNotLoggedIn|inGroup:Admin'), function () {

    /**
     * Általános beállításokhoz tartozó route-ok.
     */
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'admin.vezerlopult']);

    Route::resource('oldal', 'PageController');

    Route::resource('hir', 'ArticleController');

    Route::resource('esemeny', 'EventController');

    Route::resource('dokumentum', 'DocumentController');

    Route::resource('dokumentum-kategoria', 'DocumentCategoryController');

    Route::resource('menu-kezelo', 'MenuController');

    Route::resource('galeria', 'GalleryController');

    Route::get('galeria/kep/{id}/upload', ['uses' => 'GalleryController@getPicture', 'as' => 'admin.galeria.kep.upload'])->where('id', '[0-9]+');

    Route::post('galeria/kep/save', ['uses' => 'GalleryController@postPicture', 'as' => 'admin.galeria.kep.save']);

    Route::post('galeria/kep/{id}/delete', ['uses' => 'GalleryController@deletePicture', 'as' => 'admin.galeria.kep.delete'])->where('id', '[0-9]+');

    /**
     * Felhasználók kezeléséhez tartozó route-ok.
     */
    Route::group(['prefix' => 'felhasznalok'], function () {
        Route::resource('felhasznalo', 'UsersController');

        Route::post('felhasznalo/{id}/change', ['uses' => 'UsersController@postProfile', 'as' => 'admin.felhasznalok.felhasznalo.change']);

        Route::post('felhasznalo/{id}/password', ['uses' => 'UsersController@postPassword', 'as' => 'admin.felhasznalok.felhasznalo.password']);

        Route::post('felhasznalo/{id}/picture', ['uses' => 'UsersController@postProfilePicture', 'as' => 'admin.felhasznalok.felhasznalo.picture']);

        Route::get('felhasznalo/{id}/picture/delete', ['uses' => 'UsersController@deleteProfilePicture', 'as' => 'admin.felhasznalok.felhasznalo.delete.picture']);

        Route::resource('felhasznalo-csoport', 'GroupsController');
    });
});


/**
 * -----------------------------------------------------------------------------
 * Admin menu
 * -----------------------------------------------------------------------------
 *
 * Az adminfelülethez tarozó menu-k.
 *
 */
if (Request::is('admin') || Request::is('admin/*')) {

    Menu::make('adminMenu', function ($menu) {

        $menu->add('<i class="fa fa-dashboard"></i> Vezérlőpult',
            ['route' => 'admin.vezerlopult']);

        $menu->add('<i class="fa fa-file-text-o"></i> Hírek',
            ['route' => 'admin.hir.index']);

        $menu->add('<i class="fa fa-calendar"></i> Események',
            ['route' => 'admin.esemeny.index']);

        $menu->add('<i class="fa fa-photo"></i> Galéria',
            ['route' => 'admin.galeria.index']);

        $menu->add('<i class="fa fa-book"></i> Dokumentumok',
            ['route' => 'admin.dokumentum.index']);

        $menu->add('<i class="fa fa-book"></i> Dokumentumok kategória',
            ['route' => 'admin.dokumentum-kategoria.create']);

        $menu->add('<i class="fa fa-bars"></i> Menü kezelő',
            ['route' => 'admin.menu-kezelo.create']);

        $menu->add('<i class="fa fa-sitemap"></i> Oldalak',
            ['route' => 'admin.oldal.index']);

        $menu->add('<i class="fa fa-users"></i> Felhasználók',
            ['route' => 'admin.felhasznalok.felhasznalo.index']);


    });
}
