<?php

namespace Dexperts\Authentication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Rights extends Model
{
	public static function getModules() {
		$availableModules = config('authentication.modules');
		$currentLocale = config('authentication.locale');
		$usedModules = [];
		foreach($availableModules as $module) {
			array_push($usedModules, config('authentication.modules_lang')[$currentLocale][$module]);
		}
		return $usedModules;
	}
	public static function getAvailableRights() {
		$currentLocale = config('authentication.locale');
		return [
			'admin' => config('authentication.actions_lang')[$currentLocale]['admin'],
			'read' => config('authentication.actions_lang')[$currentLocale]['read'],
			'create' => config('authentication.actions_lang')[$currentLocale]['create'],
			'update' => config('authentication.actions_lang')[$currentLocale]['update'],
			'delete' => config('authentication.actions_lang')[$currentLocale]['delete']
		];
	}

	public const users = 'users';
	public const rights = 'rights';
	public const products = 'products';
	public const categories = 'categories';
	public const blogs = 'blogs';
	public const trends = 'trends';
	public const locations = 'locations';
	public const legislations = 'legislations';
	public const calculator = 'calculator';
	public const appointments = 'appointments';
	public const customers = 'customers';
	public const orders = 'orders';
	public const pages = 'pages';

	public const admin = 'admin';
	public const read = 'read';
	public const create = 'create';
	public const update = 'update';
	public const delete = 'delete';

	public static function isAllowed($module, $action, $userId = null) {
		if ($userId == null) {
			$userId = Auth::user()->id;
		}
		$user = User::with('rights')->find($userId);
		if ($user->type == 'admin') {
		    return true;
        }
		$neededRights = strtolower($module) . '-' . strtolower($action);
		$userAllowedTo = [];
		if ($user->rights && $user->rights->allowed) {
            $userAllowedTo = explode('|', $user->rights->allowed);
        }


		if ($action == null) {
			if (in_array('admin', $userAllowedTo)) {
				return true;
			} else if (self::hasModuleRights($module, $userAllowedTo)) {
				return true;
			}
			return false;
		}

		if (in_array('admin', $userAllowedTo)) {
			return true;
		} else if (in_array($neededRights, $userAllowedTo)) {
			return true;
		}
		return false;
	}

	private static function hasModuleRights($module, $allowed) {
		foreach($allowed as $allow) {
			if (strstr($allow, $module)) {
				return true;
			}
		}
		return false;
	}

	public static function hasAdmin($allowed) {
		return $allowed == 'admin';
	}

	public function getLatestChange() {
		return $this->updated_at ? $this->updated_at->diffForHumans() : $this->created_at->diffForHumans();
	}

	public function created_by() {
		return $this->hasOne('Dexperts\Authentication\User');
	}
}
