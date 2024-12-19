<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SuccessStoryController;

Route::resource('members', MemberController::class);
Route::resource('success-stories', SuccessStoryController::class);

Route::get('/', function () {
    return redirect()->route('members.index');
});

Route::get('members/export', [MemberController::class, 'export'])->name('members.export');
