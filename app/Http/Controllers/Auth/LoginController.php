<?php
  
  namespace App\Http\Controllers\Auth;
  
  use App\User;
  use Illuminate\Support\Facades\Auth;
  use Socialite;
  use App\Http\Controllers\Controller;
  use Illuminate\Foundation\Auth\AuthenticatesUsers;
  
  class LoginController extends Controller
  {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    use AuthenticatesUsers;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest')->except('logout');
      $provider = request('provider');
      session()->put('previousURL', $provider);
    }
    
    public function redirectToGithub()
    {
      
      return Socialite::driver('github')->redirect();
    }
    
    public function redirectToTwitter()
    {
      return Socialite::driver('twitter')->redirect();
    }
    
    public function handleGithubCallback()
    {
      $providerUser = Socialite::driver('github')->user();
      $user = $this->findOrCreateUser('github', $providerUser);
      return $this->login($user);
    }
    
    public function handleTwitterCallback()
    {
      $providerUser = Socialite::driver('twitter')->user();
      $user = $this->findOrCreateUser('twitter', $providerUser);
      return $this->login($user);
    }
    
    public function findOrCreateUser($provider, $providerUser)
    {
      $user = User::firstOrNew([
        $provider . '_id' => $providerUser->id
      ]);
      if ($user->exists) return $user;
      $user->fill([
        $provider . '_id' => $providerUser->id,
        'avatar' => $providerUser->avatar,
        'username' => $providerUser->nickname,
        'email' => $providerUser->email,
        'full_name' => $providerUser->name
      ]);
      $user->save();
      return $user;
    }
    
    public function logout()
    {
      return Auth::logout();
    }
  
    /**
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login($user)
    {
      Auth::login($user);
      $url = session()->get('previousURL');
      session()->forget('previousURL');
      return redirect($url);
    }
  }