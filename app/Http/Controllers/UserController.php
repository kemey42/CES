<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:edit user|view user|add user|delete user']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('view user')){
            return redirect('/home')->with('error','Not allowed to view others profile');
        }
        $rolelist = Role::all()->pluck('name','name')->toArray();

        //return QueryBuilder::for(User::class)
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                Filter::scope('has_roles'), 'fullname', 'email'
            ])
            ->paginate(15);

        return view('setup.user.main', compact('users', 'rolelist'));
    }

    
    public function filter(Request $request)
    {
        $url = URL::action(
            'UserController@index',
            ['filter' => [
                'fullname' => $request['fullname'],
                'email' => $request['email'],
                'has_roles' => $request['user-role']
            ]]
        );
        return redirect($url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //dd($user);
        if (Auth::id()==$user->id || Auth::user()->hasPermissionTo('view user')){
            return view('setup.user.show', compact('user'));
        } else {
            return redirect('/home')->with('error','Not allowed to view others profile');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::id()==$user->id || Auth::user()->hasPermissionTo('edit user')){
            $rolelist = Role::all()->pluck('name','id')->toArray();
            return view('setup.user.edit', compact('user','rolelist'));
        } else {
            return redirect('/home')->with('error','Not allowed to edit others profile');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (Auth::id()!=$user->id && !Auth::user()->hasPermissionTo('edit user')){
            return redirect('/home')->with('error','Not allowed to edit/save others profile');
        }

        if (Auth::id()!=$user->id && $user->id == '19000'){
            return redirect('/home')->with('error','Invalid operation. Nak mati ke tukar aku punya profile?');
        }

        //to make sure every field defined below is added
        $this->validate($request,[
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone_number' => ['required', 'numeric', 'digits_between:10,13'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $input = $request->except('user-role');
        $user->fill($input)->save();
        
        if(Auth::user()->hasPermissionTo('edit role')){
            $user->roles()->sync($request['user-role']);
        }
        
        return redirect('user/'.$user->id)->with('success','User information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
