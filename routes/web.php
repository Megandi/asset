<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['web'] ], function () {

  Route::group(['middleware' => ['auth'] ], function () {
    Route::get('dashboard', 'manajemenAsset\manajemenAssetController@dashboard');
    Route::get('/', 'manajemenAsset\manajemenAssetController@dashboard');

    Route::group(['middleware' => ['role:1'] ], function () {
      Route::get('list', 'manajemenAsset\ListController@index');
      Route::get('list/asset/{id}', 'manajemenAsset\ListController@detail');
      Route::post('list/asset/{id}/search', 'manajemenAsset\ListController@search');
      Route::get('list/asset/detail/{id}', 'manajemenAsset\ListController@detailAsset');
      Route::post('list/asset/detail/post', 'manajemenAsset\ListController@update');
    });

    Route::group(['middleware' => ['role:2'] ], function () {
      Route::get('manajemenasset', 'manajemenAsset\manajemenAssetController@index');
      Route::get('manajemenasset/load/peralatan/{id}', 'manajemenAsset\manajemenAssetController@load');
      Route::get('manajemenasset/hapus/{id}', 'manajemenAsset\manajemenAssetController@hapus');

      Route::post('manajemenasset/save', 'manajemenAsset\manajemenAssetController@save');
      Route::get('manajemenasset/tambah', 'manajemenAsset\manajemenAssetController@add');
      Route::get('manajemenasset/edit/{id}', 'manajemenAsset\manajemenAssetController@edit');
      Route::post('manajemenasset/edit/post', 'manajemenAsset\manajemenAssetController@editsave');


      Route::get('manajemenasset/js/cari', 'manajemenAsset\manajemenAssetController@jscari');
    });

    Route::group(['middleware' => ['role:4'] ], function () {
      Route::get('manajemenrole', 'manajemenRole\manajemenRoleController@index');
      Route::get('manajemenrole/tambah', 'manajemenRole\manajemenRoleController@add');
      Route::post('manajemenrole/save', 'manajemenRole\manajemenRoleController@save');
      Route::post('manajemenrole/update', 'manajemenRole\manajemenRoleController@update');
      Route::get('manajemenrole/hapus/{id}', 'manajemenRole\manajemenRoleController@delete');
      Route::get('manajemenrole/setmenu/{id}', 'manajemenRole\manajemenRoleController@setmenu');
    });

    Route::group(['middleware' => ['role:3'] ], function () {
      Route::get('manajemenuser', 'manajemenUser\manajemenUserController@index');
      Route::get('manajemenuser/tambah', 'manajemenUser\manajemenUserController@add');
      Route::post('manajemenuser/save', 'manajemenUser\manajemenUserController@save');
      Route::get('manajemenuser/hapus/{id}', 'manajemenUser\manajemenUserController@delete');
    });
  });

  Route::get('/home', 'HomeController@index')->name('home');




  Auth::routes();
});
