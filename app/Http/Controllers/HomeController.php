<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; //represents the posts table
use App\Models\User;
use PDO;

class HomeController extends Controller
{
    private $post;
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $suggested_users = $this->suggestedUsers();
        $all_posts = $this->filteredPosts();
        //Same as: "SELECT * FROM posts ORDER By created_at DESC";

        return view('users.home')
            ->with('all_posts', $all_posts)->with('suggested_users', $suggested_users);
    }
    public function suggestedUsers()
    {
        $all_users = $this->user->all()->except(auth()->user()->id);
        $suggested_users = [];
        foreach ($all_users as $user) {
          if(!$user->isFollowed()){
            $suggested_users[] = $user;
          }
        }

        return $suggested_users;
    }

    public function filteredPosts(){
        $all_posts = $this->post->latest()->get();

        $filtered_posts = [];

        foreach($all_posts as $post){
            if($post->user->isFollowed() || $post->user->id == auth()->user()->id){
                $filtered_posts[] = $post;
            }
        }

        return $filtered_posts;
    }
}
