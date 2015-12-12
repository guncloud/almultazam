<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Pingpong\Trusty\Role;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('root');
    }

    public function index()
    {
        $title = 'Management Users';
        $user = User::has('roles')->get();
        $role = Role::all();

        $users = (!$user->isEmpty()) ? $user : false;
        $roles = (!$role->isEmpty()) ? $role : false;

//        dd($roles->toArray());

        return view('root.user.index', compact('title', 'users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->get('username'),
            'username' => $request->get('username'),
            'email' => $request->get('name').'@user.com',
            'password' => \Illuminate\Support\Facades\Hash::make($request->get('password')),

        ]);

        $user->roles()->attach($request->get('role'));


//        if($request->get('role') == 'true'){
//            $data = [
//                'name' => $request->get('name'),
//                'slug' => str_slug($request->get('name')),
//                'description' => $request->get('desc')
//            ];
//
//            Role::create($data);
//
//        }elseif($request->get('user') == 'true'){
//            $user = User::create([
//                'name' => $request->get('name'),
//                'username' => $request->get('username'),
//                'email' => $request->get('name').'@user.com',
//                'password' => \Illuminate\Support\Facades\Hash::make($request->get('password')),
//
//            ]);
//
//            $user->roles()->attach($request->get('role'));
//        }

        Session::flash('info', 'Data inserted');
        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $data['title'] = 'Data Pengguna';
        return view('auth.reset', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $title = 'Edit Data User';
        $user = User::find($id);
        $roles = Role::all();

        return view('root.user.edit', compact('title', 'user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)
            ->update(array(
                'username' => $request->get('username'),
                'password' => Hash::make($request->get('password')
            )));

        if($user){
            DB::table('role_user')
                ->where('user_id', $id)
                ->update(array('role_id' => $request->get('role')));
        }

        return redirect('user');
    }

    public function update_own(Request $request, $id)
    {
        //        dd($request->all());
        if($request->get('old_password')){
            $user = User::findOrFail($id);

            if(Hash::check($request->get('old_password'), $user->password)){
                $user->password = Hash::make($request->get('change_password'));
//                $user->name = $request->get('name');
//                $user->username = $request->get('username');
                if($user->save()){
                    Session::flash('info', 'Data change');
                    return redirect('/user/'.$id);
                }else{
                    Session::flash('info', 'Errror');
                    return redirect('/user/'.$id);
                }
            }else{
                Session::flash('info', 'Errror');
                return redirect('/user/'.$id);
            };
        }else{
            return redirect('/user/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $user = User::destroy($id);

        if($user){

        }

        return redirect('/user');
    }
}
