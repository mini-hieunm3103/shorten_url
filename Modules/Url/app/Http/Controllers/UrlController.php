<?php

namespace Modules\Url\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Http\RedirectResponse;
use Modules\Url\app\Http\Requests\UrlRequest;
use Illuminate\Support\Facades\Redirect;
use Modules\Url\app\Http\Repositories\UrlRepository;
use Modules\User\app\Repositories\UserRepository;

class UrlController extends Controller
{
    protected $urlRepo;
    protected $userRepo;
    protected $faker;
    public function __construct(UrlRepository $urlRepo, UserRepository $userRepo)
    {
        $this->urlRepo = $urlRepo;
        $this->userRepo = $userRepo;
        $this->faker = Factory::create();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản Lý Shorten URL';
        $urls = $this->urlRepo->getAllUrls()->get();
        return view('url::index', compact('urls', 'title'));
    }
    /**
     * Lấy ra thông tin của người dùng cùng với các shorten url của người đó
     */
    public function show($id)
    {
        $user = $this->userRepo->find($id);
        $urls = $this->urlRepo->getUserUrls($id)->get();
        $user->count_urls = $urls->count();
        $countClicks = 0;
        foreach ($urls as $url) {
            $countClicks += $url->clicks;
        }
        $user->count_clicks = $countClicks;
        return view('url::show', compact('user', 'urls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm Shorten URL';
        $users = $this->userRepo->getAllUsers()->get();
        return view('url::create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UrlRequest $request)
    {
        $backHalfArr = $this->urlRepo->getBackHalf();
        $data = $request->except('_token');
        $data['expired_at'] = Carbon::now()->addDays(30)->format('Y-m-d H:i:s');
        if(empty($data['title'])){
            $data['title'] = 'Untitled '.Carbon::now('UTC')->format('Y-m-d H:i:s');
        }
        if(empty($data['back_half'])){
            $data['back_half'] = $this->getBackHalf($backHalfArr);
        }
//        dd($data);
        $this->urlRepo->create($data);
        return redirect()->route('admin.url.index')
            ->with('msg', __('messages.success', ['action' => 'Create', 'attribute' => 'Shorten URL']))
            ->with('type', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Cập Nhật URL";
        $url = $this->urlRepo->getAllUrls()->find($id);
        $users = $this->userRepo->getAllUsers()->get();
        return view('url::edit', compact('url', 'title', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UrlRequest $request, $id): RedirectResponse
    {
        $backHalfArr = $this->urlRepo->getBackHalf();
        $data = $request->except('_token', '_method');
        $data['expired_at'] = Carbon::now()->addDays(30)->format('Y-m-d H:i:s');
        if(empty($data['title'])){
            $data['title'] = 'Untitled '.Carbon::now('UTC')->format('Y-m-d H:i:s');
        }
        if(empty($data['back_half'])){
            $data['back_half'] = $this->getBackHalf($backHalfArr);
        }
        $this->urlRepo->update($id, $data);
        return back()
            ->with('msg', __('messages.success', ['action' => 'Update', 'attribute' => 'Shorten URL']))
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->urlRepo->delete($id);
        return back()->with('msg', __('messages.success', ['action' => 'Delete', 'attribute' => 'Shorten URL']))
            ->with('type', 'success');
    }

    function getBackHalf($backHalfArr)
    {
        $backHalf = $this->faker->regexify('[a-zA-Z0-9]{4,7}');
        $check = in_array($backHalf, $backHalfArr);
        if(!$check) {
            return $backHalf;
        } else {
            $this->getBackHalf($backHalfArr);
        }
    }
}
