<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeleteRecipeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SelectRecipeController;
use App\Http\Controllers\SelectSequenceController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\LinkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [SelectRecipeController::class,'a']);

//index.php
Route::get('/index',[SelectRecipeController::class,'getNewRecipe'])
//トップページリンク
->name('topLink');

//Login.php
Route::post('/Login',[LoginController::class,'login']);

//a hrefリンク
Route::get('/Login',[LinkController::class,'loginLink'])
->name('loginLink');

Route::get('/Logout',[LinkController::class,'logoutLink'])
->name('logoutLink');

Route::get('Register',[LoginController::class,'needData'])
//新規登録リンク
->name('registerLink');

Route::post('/Register',[LoginController::class,'newUser']);

Route::get('/Register_complete',[LinkController::class,'regiCompLink'])
->name('regiCompLink');

Route::get('/Password_Reset',[LinkController::class,'passResetLink'])
->name('passResetLink');

Route::post('/Password_Reset',[LoginController::class,'updatePassword']);

Route::get('/Password_Reset_complete',[LinkController::class,'pwResetCompLink'])
->name('pwResetCompLink');

Route::get('/Profile',[LoginController::class,'getUsers'])
->name('profileLink');

Route::get('/ProfileEdit',[LoginController::class,'getEditUsers'])
->name('profEditLink');

Route::post('/ProfileEdit',[UploadController::class,'fileUpdate']);

Route::get('/ProfileEdit_complete',[LinkController::class,'profEditCompLink']);

Route::get('/Contribute',[LinkController::class,'contributeLink'])
->name('contributeLink');

Route::post('/Contribute',[UploadController::class,'fileSave']);

Route::get('/Contribute_complete',[LinkController::class,'contributeCompLink'])
->name('contributeCompLink');

Route::get('/Contribute_List',[SelectRecipeController::class,'getRecipeUser'])
->name('contListLink');

Route::get('Contribute_Edit/{recipe_id}',[SelectRecipeController::class,'getAll'])
->name('contEditLink');

Route::post('Contribute_Edit',[UploadController::class,'fileUpdate']);

Route::get('RecipeDetail/{recipe_id}',[SelectRecipeController::class,'getDetail'])
->name('recipeDetailLink');

Route::get('Level_Recipe/{level}',[SelectRecipeController::class,'getRecipeList'])
->name('levelRecipeLink');

Route::get('/admin',[LinkController::class,'adminLink'])
->name('adminLink');

Route::get('/admin_userlist',[LoginController::class,'admingetUser'])
->name('adminUserListLink');

Route::get('/admin_delete/{id}',[LoginController::class,'adminDeleteUser'])
->name('adminDeleteLink');

Route::get('/admin_contributelist',[SelectRecipeController::class,'admingetRecipeList'])
->name('admincontListLink');

Route::get('admin_deleteRecipe/{recipe_id}',[DeleteRecipeController::class,'deleteRecipe'])
->name('adminDeleteRecipeLink');

Route::get('/Leave',[LoginController::class,'del_flg'])
->name('leaveLink');
