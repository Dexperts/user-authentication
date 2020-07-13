<?php

namespace Dexperts\Authentication\Controllers;

use App\Http\Controllers\Controller;
use Dexperts\Authentication\Rights;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RightsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$rights = Rights::all();
		return view('authentication::rights.index', compact('rights'));
	}

	public function create() {
		$rights = new Rights();
		$modules = Rights::getModules();
		$availableRights = Rights::getAvailableRights();
		$rightsAction = '/admin/rights';
		return view('authentication::rights.edit', compact('modules', 'availableRights', 'rights', 'rightsAction'));
	}

	public function store() {
		$rules = [
			'group_name' => 'required|min:4'
		];

		$validator = Validator::make(request()->all(), $rules);

		if ($validator->fails()) {
			redirect('admin/rights/create')->withErrors($validator)->withInput();
		} else {
			$rights = new Rights;
			$rights->group_name = request('group_name');
			$rights->allowed = join('|', request('rights'));
			$rights->disallowed = '';
			$rights->user_id = Auth::id();

			$rights->save();

			return redirect('/admin/rights')->with('message', 'Rechtengroep is aangemaakt en opgeslagen!');
		}
	}

	public function edit(Rights $rights) {
		$modules = Rights::getModules();
		$availableRights = Rights::getAvailableRights();
		$rightsAction = '/admin/rights/' . $rights->id;
		return view('authentication::rights.edit', compact('modules', 'availableRights', 'rights', 'rightsAction'));
	}

	public function update(Rights $rights) {
		$rules = [
			'group_name' => 'required|min:4'
		];

		$validator = Validator::make(request()->all(), $rules);

		if ($validator->fails()) {
			redirect('admin/rights/' . $rights->id . '/edit')->withErrors($validator)->withInput();
		} else {
			$rights->group_name = request('group_name');
			$rights->allowed = join('|', request('rights'));
			$rights->disallowed = '';

			$rights->save();

			return redirect('/admin/rights')->with('message', 'Rechtengroep is aangepast en opgeslagen!');
		}
	}

	public function delete(Rights $rights) {
		$rights->delete();

		return redirect('/admin/rights')->with('message', 'Rechtengroep is verwijderd!');
	}
}
