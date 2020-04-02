<?php

namespace Dexperts\Authentication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Rights extends Model
{
	public static function getModules() {
		return [
			'users' => __('admin/rights.modules.users'),
			'subscriptions' => __('admin/rights.modules.subscriptions'),
			'pages' => __('admin/rights.modules.pages'),
			'editions' => __('admin/rights.modules.editions'),
			'reserves' => __('admin/rights.modules.reserves'),
			'teams' => __('admin/rights.modules.teams'),
			'media' => __('admin/rights.modules.media')
		];
	}
	public static function getAvailableRights() {
		return [
			'admin' => __('admin/rights.rights.admin'),
			'read' => __('admin/rights.rights.read'),
			'create' => __('admin/rights.rights.create'),
			'update' => __('admin/rights.rights.update'),
			'delete' => __('admin/rights.rights.delete')
		];
	}

	public const moduleUsers = 'users';
	public const moduleSubscriptions = 'subscriptions';
	public const modulePages = 'pages';
	public const moduleEditions = 'editions';
	public const moduleReserves = 'reserves';
	public const moduleTeams = 'teams';
	public const moduleMedia = 'media';

	public const admin = 'admin';
	public const read = 'read';
	public const create = 'create';
	public const update = 'update';
	public const delete = 'delete';

	public const onlyTeamMutations = 5;
	public const mainParticipant = 'only-team-mutations';

	public static function isAllowed($module, $action, $userId = null) {
		if ($userId == null) {
			$userId = Auth::user()->id;
		}
		$user = User::with('rights')->find($userId);
		$neededRights = strtolower($module) . '-' . strtolower($action);
		$userAllowedTo = explode('|', $user->rights->allowed);

		if (in_array(self::mainParticipant, $userAllowedTo)) {
			if ($module == "subscriptions" && $action == "read") {
				return true;
			}
			return false;
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

	public function author() {
		return $this->hasOne('Dexperts\Authentication\User');
	}
}
