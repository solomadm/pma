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

//ADMIN

/**
 * Guest routes
 */
Route::group(['prefix' => 'a', 'namespace' => 'Admin', 'middleware' => 'guest'], function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
});

/**
 * Routes for authorized users
 */
Route::group(
    [
        'prefix' => 'a',
        'namespace' => 'Admin',
        'middleware' => 'auth'
    ],
    function () {
        Route::get('/', 'AdminController@index')->name('admin.dashboard');

        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'Auth\RegisterController@register');

        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');

        Route::get('switch/{id}', 'AdminController@switchConference')->name('conference.switch');

        Route::group(
            ['prefix' => 'conference'],
            function () {
                Route::get('/', 'ConferenceController@index');

                Route::get('/get/{conference}', 'ConferenceController@get');

                Route::post('create', 'ConferenceController@createPost');
                Route::get('edit/{conference}', 'ConferenceController@edit');
                Route::get('delete/{id}', 'ConferenceController@delete');
            }
        );

        Route::group(['prefix' => 'delegates'], function () {
            Route::get('/get-csv', 'DelegateController@getBlankCsv')->name('admin.delegate.get-csv-template');
            Route::get('/upload', 'DelegateController@uploadCsvPage')->name('admin.delegate.upload-csv-page');
            Route::post('/upload', 'DelegateController@uploadCsv')->name('admin.delegate.upload-csv');

            Route::get('/', 'DelegateController@getAll')->name('admin.delegate.get');
            Route::get('/{id}', 'DelegateController@get')->name('admin.delegate.get-one')->where(['id' => "[0-9]+"]);
            Route::delete('/{id}', 'DelegateController@delete')->name('admin.delegate.delete-one')->where(['id' => "[0-9]+"]);
            Route::put('/', 'DelegateController@put')->name('admin.delegate.put');
            Route::patch('/{id}', 'DelegateController@patch')->name('admin.delegate.edit')->where(['id' => "[0-9]+"]);
            Route::delete('/', 'DelegateController@delete')->name('admin.delegate.delete');
        });

        Route::group(
            ['prefix' => 'speakers'],
            function () {
                Route::get('/', 'SpeakerController@index')->name('admin.speakers');

                Route::get('/get/{speaker}', 'SpeakerController@get');

                Route::get('/company-list', 'SpeakerController@companyList');

                Route::post('/create', 'SpeakerController@createPost');
                Route::post('/edit/{speaker}', 'SpeakerController@edit');
                Route::post('/create', 'SpeakerController@createPost');
                Route::post('/edit', 'SpeakerController@edit');
            }
        );

        Route::group(
            ['prefix' => 'content'],
            function () {
                Route::get('global', 'ContentController@global')->name('admin.content.global');
                Route::post('global', 'ContentController@globalPost');

                Route::get('media-manager', 'ContentController@mediaManager')->name('admin.media-manager');
                Route::post('media-manager', 'ContentController@mediaManagerUpload');
                Route::post('media-manager/save-alt', 'ContentController@mediaManagerSaveAlt');

                Route::group(
                    ['prefix' => 'base'],
                    function () {
                        Route::get('home', 'Content\BaseController@home')->name('admin.content.base.home');
                        Route::post('home', 'Content\BaseController@homePost');

                        Route::get('speakers', 'Content\BaseController@speakers')->name('admin.content.base.speakers');
                        Route::post('speakers', 'Content\BaseController@speakersPost');

                        Route::get('programme', 'Content\BaseController@programme')->name('admin.content.base.programme');
                        Route::post('programme', 'Content\BaseController@programmePost');

                        Route::get('register', 'Content\BaseController@register')->name('admin.content.base.register');
                        Route::post('register', 'Content\BaseController@registerPost');

                        Route::get('login', 'Content\BaseController@login')->name('admin.content.base.login');
                        Route::post('login', 'Content\BaseController@loginPost');
                    }
                );

            }
        );

        Route::get('/contact', 'ContactController@index')->name('admin.contact');
        Route::get('/contact/export', 'ContactController@export')->name('admin.contact.export');

        Route::get('/media', 'MediaController@index')->name('admin.media');
        Route::get('/media/export', 'MediaController@export')->name('admin.media.export');

    }
);

//FRONTEND
Route::group(
    ['prefix' => '{conference}'],
    function ($conference) {
        Route::get('/', 'Frontend\ConferenceController@index')->name('frontend.index');

        Route::get('login', 'Frontend\Auth\LoginController@showLoginForm')->name('frontend.login');
        Route::post('login', 'Frontend\Auth\LoginController@login')->name('frontend.login.post');
        Route::any('logout', 'Frontend\Auth\LoginController@logout')->name('frontend.logout');

        Route::get('register', 'Frontend\Auth\RegisterController@showRegistrationForm')->name('frontend.register');
        Route::post('register', 'Frontend\Auth\RegisterController@register')->name('frontend.register.post');

        Route::get('password/reset', 'Frontend\Auth\ForgotPasswordController@showLinkRequestForm')->name('frontend.password.request');
        Route::post('password/email', 'Frontend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('frontend.password.email');
        Route::get('password/reset/{token}', 'Frontend\Auth\ResetPasswordController@showResetForm')->name('frontend.password.reset');
        Route::post('password/reset', 'Frontend\Auth\ResetPasswordController@reset');

        Route::get('/speakers', 'Frontend\SpeakerController@index')->name('frontend.speakers');
        Route::get('/speakers/{speaker}', 'Frontend\SpeakerController@profile')->name('frontend.speakers.profile');

        Route::get('/contact', 'Frontend\ContactController@index')->name('frontend.contact');
        Route::post('/contact', 'Frontend\ContactController@store')->name('frontend.post.contact');

        Route::get('/media/register', 'Frontend\MediaController@register')->name('frontend.media.register');
        Route::post('/media/register', 'Frontend\MediaController@store')->name('frontend.media.post.register');

        Route::get('/programme', 'Frontend\ProgrammeController@index')->name('frontend.programme');
    }
);
