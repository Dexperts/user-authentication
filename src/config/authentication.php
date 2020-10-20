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

	'locale' => env('locale', 'en'),
	'table_name' => 'users',
	'modules' => ['users', 'rights','products', 'categories', 'blogs', 'trends', 'locations', 'legislation', 'calculator', 'appointments', 'customers', 'orders', 'pages'],
	'modules_lang' => [
		'en' => [
			'users' => 'Users',
			'rights' => 'Rights',
			'products' => 'Products',
            'categories' => 'Categories',
            'blogs' => 'Blogs',
            'trends' => 'Trends',
            'locations' => 'Locations',
            'legislations' => 'Legislations',
            'calculator' => 'Calculator option',
            'appointments' => 'Appointments',
            'customers' => 'Customers',
            'orders' => 'Orders',
            'pages' => 'Pages'
		],
		'nl' => [
			'users' => 'Gebruikers',
			'rights' => 'Rechten',
			'products' => 'Producten',
            'categories' => 'Categorieen',
            'blogs' => 'Blogs',
            'trends' => 'Trends',
            'locations' => 'Locaties',
            'legislations' => 'Wetgeving',
            'calculator' => 'Calculatie opties',
            'appointments' => 'Afspraken',
            'customers' => 'Klanten',
            'orders' => 'Bestellingen',
            'pages' => 'Pagina\'s'
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
