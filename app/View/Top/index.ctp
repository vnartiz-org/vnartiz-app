<!--
<section>
	<input type="text" placeholder="keyword" />
	<select>
		<option>All countries</option>
		<option>Vietnam</option>
		<option>United state</option>
		<option>United kingdom</option>
		<option>Japan</option>
	</select>
	<select>
		<option>All locations</option>
		<option>Hanoi</option>
		<option>Hochiminh</option>
		<option>Binh Thuan</option>
		<option>Ninh Thuan</option>
	</select>
	<select>
		<option>All fields</option>
		<option>Real estate</option>
		<option>Recruitment</option>
		<option>Photo</option>
	</select>
	<select>
		<option>All kind</option>
		<option>House</option>
		<option>Villa</option>
		<option>Office</option>
	</select>
	<button class="blue"><i class="icon_search"></i>Search</button>
</section>
-->
<section>
	<div class="row">
		<div class="col-sm-4">
			<a href="http://realestate.vnartiz.com" target="_blank">
				<img src="<?=$this->webroot?>files/img/logo-wre.png" /> <h2>World real estate</h2>
			</a>
			<p>
				<?=__('WRE briefly')?>
			</p>
		</div>
		<div class="col-sm-4">
			<a href="http://recruit.vnartiz.com" target="_blank">
				<img src="<?=$this->webroot?>files/img/logo-vi.png" /> <h2>ViRecruitment</h2>
			</a>
			<p>
				<?=__('Vi briefly')?>
			</p>
		</div>
		<div class="col-sm-4">
			<a href="http://color.vnartiz.com" target="_blank">
				<img src="<?=$this->webroot?>files/img/logo-iphoto.png" /> <h2>Color4Life</h2>
			</a>
			<p>
				<?=__('iphoto briefly')?>
			</p>
		</div>
	</div>
	
</section>
<h1><?=__('Real estate')?></h1>
<section>
	<div class="row" ng-controller="wreCtrl">
		<div class="col-sm-3" ng-repeat="x in data">
			<a class="item" href="{{ x.link }}" target="_blank">
				<article>
					<div class="square-box h-full">
						<img src="{{ x.path }}" />
					</div>
					<div class="p-10">
						<h3>{{ x.title }}</h3>
						<p>{{ x.summary }}</p>
					</div>
				</article>
			</a>
			
		</div>
	</div>
	<a href="http://realestate.vnartiz.com" class="read-more" title="Read more" target="_blank">Read more</a>
</section>
<h1><?=__('Recruitment')?></h1>
<section>
	<div class="row" ng-controller="viCtrl">
		<div class="col-sm-3" ng-repeat="z in vi">
			<a class="item" href="{{ z.link }}" target="_blank">
				<article>
					<figure class="mini-square-box">
						<img src="{{ z.logo }}" />
					</figure>
					<div class="p-10">
						<h3>{{ z.position }}</h3>
						<p>{{ z.address }}</p>
						<p>{{ z.description }}</p>
					</div>
				</article>
			</a>
			
		</div>
	</div>
	<a href="http://recruit.vnartiz.com" class="read-more" title="Read more" target="_blank">Read more</a>
</section>
<h1><?=__('Photo')?></h1>
<section>
	<div class="row" ng-controller="iphotoCtrl">
		<div class="col-sm-3" ng-repeat="y in iphoto">
			<a class="item" href="{{ y.link }}" target="_blank">
				<article>
					<figure class="square-box h-full">
						<img src="{{ y.path }}" />
					</figure>
					<div class="p-10">
						<h3>{{ y.title }}</h3>
						<p>{{ y.content }}</p>
						
					</div>
				</article>
			</a>
		</div>
	</div>
	<a href="http://color.vnartiz.com/album.html" class="read-more" title="Read more" target="_blank">Read more</a>
</section>
<h1><?=__('Movie')?></h1>
<section>
	<div class="row" ng-controller="movieCtrl">
		<div class="col-sm-3" ng-repeat="k in movie">
			<a class="item" href="{{ k.link }}" target="_blank">
				<article>
					<figure class="square-box h-full">
						<img src="{{ k.path }}" />
					</figure>
					<div class="p-10">
						<h3>{{ k.title }}</h3>
						<p>{{ k.content }}</p>
					</div>
				</article>
			</a>
			
		</div>
	</div>
	<a href="http://color.vnartiz.com/movie.html" class="read-more" title="Read more" target="_blank">Read more</a>
</section>
<h1><?=__('Music')?></h1>
<section>
	<div class="row" ng-controller="musicCtrl">
		<div class="col-sm-3" ng-repeat="y in music">
			<a class="item" href="{{ y.link }}" target="_blank">
				<article>
					<figure class="square-box h-full">
						<img src="{{ y.path }}" />
					</figure>
					<div class="p-10">
						<h3>{{ y.title }}</h3>
						<p>{{ y.content }}</p>
					</div>
				</article>
			</a>
			
		</div>
	</div>
	<a href="http://color.vnartiz.com/music.html" class="read-more" title="Read more" target="_blank">Read more</a>
</section>