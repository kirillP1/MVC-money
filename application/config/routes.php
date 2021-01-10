<?php

return [
	// MainController
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],


	// AccounControlelr
	'account/login' => [
		'controller' => 'account',
		'action' => 'login',
	],
	'account/register' => [
		'controller' => 'account',
		'action' => 'register',
	],
	'account/register/{ref:.+}' => [
		'controller' => 'account',
		'action' => 'register',
	],
	'account/recovery' => [
		'controller' => 'account',
		'action' => 'recovery',
	],
	'account/profile' => [
		'controller' => 'account',
		'action' => 'profile',
	],
	'account/logout' => [
		'controller' => 'account',
		'action' => 'logout',
	],
	'account/confirm' => [
		'controller' => 'account',
		'action' => 'confirm',
	],
	'account/confirm/{token:.+}' => [
		'controller' => 'account',
		'action' => 'confirm',
	],
	'account/reset/{token:.+}' => [
		'controller' => 'account',
		'action' => 'reset',
	],

	// MerchantController
	'merchant/perfectmoney' => [
		'controller' => 'merchant',
		'action' => 'perfectmoney',
	],

	// AdminController
	'admin' => [
		'controller' => 'admin',
		'action' => 'index',
	],
	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],
	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],
	'admin/withdraw' => [
		'controller' => 'admin',
		'action' => 'withdraw',
	],
	'admin/history' => [
		'controller' => 'admin',
		'action' => 'history',
	],
	'admin/tariffs' => [
		'controller' => 'admin',
		'action' => 'tariffs',
	],
	'admin/withdraw/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'withdraw',
	],
	'admin/history/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'history',
	],
	'admin/tariffs/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'tariffs',
	],
	
	// DashboardController
	'dashboard/tariffs' => [
		'controller' => 'dashboard',
		'action' => 'tariffs',
	],
	'dashboard/tariffs/{page:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'tariffs',
	],
	'dashboard/invest/{id:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'invest',
	],
	'dashboard/history' => [
		'controller' => 'dashboard',
		'action' => 'history',
	],
	'dashboard/history/{page:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'history',
	],
	'dashboard/referrals' => [
		'controller' => 'dashboard',
		'action' => 'referrals',
	],
	'dashboard/referrals/{page:\d+}' => [
		'controller' => 'dashboard',
		'action' => 'referrals',
	],
];