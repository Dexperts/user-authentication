<?php

namespace Dexperts\Authentication\Controllers;

use App\Http\Controllers\Controller;
use Dexperts\Authentication\Rights;
use Dexperts\Authentication\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$rights = Rights::all();
    	$user = new User();
    	$actionPath = '/admin/users';
	    return view('admin/users/edit', compact('rights', 'user', 'actionPath'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function store()
    {
	    $this->validate(request(), [
		    'name' => 'required|min:4',
		    'email' => 'required|min:4|email',
		    'password' => 'required|min:6'
	    ]);

	    $user = new User;
	    $user->name = request('name');
	    $user->email = request('email');
	    $user->password = Hash::make(request('password'));
	    $user->rights_id = request('rights');

	    $user->save();

	    Mutation::setMutation(MutationTypes::Create,
		    'User',
		    $user->id,
	        [ 'message' => 'user.created']
	    );

	    return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
	    $rights = Rights::all();
	    $actionPath = '/admin/users/' . $user->id;
	    return view('admin/users/edit', compact('rights', 'user', 'actionPath'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\User $user
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function update(User $user)
    {
	    $this->validate(request(), [
		    'name' => 'required|min:4',
		    'email' => 'required|min:4|email'
	    ]);

	    $user->name = request('name');
	    $user->email = request('email');
	    $user->rights_id = request('rights');

	    $user->save();

	    Mutation::setMutation(MutationTypes::Update,
		    'User',
		    $user->id,
		    serialize($user->getChanges())
	    );

	    return redirect('/admin/users')->with('message', __('admin/user.updated'));
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
