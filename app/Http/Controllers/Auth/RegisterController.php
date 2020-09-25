<?php

namespace App\Http\Controllers\Auth;

use App\Events\NotifyEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Colonias;
use App\Models\Docreq;
use App\Models\Business;
use App\Models\Docrequser;
use App\Models\Domicilios;
use App\Models\InformacionesNotariales;
use App\Models\Notifica;
use App\Models\Personas;
use App\Models\PersonasMorales;
use App\Models\UsersPersonas;
use App\User;
use carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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

        ]);
    }
    protected function guard()
    {

        return Auth::guard('api');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'activation_token' => 'Activo',
            'password' => Hash::make($request->password),
        ]);

       DB::beginTransaction();
        try {


            $role = DB::table('role_user')->insert([
                'role_id' => '2',
                'user_id' => $user->id,
                'created_at' => carbon::now(),
            ]);
            if($request->code != ''){
                $branch = DB::table('brances')->Where('code',$request->code)->first();

                $user_branch = DB::table('user_branch')->insert([
                    'user_id' => $user->id,
                    'branch_id' => $branch->id,
                    'created_at' => carbon::now(),
                ]); 

            }else{
                // $business = Business::create([
                //     'name' => 'Unknown',
                //     'description' => 'Unknown',
                //     'user_id' => $user->id,
                // ]);
                // $branch = Business::create([
                //     'name' => 'Unknown',
                //     'description' => 'Unknown',
                //     'code' => 'Unknown' + $user->id,
                //     'categoria_id' => '1',
                //     'business_id' => $business->id,
                // ]);

                $user_branch = DB::table('user_branch')->insert([
                    'user_id' => $user->id,
                    'branch_id' => 1,
                    'created_at' => carbon::now(),
                ]); 

            }
            // $role = DB::table('verification_profile')->insert([
            //     'status_id' => '0',
            //     'user_id' => $user->id,
            //     'created_at' => carbon::now(),
            // ]);

            // $notifica = new Notifica();
            // $notifica->user_id = $user->id;
            // $notifica->msg = 'Acceda por primera vez a Subastas';
            // $notifica->url = '/subasta';
            // $notifica->type = '1';
            // $notifica->created_at = carbon::now();
            // $notifica->save();
            // DB::commit();

            $user = User::where('id', 1)->first();
            event(new Registered($user));

            $token = auth()->attempt(['email' => $request->email, 'password' => $request->password]);

            return response()->json([
                'success' => true,
                'message' => 'Usuario Creado con exito, "Verifique su correo"',
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]);

        } catch (\ErrorException $e) {
            DB::rollBack();
            $response = $e;
            return response($response, 401);
        }
    }
    
    protected function register_admin(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->email,
                'email' => $request->email,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'isActive' => 'Activo',
                'password' => Hash::make($request->password),
                'position' => 'Usuario',
            ]);

            $role = DB::table('role_user')->insert([
                'role_id' => '24',
                'user_id' => $user->id,
                'created_at' => carbon::now(),
            ]);

            $role = DB::table('verification_profile')->insert([
                'status_id' => '0',
                'user_id' => $user->id,
                'created_at' => carbon::now(),
            ]);

            $notifica = new Notifica();
            $notifica->user_id = $user->id;
            $notifica->msg = 'Acceda por primera vez a Subastas';
            $notifica->url = '/subasta';
            $notifica->type = '1';
            $notifica->created_at = carbon::now();
            $notifica->save();
            DB::commit();

            //$user = User::where('id', 130)->first();
            event(new Registered($user));

            $token = auth()->attempt(['email' => $request->email, 'password' => $request->password]);

            return response()->json([
                'success' => true,
                'message' => 'Usuario Creado con exito, "Verifique su correo"',
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]);

        } catch (\ErrorException $e) {
            DB::rollBack();
            $response = $e;
            return response($response, 401);
        }
    }
    
   
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
}