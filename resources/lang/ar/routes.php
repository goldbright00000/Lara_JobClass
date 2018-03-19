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
    'countries' => 'countries',
	
	// Auth
    'login'    => 'login',
    'logout'   => 'logout',
    'register' => 'register',
	
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
    $routesTab['sitemap'] = '{countryCode}/sitemap.html';
    $routesTab['v-sitemap'] = ':countryCode/sitemap.html';

    // Latest Ads
    $routesTab['search'] = '{countryCode}/latest-jobs';
    $routesTab['t-search'] = 'latest-jobs';
    $routesTab['v-search'] = ':countryCode/latest-jobs';

    // Search by Sub-Category
    $routesTab['search-subCat'] = '{countryCode}/job-category/{catSlug}/{subCatSlug}';
    $routesTab['t-search-subCat'] = 'job-category';
    $routesTab['v-search-subCat'] = ':countryCode/job-category/:catSlug/:subCatSlug';

    // Search by Category
    $routesTab['search-cat'] = '{countryCode}/job-category/{catSlug}';
    $routesTab['t-search-cat'] = 'job-category';
    $routesTab['v-search-cat'] = ':countryCode/job-category/:catSlug';

    // Search by Location
    $routesTab['search-city'] = '{countryCode}/jobs/{city}/{id}';
    $routesTab['t-search-city'] = 'jobs';
    $routesTab['v-search-city'] = ':countryCode/jobs/:city/:id';

    // Search by User
    $routesTab['search-user'] = '{countryCode}/users/{id}/jobs';
    $routesTab['t-search-user'] = 'users';
    $routesTab['v-search-user'] = ':countryCode/users/:id/jobs';
	
	// Search by Username
	$routesTab['search-username'] = '{countryCode}/profile/{username}';
	$routesTab['v-search-username'] = ':countryCode/profile/:username';

    // Search by Company name
    $routesTab['search-company'] = '{countryCode}/companies/{id}/jobs';
    $routesTab['t-search-company'] = 'companies-jobs';
    $routesTab['v-search-company'] = ':countryCode/companies/:id/jobs';
	$routesTab['companies-list'] = '{countryCode}/companies';
	
	// Search by Tag
	$routesTab['search-tag'] = '{countryCode}/tag/{tag}';
	$routesTab['t-search-tag'] = 'tag';
	$routesTab['v-search-tag'] = ':countryCode/tag/:tag';
} else {
    // Sitemap
    $routesTab['sitemap'] = 'sitemap.html';
    $routesTab['v-sitemap'] = 'sitemap.html';

    // Latest Ads
    $routesTab['search'] = 'latest-jobs';
    $routesTab['t-search'] = 'latest-jobs';
    $routesTab['v-search'] = 'latest-jobs';

    // Search by Sub-Category
    $routesTab['search-subCat'] = 'job-category/{catSlug}/{subCatSlug}';
    $routesTab['t-search-subCat'] = 'job-category';
    $routesTab['v-search-subCat'] = 'job-category/:catSlug/:subCatSlug';

    // Search by Category
    $routesTab['search-cat'] = 'job-category/{catSlug}';
    $routesTab['t-search-cat'] = 'job-category';
    $routesTab['v-search-cat'] = 'job-category/:catSlug';

    // Search by Location
    $routesTab['search-city'] = 'jobs/{city}/{id}';
    $routesTab['t-search-city'] = 'jobs';
    $routesTab['v-search-city'] = 'jobs/:city/:id';

    // Search by User
    $routesTab['search-user'] = 'users/{id}/jobs';
    $routesTab['t-search-user'] = 'users';
    $routesTab['v-search-user'] = 'users/:id/jobs';
	
	// Search by Username
	$routesTab['search-username'] = 'profile/{username}';
	$routesTab['v-search-username'] = 'profile/:username';

    // Search by Company name
    $routesTab['search-company'] = 'companies/{id}/jobs';
    $routesTab['t-search-company'] = 'companies-jobs';
    $routesTab['v-search-company'] = 'companies/:id/jobs';
	$routesTab['companies-list'] = 'companies';
	
	// Search by Tag
	$routesTab['search-tag'] = 'tag/{tag}';
	$routesTab['t-search-tag'] = 'tag';
	$routesTab['v-search-tag'] = 'tag/:tag';
}

// Posts Permalink Collection
$vPost = config('larapen.core.permalink.posts');

// Posts Permalink
if (isset($vPost[config('settings.seo.posts_permalink', '{slug}/{id}')])) {
	$routesTab['post'] = config('settings.seo.posts_permalink', '{slug}/{id}') . config('settings.seo.posts_permalink_ext', '');
	$routesTab['v-post'] = $vPost[config('settings.seo.posts_permalink', '{slug}/{id}')] . config('settings.seo.posts_permalink_ext', '');
}

return $routesTab;