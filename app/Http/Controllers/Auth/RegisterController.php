<?php

namespace App\Http\Controllers\Auth;

use App\Factories\ActivationFactory;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * @var ActivationFactory
     */
    protected $activationFactory;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationFactory $activationFactory)
    {
        $this->middleware('guest');
        $this->activationFactory = $activationFactory;
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
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->roles()->attach(Role::where('name', 'User')->first());
        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $this->activationFactory->sendActivationMail($user);

        /*$this->guard()->login($user);
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());*/

        session()->flash('activationStatus', 'true');
        return redirect('/login');
        //return redirect('/login')->with('activationStatus', true);
    }

    public function activateUser($token)
    {
        if ($user = $this->activationFactory->activateUser($token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->activated) {
            $this->activationFactory->sendActivationMail($user);
            auth()->logout();
            session()->flash('activationWarning', 'true');
            //return back()->with('activationWarning', true);
            return back();
        }
        return redirect()->intended($this->redirectPath());
    }
}
