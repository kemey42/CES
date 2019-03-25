<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        return view('setup.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $rolelist = Role::all()->pluck('name','id')->toArray();
        return view('setup.user.edit', compact('user','rolelist'));
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
        //to make sure every field defined below is added
            $this->validate($request,[
                'fullname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'phone_number' => ['required', 'numeric', 'digits_between:10,13'],
                //'password' => ['required', 'string', 'min:8', 'confirmed'],
                'user-role' => ['required'],
        ]);

        $input = $request->except('user-role');
        $user->fill($input)->save();

        $user->roles()->sync($request['user-role']);

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
