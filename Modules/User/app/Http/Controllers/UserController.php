<?php

namespace Modules\User\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Url\app\Http\Repositories\UrlRepository;
use Modules\User\app\Repositories\UserRepository;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userRepo;
    protected $urlRepo;
    public function __construct(UserRepository $userRepo, UrlRepository $urlRepo)
    {
        $this->userRepo = $userRepo;
        $this->urlRepo = $urlRepo;
    }

    public function index()
    {
        $users = $this->userRepo->getAllUsers()->get();
        $urls = $this->urlRepo->getAllUrls()->get();
        $countUrls = [];
        $countClicks = [];
        foreach ($users as $key =>$user) {
            $userId = $user->id;
            $countUrls[$userId] = 0;
            $countClicks[$userId] = 0;
            foreach ($urls as $url) {
                if ($url->user_id == $userId) {
                    $countUrls[$userId]++;
                    $countClicks[$userId] += $url->clicks;
                }
            }
            $user->total_urls = $countUrls[$userId];
            $user->total_clicks = $countClicks[$userId];
            $users[$key] = $user;
        }
        return view('user::index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
