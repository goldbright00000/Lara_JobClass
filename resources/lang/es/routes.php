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
    'countries' => 'paises',
	
	// Auth
    'login'    => 'login',
    'logout'   => 'cerrar-sesion',
    'register' => 'registrate',
	
	// Post
	'post'   => '{slug}/{id}.html',
	'v-post' => ':slug/:id.html',
	
	// Page
    'page'   => 'pagina/{slug}.html',
    't-page' => 'pagina',
    'v-page' => 'pagina/:slug.html',
	
	// Contact
    'contact' => 'contacto.html',
];

if (config('larapen.core.multiCountriesWebsite')) {
    // Sitemap
    $routesTab['sitemap'] = '{countryCode}/mapa-del-sitio.html';
    $routesTab['v-sitemap'] = ':countryCode/mapa-del-sitio.html';

    // Latest Ads
    $routesTab['search'] = '{countryCode}/busqueda';
    $routesTab['t-search'] = 'busqueda';
    $routesTab['v-search'] = ':countryCode/busqueda';

    // Search by Sub-Category
    $routesTab['search-subCat'] = '{countryCode}/trabajo-categoria/{catSlug}/{subCatSlug}';
    $routesTab['t-search-subCat'] = 'trabajo-categoria';
    $routesTab['v-search-subCat'] = ':countryCode/trabajo-categoria/:catSlug/:subCatSlug';

    // Search by Category
    $routesTab['search-cat'] = '{countryCode}/trabajo-categoria/{catSlug}';
    $routesTab['t-search-cat'] = 'trabajo-categoria';
    $routesTab['v-search-cat'] = ':countryCode/trabajo-categoria/:catSlug';

    // Search by Location
    $routesTab['search-city'] = '{countryCode}/trabajos/{city}/{id}';
    $routesTab['t-search-city'] = 'trabajos';
    $routesTab['v-search-city'] = ':countryCode/trabajos/:city/:id';

    // Search by User
    $routesTab['search-user'] = '{countryCode}/users/{id}/trabajos';
    $routesTab['t-search-user'] = 'users';
    $routesTab['v-search-user'] = ':countryCode/users/:id/trabajos';
	
	// Search by Username
	$routesTab['search-username'] = '{countryCode}/profile/{username}';
	$routesTab['v-search-username'] = ':countryCode/profile/:username';

    // Search by Company name
    $routesTab['search-company'] = '{countryCode}/companias/{id}/trabajos';
    $routesTab['t-search-company'] = 'companias-trabajos';
    $routesTab['v-search-company'] = ':countryCode/companias/:id/trabajos';
	$routesTab['companies-list'] = '{countryCode}/companias';
	
	// Search by Tag
	$routesTab['search-tag'] = '{countryCode}/tag/{tag}';
	$routesTab['t-search-tag'] = 'tag';
	$routesTab['v-search-tag'] = ':countryCode/tag/:tag';
} else {
    // Sitemap
    $routesTab['sitemap'] = 'mapa-del-sitio.html';
    $routesTab['v-sitemap'] = 'mapa-del-sitio.html';

    // Latest Ads
    $routesTab['search'] = 'busqueda';
    $routesTab['t-search'] = 'busqueda';
    $routesTab['v-search'] = 'busqueda';

    // Search by Sub-Category
    $routesTab['search-subCat'] = 'trabajo-categoria/{catSlug}/{subCatSlug}';
    $routesTab['t-search-subCat'] = 'trabajo-categoria';
    $routesTab['v-search-subCat'] = 'trabajo-categoria/:catSlug/:subCatSlug';

    // Search by Category
    $routesTab['search-cat'] = 'trabajo-categoria/{catSlug}';
    $routesTab['t-search-cat'] = 'trabajo-categoria';
    $routesTab['v-search-cat'] = 'trabajo-categoria/:catSlug';

    // Search by Location
    $routesTab['search-city'] = 'trabajos/{city}/{id}';
    $routesTab['t-search-city'] = 'trabajos';
    $routesTab['v-search-city'] = 'trabajos/:city/:id';

    // Search by User
    $routesTab['search-user'] = 'users/{id}/trabajos';
    $routesTab['t-search-user'] = 'users';
    $routesTab['v-search-user'] = 'users/:id/trabajos';
	
	// Search by Username
	$routesTab['search-username'] = 'profile/{username}';
	$routesTab['v-search-username'] = 'profile/:username';

    // Search by Company name
    $routesTab['search-company'] = 'companias/{id}/trabajos';
    $routesTab['t-search-company'] = 'companias-trabajos';
    $routesTab['v-search-company'] = 'companias/:id/trabajos';
	$routesTab['companies-list'] = 'companias';
	
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