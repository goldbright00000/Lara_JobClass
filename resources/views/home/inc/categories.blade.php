@include('home.inc.spacer')
<div class="container">
	<div class="col-lg-12 content-box layout-section">
		<div class="row row-featured row-featured-category">
			<div class="col-lg-12 box-title no-border">
				<div class="inner">
					<h2>
						<span class="title-3">{{ t('Browse by') }} <span style="font-weight: bold;">{{ t('Category') }}</span></span>
						<?php $attr = ['countryCode' => config('country.icode')]; ?>
						<a href="{{ lurl(trans('routes.v-sitemap', $attr), $attr) }}" class="sell-your-item">
							{{ t('View more') }} <i class="icon-th-list"></i>
						</a>
					</h2>
				</div>
			</div>
	
			@if (isset($categories) and $categories->count() > 0)
			<div style="padding: 0 10px 0 20px;">
				@foreach ($categories as $key => $items)
					<ul class="cat-list list list-check col-xs-4 {{ (count($categories) == $key+1) ? 'cat-list-border' : '' }}" style="padding: 25px;">
						@foreach ($items as $k => $cat)
							<li>
								<?php $attr = ['countryCode' => config('country.icode'), 'catSlug' => $cat->slug]; ?>
								<a href="{{ lurl(trans('routes.v-search-cat', $attr), $attr) }}">
									{{ $cat->name }}
								</a>
							</li>
						@endforeach
					</ul>
				@endforeach
			</div>
			@endif
	
		</div>
	</div>
</div>
