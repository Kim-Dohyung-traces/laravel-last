<?php

# 장준혁 홈페이지
Route::get('/', function () { return redirect('home'); });
Route::resource('home', 'HomeController');
# 장준혁 홈페이지


# 정인식 조원소개
Route::resource('members','MembersController');
Route::post('members/{id}/update/','MembersController@update');
Route::get('members/{id}/ajax','MembersController@ajaxIndex');
# 정인식 조원소개



# 사용자 등록
Route::get('auth/register', [ //1 경로 auth/register은
    'as' => 'users.create', //3 users.create로 호출할 수 있음.
    'uses' => 'UsersController@create', //2 UsersController의 create메서드를 사용하며
]); //=> users.create 사용은 resources/views/layouts/partial/navigation.blade.php를 참고
Route::post('auth/register', [
    'as' => 'users.store',
    'uses' => 'UsersController@store',
]);
Route::get('auth/confirm/{code}', [
    'as' => 'users.confirm',
    'uses' => 'UsersController@confirm',
]);

# 사용자 인증
Route::get('auth/login', [
    'as' => 'sessions.create',
    'uses' => 'SessionsController@create',
]);
Route::post('auth/login', [
    'as' => 'sessions.store',
    'uses' => 'SessionsController@store',
]);
Route::get('auth/logout', [
    'as' => 'sessions.destroy',
    'uses' => 'SessionsController@destroy',
]);

# 비밀번호 초기화
Route::get('auth/remind', [
    'as' => 'remind.create',
    'uses' => 'PasswordsController@getRemind',
]);
Route::post('auth/remind', [
    'as' => 'remind.store',
    'uses' => 'PasswordsController@postRemind',
]);
Route::get('auth/reset/{token}', [
    'as' => 'reset.create',
    'uses' => 'PasswordsController@getReset',
]);
Route::post('auth/reset', [
    'as' => 'reset.store',
    'uses' => 'PasswordsController@postReset',
]);




// /* 태그 */
// Route::get('tags/{slug}/articles', [ //{{slug}}값에 들어온 것은 index메서드로 넘김
//     'as' => 'tags.articles.index',
//     'uses' => 'ArticlesController@index',
// ]);

// /* 좋아요 */
// Route::post('comments/{comment}/votes',[
//     'as' => 'comments.vote',
//     'uses' => 'CommentsController@vote',
// ]);





// // 드롭존 라이브러리의 파일 업로드 요청을 받을 별도의 라우트
// Route::resource('attachments', 'AttachmentsController', ['only' => ['store', 'destroy']]);
// Route::get('attachments/{file}', 'AttachmentsController@show');

// // 댓글
// Route::resource('comments', 'CommentsController', ['only' => ['update', 'destroy']]);
// Route::resource('articles.comments', 'CommentsController', ['only' => 'store']);
