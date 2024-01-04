<?php

namespace Modules\Auth\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Url\app\Http\Repositories\UrlRepository;
use Modules\Url\app\Models\Url;
use Modules\User\app\Models\User;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public $urlRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UrlRepository $urlRepo)
    {
        $this->middleware('guest');
        $this->urlRepo = $urlRepo;
    }
    public function showRegistrationForm()
    {
        return view('auth::register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return
     */
    protected function create(array $data)
    {
        $userGroup = DB::table('groups')->where('name', 'User')->first();
        $dataUser = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'group_id' => $userGroup->id,
        ];

        $user = User::create($dataUser);
        if (!empty($data['url_when_register'])){
            $dataUrl = [
                'long_url' => $data['url_when_register'],
                'user_id' => $user->id
            ];
            $dataUrl['expired_at'] = Carbon::now()->addDays(30)->format('Y-m-d H:i:s');
            $dataUrl['title'] = 'Shorten URL Created Upon Registration, Customize It';
            $dataUrl['is_custom'] = 0;
            $dataUrl['back_half'] = App::make('Modules\Url\app\Http\Controllers\UrlController')->callAction('getBackHalf', [$this->urlRepo->getBackHalf()]);
            Url::create($dataUrl);
        }
        return $user;
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $userGroup = DB::table('groups')->where('name', 'User')->first();
        $roleGroup = Role::where('roles.id', $userGroup->role_id)->with('permissions')->first();

        event(new Registered($user = $this->create($request->all())));
        $user->assignRole($roleGroup->name);

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }
}
