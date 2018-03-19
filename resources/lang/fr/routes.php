<?php
/**
 * JobClass - Geolocalized Job Board Script
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

$routesTab = [
    /*
    |--------------------------------------------------------------------------
    | Routes Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the global website.
    |
    */
	
	// Countries
    'countries' => 'pays',
	
	// Auth
    'login'    => 'connexion',
    'logout'   => 'deconnexion',
    'register' => 'inscription',
	
	// Post
	'post'   => '{slug}/{id}.html',
	'v-post' => ':slug/:id.html',
	
	// Page
    'page'   => 'page/{slug}.html',
    't-page' => 'page',
    'v-page' => 'page/:slug.html',
	
	// Contact
    'contact' => 'contact.html',
];

if (config('larapen.core.multiCountriesWebsite')) {
    // Sitemap
    $routesTab['sitemap'] = '{countryCode}/plan-du-site.html';
    $routesTab['v-sitemap'] = ':countryCode/plan-du-site.html';

    // Latest Ads
    $routesTab['search'] = '{countryCode}/dernieres-offres';
    $routesTab['t-search'] = 'dernieres-offres';
    $routesTab['v-search'] = ':countryCode/dernieres-offres';

    // Search by Sub-Category
    $routesTab['search-subCat'] = '{countryCode}/categorie-emploi/{catSlug}/{subCatSlug}';
    $routesTab['t-search-subCat'] = 'categorie-emploi';
    $routesTab['v-search-subCat'] = ':countryCode/categorie-emploi/:catSlug/:subCatSlug';

    // Search by Category
    $routesTab['search-cat'] = '{countryCode}/categorie-emploi/{catSlug}';
    $routesTab['t-search-cat'] = 'categorie-emploi';
    $routesTab['v-search-cat'] = ':countryCode/categorie-emploi/:catSlug';

    // Search by Location
    $routesTab['search-city'] = '{countryCode}/offres-emploi/{city}/{id}';
    $routesTab['t-search-city'] = 'offres-emploi';
    $routesTab['v-search-city'] = ':countryCode/offres-emploi/:city/:id';

    // Search by User
    $routesTab['search-user'] = '{countryCode}/users/{id}/offres-emploi';
    $routesTab['t-search-user'] = 'users';
    $routesTab['v-search-user'] = ':countryCode/users/:id/offres-emploi';
	
	// Search by Username
	$routesTab['search-username'] = '{countryCode}/profile/{username}';
	$routesTab['v-search-username'] = ':countryCode/profile/:username';

    // Search by Company name
    $routesTab['search-company'] = '{countryCode}/entreprises/{id}/offres-emploi';
    $routesTab['t-search-company'] = 'entreprises-offres-emploi';
    $routesTab['v-search-company'] = ':countryCode/entreprises/:id/offres-emploi';
	$routesTab['companies-list'] = '{countryCode}/entreprises';
	
	// Search by Tag
	$routesTab['search-tag'] = '{countryCode}/mot-cle/{tag}';
	$routesTab['t-search-tag'] = 'mot-cle';
	$routesTab['v-search-tag'] = ':countryCode/mot-cle/:tag';
} else {
    // Sitemap
    $routesTab['sitemap'] = 'plan-du-site.html';
    $routesTab['v-sitemap'] = 'plan-du-site.html';

    // Latest Ads
    $routesTab['search'] = 'dernieres-offres';
    $routesTab['t-search'] = 'dernieres-offres';
    $routesTab['v-search'] = 'dernieres-offres';

    // Search by Sub-Category
    $routesTab['search-subCat'] = 'categorie-emploi/{catSlug}/{subCatSlug}';
    $routesTab['t-search-subCat'] = 'categorie-emploi';
    $routesTab['v-search-subCat'] = 'categorie-emploi/:catSlug/:subCatSlug';

    // Search by Category
    $routesTab['search-cat'] = 'categorie-emploi/{catSlug}';
    $routesTab['t-search-cat'] = 'categorie-emploi';
    $routesTab['v-search-cat'] = 'categorie-emploi/:catSlug';

    // Search by Location
    $routesTab['search-city'] = 'offres-emploi/{city}/{id}';
    $routesTab['t-search-city'] = 'offres-emploi';
    $routesTab['v-search-city'] = 'offres-emploi/:city/:id';

    // Search by User
    $routesTab['search-user'] = 'users/{id}/offres-emploi';
    $routesTab['t-search-user'] = 'users';
    $routesTab['v-search-user'] = 'users/:id/offres-emploi';
	
	// Search by Username
	$routesTab['search-username'] = 'profile/{username}';
	$routesTab['v-search-username'] = 'profile/:username';

    // Search by Company name
    $routesTab['search-company'] = 'entreprises/{id}/offres-emploi';
    $routesTab['t-search-company'] = 'entreprises-offres-emploi';
    $routesTab['v-search-company'] = 'entreprises/:id/offres-emploi';
	$routesTab['companies-list'] = 'entreprises';
	
	// Search by Tag
	$routesTab['search-tag'] = 'mot-cle/{tag}';
	$routesTab['t-search-tag'] = 'mot-cle';
	$routesTab['v-search-tag'] = 'mot-cle/:tag';
}

// Posts Permalink Collection
$vPost = config('larapen.core.permalink.posts');

// Posts Permalink
if (isset($vPost[config('settings.seo.posts_permalink', '{slug}/{id}')])) {
	$routesTab['post'] = config('settings.seo.posts_permalink', '{slug}/{id}') . config('settings.seo.posts_permalink_ext', '');
	$routesTab['v-post'] = $vPost[config('settings.seo.posts_permalink', '{slug}/{id}')] . config('settings.seo.posts_permalink_ext', '');
}

return $routesTab;