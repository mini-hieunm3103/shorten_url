<?php

namespace Modules\Url\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Url\app\Http\Repositories\UrlRepository;

class UrlController extends Controller
{
    protected $urlRepo;
    public function __construct(UrlRepository $urlRepo)
    {
        $this->urlRepo = $urlRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return view('url::index', compact('urls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('url::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'long_url' => 'required|string|max:255|url',
        ], [
            'required' => 'Please enter the link you want to shorten!',
            'max' => 'URL is too long!',
            'url' => 'Must be a valid URL'
        ]);
        // nếu không trùng thì sẽ create còn nếu trùng thì trả về id trùng đó
        $url = $request->except('_token');
        // check regex xem có đang shorten url của web này hay không nếu có thì return error
        $check = false;
        if ($check) {
            return back()
                ->with('msg', 'Please Do Not Shorten This Page\'s URL')
                ->with('type', 'danger');
        }
        $UrlsArr = $this->urlRepo->getAllUrls()->get()->toArray();
        $isCreate = true;
        foreach ($UrlsArr as $urlDb) {
            if ($urlDb['long_url'] === $url['long_url']) {
                $isCreate = false;
                $url = $urlDb;
            }
        }
        if ($isCreate) {
            $url = $this->urlRepo->create($url);
            $url = $url->toArray();
        }
        return redirect()->route('show', ['id' => $url['id']])
            ->with('msg', 'URL Shortening Successfully!')
            ->with('type', 'success');
    }
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $url = $this->urlRepo->find($id);
        if(!$url){
            abort(404);
        }
        $url->short_url = request()->root().'/'.encodeUrl($id);
        return view('url::show', compact( 'url'));
    }
    public function redirect($shortenUrl){
        $id = decodeUrl($shortenUrl);
        $url = $this->urlRepo->find($id);
        if(!$url){
            abort(404);
        }
        $now = Carbon::now()->format('Y-m-d H:i:s');
        if (!empty($url->expired_at) && $url->expired_at <= $now){
            abort(410);
        }
        $trueUrl = $url->long_url;
        $countClick = $url->clicks + 1;
        $dataUpdate = [
            'clicks' => $countClick,
            'expired_at' => Carbon::now()->addDays(30)
        ];
        $this->urlRepo->update($id, $dataUpdate);
        return Redirect::to($trueUrl);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
//        return view('url::edit');
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
