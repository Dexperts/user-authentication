<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Authentication package Configuration
	|--------------------------------------------------------------------------
	|
	| Here you may configure your settings for the authentication package
	|
	*/

	'locale' => 'en',
	'table_name' => 'users',
	'modules' => ['users', 'rights','products'],
	'modules_lang' => [
		'en' => [
			'users' => 'Users',
			'rights' => 'Rights',
			'products' => 'Products'
		],
		'nl' => [
			'users' => 'Gebruikers',
			'rights' => 'Rechten',
			'products' => 'Producten'
		]
	],
	'actions' => ['admin', 'read', 'create', 'update', 'delete'],
	'actions_lang'=> [
		'en' => [
			'admin' => 'All rights',
			'read' => 'Read',
			'create' => 'Create',
			'update' => 'Update',
			'delete' => 'Delete'
		],
		'nl' => [
			'admin' => 'Alle rechten',
			'read' => 'Inzien',
			'create' => 'Aanmaken',
			'update' => 'Aanpassen',
			'delete' => 'Verwijderen'
		]
	]

];