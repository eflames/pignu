
<?php
/**
 * Created by PhpStorm.
 * User: eflames
 * Date: 13/03/2017
 * Time: 02:35 PM
 */

Route::resource('/users','UserController');
Route::get('/users-search','UserController@search')->name('users.search');
Route::resource('/variables','VariableController');
Route::get('/variables-search','VariableController@search')->name('variables.search');
Route::get('/configuration','ConfigController@index')->name('configuration.index');
Route::post('/configuration','ConfigController@store')->name('configuration.store');
Route::post('/configuration/addLanguage','ConfigController@storeAppLanguage')->name('configuration.storeLanguage');
Route::get('/configuration/deleteLanguage/{id}','ConfigController@deleteAppLanguage')->name('configuration.deleteLanguage');
Route::post('/configuration/langOption','ConfigController@activateAppLanguage')->name('configuration.langOption');
Route::post('/configuration/storeCompanyData','ConfigController@storeCompanyData')->name('configuration.storeCompanyData');
Route::post('/configuration/storeSEOData','ConfigController@storeSEOData')->name('configuration.storeSEOData');
Route::post('/configuration/storeDefaultImage','ConfigController@storeDefaultImage')->name('configuration.storeDefaultImage');
Route::resource('/roles','RoleController');
Route::get('/roles-search','RoleController@search')->name('roles.search');
Route::resource('/products','ProductController');
Route::get('/products-search','ProductController@search')->name('products.search');
Route::get('/product/images/{id}','ProductController@images')->name('product.images');
Route::post('/product/images/add','ProductController@addImage')->name('product.addImage');
Route::get('/product/images/{id}/delete','ProductController@imageDestroy')->name('product.destroy');
Route::get('/product/active/{id}/{action}','ProductController@changeActive')->name('product.active');
Route::get('/product/highlight/{id}/{action}','ProductController@changeHighlighted')->name('product.highlight');
Route::resource('/categories','CategoryController');
Route::get('/categories-search','CategoryController@search')->name('categories.search');
Route::get('/profile','UserController@profile')->name('profile.index');
Route::post('/profile','UserController@updateProfile')->name('profile.update');
Route::resource('/articles','ArticleController');
Route::post('/forms/uploadFormImg','FormController@uploadFormImg');
Route::get('/articles-search','ArticleController@search')->name('articles.search');
Route::get('/articles/visibility/{id}/{action}','ArticleController@changeVisible')->name('articles.visibility');
Route::resource('/pages','PageController');\
Route::get('/pages-search','PageController@search')->name('pages.search');
Route::get('/pages/activate/{id}/{action}','PageController@activate')->name('pages.activate');
Route::get('/sitemap','HomeController@generateSitemap');
Route::resource('/plugins', 'PluginController');
Route::get('/plugins/changeActive/{id}/{action}', 'PluginController@changeActive')->name('plugins.active');
Route::get('/activity-log', 'ActivityLogController@activityLog')->name('activity-log');
Route::get('/activity-log/{id}', 'ActivityLogController@activityLogDetail')->name('activity-log.detail');
Route::get('/activity-log-search', 'ActivityLogController@activityLogSearch')->name('activity-log.search');
Route::get('/activity-log-cleanup', 'ActivityLogController@activityLogCleanUp')->name('activity-log.cleanup');
Route::resource('/galleries', 'GalleryController');
Route::get('/gallery/{id}', 'GalleryController@detail')->name('gallery.detail');
Route::get('/gallery/delete/{id}', 'GalleryController@imageDestroy')->name('gallery.destroy');
Route::get('/gallery/cover/{id}', 'GalleryController@markCover')->name('gallery.cover');
Route::get('/galleries/active/{id}/{action}', 'GalleryController@active')->name('galleries.active');
Route::post('/gallery/', 'GalleryController@addImage')->name('gallery.addimage');

