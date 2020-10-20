<?php

namespace Dexperts\Authentication\Controllers;

use App\Http\Controllers\Controller;
use Dexperts\Authentication\Rights;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
	public function login() {
		if (Auth::check()) {
			return redirect('/admin/users');
		}
		return view('authentication::auth.login');
	}

	public function authenticate() {
		$rules = array(
			'email' => 'required|email',
			'password' => 'required|min:3'
		);

		$validator = Validator::make(request()->all(), $rules);
		if ($validator->fails()) {
			return redirect()->route('login')->withErrors($validator)->withInput(request()->except('password'));
		} else {
			$userData = array(
				'email' => request('email'),
				'password' => request('password'),
			);

			if (Auth::attempt($userData)) {
				return redirect('/admin/users');
			} else {
				return redirect('/login')
					->with('auth_message', 'E-mailadres met wachtwoord combinatie niet bekend, probeer het nogmaals!')
					->withInput(request()->except('password'));
			}
		}
	}

	public function logout() {
		$redirectTo = '/login';
		Auth::logout();
		return redirect($redirectTo);
	}
}
