<?php

namespace Modules\Access\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Url\app\Http\Repositories\UrlRepository;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
class AccessController extends Controller
{
    protected $urlRepo;
    public function __construct
    (
        UrlRepository $urlRepo
    )
    {
        $this->urlRepo = $urlRepo;
    }

    public function access($backHalf)
    {
        $url = $this->urlRepo->getAllUrls()->where('back_half', $backHalf)->first();
        if (!$url){
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
        $this->urlRepo->update($url->id, $dataUpdate);
        return Redirect::to($trueUrl);
    }
}
