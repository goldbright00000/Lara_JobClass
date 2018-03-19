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

namespace App\Http\Controllers;

/*
 * Increase PHP page execution time for this controller.
 * NOTE: This function has no effect when PHP is running in safe mode (http://php.net/manual/en/ini.sect.safe-mode.php#ini.safe-mode).
 * There is no workaround other than turning off safe mode or changing the time limit (max_execution_time) in the php.ini.
 */
set_time_limit(0);

use App\Helpers\Localization\Helpers\Country as CountryLocalizationHelper;
use App\Helpers\Localization\Country as CountryLocalization;
use App\Models\Category;
use App\Models\Page;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\City;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Watson\Sitemap\Facades\Sitemap;

class SitemapsController extends FrontController
{
    protected $defaultDate = '2015-10-30T20:10:00+02:00';

    /**
     * SitemapsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        
        // Get Countries
        $this->countries = CountryLocalizationHelper::transAll(CountryLocalization::getCountries());

		// From Laravel 5.3.4 or above
		$this->middleware(function ($request, $next) {
			$this->commonQueries();
			return $next($request);
		});
    }

	/**
	 * Common Queries
	 */
	public function commonQueries()
	{
		// Set the App Language
		App::setLocale(config('app.locale'));

		// Date : Carbon object
		$this->defaultDate = Carbon::parse(date('Y-m-d H:i'));
		if (config('timezone.id')) {
			$this->defaultDate->timezone(config('timezone.id'));
		}
	}
    
    /**
     * Index Sitemap
     * @return mixed
     */
    public function index()
    {
        foreach ($this->countries as $item) {
            $country = CountryLocalization::getCountryInfo($item->get('code'));
            Sitemap::addSitemap(url($country->get('lang')->get('abbr') . '/' . $country->get('icode') . '/sitemaps.xml'));
        }
        
        return Sitemap::index();
    }
    
    /**
     * Index Sitemap
     * @return mixed
     */
    public function site()
    {
    	if (empty(config('country.code'))) {
    		return false;
		}
		
        Sitemap::addSitemap(url(config('app.locale') . '/' . config('country.icode') . '/sitemaps/pages.xml'));
        Sitemap::addSitemap(url(config('app.locale') . '/' . config('country.icode') . '/sitemaps/categories.xml'));
        Sitemap::addSitemap(url(config('app.locale') . '/' . config('country.icode') . '/sitemaps/cities.xml'));

        $countPosts = Post::verified()->currentCountry()->count();
        if ($countPosts > 0) {
            Sitemap::addSitemap(url(config('app.locale') . '/' . config('country.icode') . '/sitemaps/posts.xml'));
        }
        
        return Sitemap::index();
    }
    
    /**
     * @return mixed
     */
    public function pages()
    {
		if (empty(config('country.code'))) {
			return false;
		}
		
		$queryString = '?d=' . config('country.code');
		
        Sitemap::addTag(lurl('/' . $queryString), $this->defaultDate, 'daily', '1.0');
        $attr = ['countryCode' => config('country.icode')];
        Sitemap::addTag(lurl(trans('routes.v-sitemap', $attr) . $queryString, $attr), $this->defaultDate, 'daily', '0.5');
        Sitemap::addTag(lurl(trans('routes.v-search', $attr) . $queryString, $attr), $this->defaultDate, 'daily', '0.6');
    
        $pages = Cache::remember('pages.' . config('app.locale'), $this->cacheExpiration, function () {
            $pages = Page::trans()->orderBy('lft', 'ASC')->get();
            return $pages;
        });
        
        if ($pages->count() > 0) {
            foreach($pages as $page) {
            	$attr = ['slug' => $page->slug];
                Sitemap::addTag(lurl(trans('routes.v-page', $attr), $attr), $this->defaultDate, 'daily', '0.7');
            }
        }

        Sitemap::addTag(lurl(trans('routes.contact') . $queryString), $this->defaultDate, 'daily', '0.7');
        
        return Sitemap::render();
    }

    /**
     * @return mixed
     */
    public function categories()
    {
		if (empty(config('country.code'))) {
			return false;
		}
		
        // Categories
        $cacheId = 'categories.' . config('app.locale') . '.all';
        $cats = Cache::remember($cacheId, $this->cacheExpiration, function () {
            $cats = Category::trans()->orderBy('lft')->get();
            return $cats;
        });

        if ($cats->count() > 0) {
            $cats = collect($cats)->keyBy('translation_of');
            $cats = $subCats = $cats->groupBy('parent_id');
            $cats = $cats->get(0);
            $subCats = $subCats->forget(0);

            foreach ($cats as $cat) {
            	$attr = ['countryCode' => config('country.icode'), 'catSlug' => $cat->slug];
                Sitemap::addTag(lurl(trans('routes.v-search-cat', $attr), $attr), $this->defaultDate, 'daily', '0.8');
                if ($subCats->get($cat->id)) {
                    foreach ($subCats->get($cat->id) as $subCat) {
                    	$attr = [
							'countryCode' => config('country.icode'),
							'catSlug'     => $cat->slug,
							'subCatSlug'  => $subCat->slug
						];
                        Sitemap::addTag(lurl(trans('routes.v-search-subCat', $attr), $attr), $this->defaultDate, 'weekly', '0.5');
                    }
                }
            }
        }

        return Sitemap::render();
    }
    
    /**
     * @return mixed
     */
    public function cities()
    {
		if (empty(config('country.code'))) {
			return false;
		}
		
        $limit = 1000;
        $cacheId = config('country.code') . '.cities.take.' . $limit;
        $cities = Cache::remember($cacheId, $this->cacheExpiration, function () use($limit) {
            $cities = City::currentCountry()->take($limit)->orderBy('population', 'DESC')->orderBy('name')->get();
            return $cities;
        });

        if ($cities->count() > 0) {
            foreach($cities as $city) {
                $city->name = trim(head(explode('/', $city->name)));
                $attr = [
					'countryCode' => config('country.icode'),
					'city'        => slugify($city->name),
					'id'          => $city->id
				];
                Sitemap::addTag(url(trans('routes.v-search-city', $attr), $attr), $this->defaultDate, 'weekly', '0.7');
            }
        }
        
        return Sitemap::render();
    }
    
    /**
     * @return mixed
     */
    public function posts()
    {
		if (empty(config('country.code'))) {
			return false;
		}
		
        $limit = 50000;
        $cacheId = config('country.code') . '.sitemaps.posts.xml';
        $posts = Cache::remember($cacheId, $this->cacheExpiration, function () use($limit) {
            $posts = Post::verified()->currentCountry()->take($limit)->orderBy('created_at', 'DESC')->get();
            return $posts;
        });
        
        if ($posts->count() > 0) {
            foreach ($posts as $post) {
                Sitemap::addTag(lurl($post->uri), $post->created_at, 'daily', '0.6');
            }
        }
        
        return Sitemap::render();
    }
}
