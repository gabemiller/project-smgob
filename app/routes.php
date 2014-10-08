<?php

/**
 * -----------------------------------------------------------------------------
 * Site
 * -----------------------------------------------------------------------------
 * 
 * A cms-hez tarozó route-ok. 
 * 
 */
/* Route::get('/',function(){   
  return 'Cover page';
  }); */

if (Config::get('app.debug')) {
    Route::get('/phpinfo', function() {
        //echo phpinfo();
        echo App::environment();
    });
}

Route::get('/', ['uses' => 'Site\HomeController@index', 'as' => 'fooldal']);

Route::get('hirek/{id}/{title}', ['uses' => 'Site\ArticleController@show', 'as' => 'hirek.show'])->where('id', '[0-9]+')->where('title', '[0-9A-z_-]+');

Route::get('hirek/cimke/{id}/{tagSlug}', ['uses' => 'Site\ArticleController@tag', 'as' => 'hirek.tag'])->where('id', '[0-9]+')->where('tagSlug', '[0-9A-z_-]+');

Route::get('esemenyek', ['uses' => 'Site\EventController@index', 'as' => 'esemenyek.index']);

Route::get('esemenyek/{id}/{title}', ['uses' => 'Site\EventController@show', 'as' => 'esemenyek.show'])->where('id', '[0-9]+')->where('title', '[0-9A-z_-]+');

Route::get('esemenyek/cimke/{id}/{tagSlug}', ['uses' => 'Site\EventController@tag', 'as' => 'esemenyek.tag'])->where('id', '[0-9]+')->where('tagSlug', '[0-9A-z_-]+');

Route::get('galeriak', ['uses' => 'Site\GalleryController@index', 'as' => 'galeriak.index']);

Route::get('galeriak/{id}/{title}', ['uses' => 'Site\GalleryController@show', 'as' => 'galeriak.show'])->where('id', '[0-9]+')->where('title', '[0-9A-z_-]+');

Route::get('oldal/{id}/{title}', ['uses' => 'Site\PageController@show', 'as' => 'oldalak.show'])->where('id', '[0-9]+')->where('title', '[0-9A-z_-]+');

Route::get('documentumok', ['uses' => 'Site\DocumentController@index', 'as' => 'dokumentumok.index']);
Route::post('documentumok', ['uses' => 'Site\DocumentController@index', 'as' => 'dokumentumok.index']);

/**
 * -----------------------------------------------------------------------------
 * Site menu
 * -----------------------------------------------------------------------------
 * 
 * A cms-hez tarozó menu-k. 
 * 
 */
if (!Request::is('admin') && !Request::is('admin/*')) {

    Menu::make('mainMenu', function($menu) {

        $menu->add('Főoldal', array('route' => 'fooldal'));

        $menu->add('Események', array('route' => 'esemenyek.index'));

        $menu->add('Galériák', array('route' => 'galeriak.index'));
        
        $menu->add('Dokumentumok', array('route' => 'dokumentumok.index'));

        try {
            \Divide\CMS\Page::getPagesForMenu($menu, 0);

            foreach ($menu->all() as $item) {
                if ($item->hasChildren()) {
                    $item->append('<i class="fa fa-bars"></i>');
                }
            }
        } catch (\Exception $e) {
            
        }
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
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin'), function() {

    Route::get('bejelentkezes', ['uses' => 'UsersController@getLogin', 'as' => 'admin.bejelentkezes', 'before' => 'userLoggedIn']);

    Route::post('bejelentkezes', ['uses' => 'UsersController@postLogin', 'as' => 'admin.bejelentkezes']);

    Route::get('kijelentkezes', ['uses' => 'UsersController@getLogout', 'as' => 'admin.kijelentkezes']);
});

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'before' => 'userNotLoggedIn|inGroup:Admin'), function() {

    /**
     * Általános beállításokhoz tartozó route-ok.
     */
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'admin.vezerlopult']);

    Route::resource('oldal', 'PageController');

    Route::resource('hir', 'ArticleController');

    Route::resource('esemeny', 'EventController');
    
    Route::resource('dokumentum', 'DocumentController');
    
    Route::resource('dokumentum-kategoria', 'DocumentCategoryController');

    Route::resource('galeria', 'GalleryController');

    Route::get('galeria/kep/{id}/upload', ['uses' => 'GalleryController@getPicture', 'as' => 'admin.galeria.kep.upload'])->where('id', '[0-9]+');

    Route::post('galeria/kep/save', ['uses' => 'GalleryController@postPicture', 'as' => 'admin.galeria.kep.save']);

    Route::post('galeria/kep/{id}/delete', ['uses' => 'GalleryController@deletePicture', 'as' => 'admin.galeria.kep.delete'])->where('id', '[0-9]+');

    /**
     * Felhasználók kezeléséhez tartozó route-ok.
     */
    Route::group(['prefix' => 'felhasznalok'], function() {
        Route::resource('felhasznalo', 'UsersController');

        Route::post('felhasznalo/{id}/change', ['uses' => 'UsersController@postProfile', 'as' => 'admin.felhasznalok.felhasznalo.change']);

        Route::post('felhasznalo/{id}/password', ['uses' => 'UsersController@postPassword', 'as' => 'admin.felhasznalok.felhasznalo.password']);

        Route::post('felhasznalo/{id}/picture', ['uses' => 'UsersController@postProfilePicture', 'as' => 'admin.felhasznalok.felhasznalo.picture']);

        Route::get('felhasznalo/{id}/picture/delete', ['uses' => 'UsersController@deleteProfilePicture', 'as' => 'admin.felhasznalok.felhasznalo.delete.picture']);

        Route::resource('felhasznalo-csoport', 'GroupsController');
    });
});
