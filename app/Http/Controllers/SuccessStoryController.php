<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function index()
    {
        $successStories = SuccessStory::paginate(10);
        return view('success_stories.index', compact('successStories'));
    }
}
