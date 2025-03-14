<?php

use App\Http\Controllers\admin\admin_searchController;
use App\Http\Controllers\admin\admin_searchgenreController;
use App\Http\Controllers\admin\castingsController;
use App\Http\Controllers\admin\filmController;
use App\Http\Controllers\admin\genreController;
use App\Http\Controllers\admin\homeAdminController;
use App\Http\Controllers\admin\relationController;
use App\Http\Controllers\admin\userController;
use App\Http\Controllers\author\homeAuthorController;
use App\Http\Controllers\subscriber\homeSubscriberController;
use App\Http\Controllers\anonymous\homeAnonymousController;
use App\Http\Controllers\anonymous\searchController;
use App\Http\Controllers\anonymous\searchgenreController;
use App\Http\Controllers\author\a_commentController;
use App\Http\Controllers\author\a_FilmController;
use App\Http\Controllers\author\author_searchController;
use App\Http\Controllers\author\author_searchgenreController;
use App\Http\Controllers\subscriber\subs_searchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\subscriber\commentController;
use App\Http\Controllers\subscriber\subs_searchgenreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\commentController as ControllersCommentController;


// Route::get('/', function () {
//     return view('anonymous.home');
// });



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/films/{film}', [filmController::class, 'comment'])->name('comment.show');

//komentar
Route::post('/films/{film}/comments', [ControllersCommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::put('/comments/{comment}', [ControllersCommentController::class, 'update'])->name('comments.update');

//anonymous
Route::get('/', [homeAnonymousController::class, 'login'])->name('anonymous');
// Route::get('home/', [homeAnonymousController::class, 'index'])->name('anonymous.home');
Route::get('home/detailfilm/{id_film}', [homeAnonymousController::class, 'show'])->name('detail.film');
Route::get('film-genre/{id}', [searchgenreController::class, 'index'])->name('film-genre');
Route::get('search', [searchController::class, 'search'])->name('search');
Route::get('anonymous/search', [searchController::class, 'search'])->name('anonymous.film-search');
Route::get('Movies', [homeAnonymousController::class, 'movies'])->name('movies');
Route::get('Trailler', [homeAnonymousController::class, 'trailer'])->name('trailer');

//Subscriber
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('subscriber/home', [homeSubscriberController::class, 'index'])->name('subscriber.home');
    Route::get('subscriber/detailfilm/{id_film}', [homeSubscriberController::class, 'show'])->name('subscriber.detail');
    Route::get('sub/film-genre/{id}', [subs_searchgenreController::class, 'index'])->name('sub.film-genre');
    Route::get('sub/search', [subs_searchController::class, 'search'])->name('subscriber.search');
    Route::get('subscriber/search', [subs_searchController::class, 'search'])->name('subscriber.film-search');
    Route::get('All/Movies', [homeSubscriberController::class, 'movies'])->name('all.movies');
    Route::get('All/Trailler', [homeSubscriberController::class, 'trailer'])->name('all.trailer');
});

//author
Route::middleware(['auth', 'role:author'])->group(function () {
    Route::get('author/dashboard', [homeAuthorController::class, 'dashboard'])->name('author.dashboard');
    Route::get('author/home', [homeAuthorController::class, 'index'])->name('author.home');
    Route::get('author/detailfilm/{id_film}', [homeAuthorController::class, 'show'])->name('author.detail');
    Route::get('author/film-genre/{id}', [author_searchgenreController::class, 'index'])->name('author.film-genre');
    Route::get('author/search', [author_searchController::class, 'search'])->name('author.search');
    Route::get('author/filmsearch', [author_searchController::class, 'search'])->name('author.film-search');
    Route::get('author/Moviess', [homeAuthorController::class, 'movies'])->name('author.movies');
    Route::get('author/Traillerr', [homeAuthorController::class, 'trailer'])->name('author.trailer');
    //movies
    Route::get('author/film', [a_FilmController::class, 'index'])->name('a.film.index');
    Route::get('author/film/create', [a_FilmController::class, 'create'])->name('a.film.create');
    Route::post('author/film/store', [a_FilmController::class, 'store'])->name('a.film.store');
    Route::get('author/film/{id_film}', [a_FilmController::class, 'show'])->name('a.film.show');
    Route::get('author/film/edit/{id_film}', [a_FilmController::class, 'edit'])->name('a.film.edit');
    Route::put('author/film/update/{id_film}', [a_FilmController::class, 'update'])->name('a.film.update');
    Route::delete('author/film/destroy/{id_film}', [a_FilmController::class, 'destroy'])->name('a.film.destroy');
});


//admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [homeAdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/home', [homeAdminController::class, 'index'])->name('admin.home');
    Route::get('admin/detailfilm/{id_film}', [homeAdminController::class, 'show'])->name('admin.detail');
    Route::get('admin/film-genre/{id}', [admin_searchgenreController::class, 'index'])->name('admin.film-genre');
    Route::get('admin/search', [admin_searchController::class, 'search'])->name('admin.search');
    Route::get('admin/filmsearch', [admin_searchController::class, 'search'])->name('admin.film-search');
    Route::get('admin/Moviess', [homeAdminController::class, 'movies'])->name('admin.movies');
    Route::get('admin/Traillerr', [homeAdminController::class, 'trailer'])->name('admin.trailer');

    //user
    Route::get('admin/user', [userController::class, 'index'])->name('user.index');
    Route::get('admin/user/create', [userController::class, 'create'])->name('user.create');
    Route::post('admin/user/store', [userController::class, 'store'])->name('user.store');
    Route::get('admin/user/edit/{id}', [userController::class, 'edit'])->name('user.edit');
    Route::put('admin/user/update/{id}', [userController::class, 'update'])->name('user.update');
    Route::delete('admin/user/destroy/{id}', [userController::class, 'destroy'])->name('user.destroy');

    //film
    Route::get('admin/film', [filmController::class, 'index'])->name('film.index');
    Route::get('admin/film/create', [filmController::class, 'create'])->name('film.create');
    Route::post('admin/film/store', [filmController::class, 'store'])->name('film.store');
    Route::get('admin/film/{id_film}', [FilmController::class, 'show'])->name('film.show');
    Route::get('admin/film/edit/{id_film}', [filmController::class, 'edit'])->name('film.edit');
    Route::put('admin/film/update/{id_film}', [filmController::class, 'update'])->name('film.update');
    Route::delete('admin/film/destroy/{id_film}', [filmController::class, 'destroy'])->name('film.destroy');

    //genre
    Route::get('admin/genre', [genreController::class, 'index'])->name('genre.index');
    Route::get('admin/genre/create', [genreController::class, 'create'])->name('genre.create');
    Route::post('admin/genre/store', [genreController::class, 'store'])->name('genre.store');
    Route::get('admin/genre/edit/{id_genre}', [genreController::class, 'edit'])->name('genre.edit');
    Route::put('admin/genre/update/{id_genre}', [genreController::class, 'update'])->name('genre.update');
    Route::delete('admin/genre/destroy/{id_genre}', [genreController::class, 'destroy'])->name('genre.destroy');

    //castings
    Route::get('admin/castings', [castingsController::class, 'index'])->name('castings.index');
    Route::get('admin/castings/create', [castingsController::class, 'create'])->name('castings.create');
    Route::post('admin/castings/store', [castingsController::class, 'store'])->name('castings.store');
    Route::get('admin/castings/edit/{id_castings}', [castingsController::class, 'edit'])->name('castings.edit');
    Route::put('admin/castings/update/{id_castings}', [castingsController::class, 'update'])->name('castings.update');
    Route::delete('admin/castings/destroy/{id_castings}', [castingsController::class, 'destroy'])->name('castings.destroy');

    //relasi
    Route::get('/relasi', [relationController::class, 'index'])->name('relasi.index');
    Route::get('/relasi/create', [relationController::class, 'create'])->name('relasi.create');
    Route::post('/relasi/store', [relationController::class, 'store'])->name('relasi.store');
    Route::get('/relasi/edit/{id}', [relationController::class, 'edit'])->name('relasi.edit');
    Route::put('/relasi/update/{id}', [relationController::class, 'update'])->name('relasi.update');
    Route::delete('/relasi/destroy/{id}', [relationController::class, 'destroy'])->name('relasi.destroy');
});
