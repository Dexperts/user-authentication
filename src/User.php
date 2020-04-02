<?php

namespace Dexperts\Authentication;

class User extends \App\User
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'type'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token', 'type'
	];

	public function canEdit() {
		return $this->type == 'admin';
	}

	public function getLatestChange() {
		return $this->updated_at ? $this->updated_at->diffForHumans() : $this->created_at->diffForHumans();
	}

	public function rights() {
		return $this->belongsTo('Dexperts\Authentication\Rights');
	}
}
