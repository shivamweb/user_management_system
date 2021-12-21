<?php

namespace App\Http\Traits;

use App\Models\Admin;
use Image;
use App\Models\Post;
use App\Models\records;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

trait DataTrait
{
    public function getAllPost()
    {
        $posts = Post::orderByDesc('id')->get();
        return $posts;
    }

    public function getProfile($userType, $id)
    {
        $profile = null;

        if ($userType == 'user') {
            $profile = records::findOrFail($id);
        }
        if ($userType == 'admin') {
            $profile = Admin::findOrFail($id);
        }
        return $profile;
    }
}
