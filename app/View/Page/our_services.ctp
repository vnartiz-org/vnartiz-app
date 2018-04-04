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
			<a href="http://realestate.vnartistworld.com" target="_blank">
				<img src="<?=$this->webroot?>files/img/logo-wre.png" /> <h2>World real estate</h2>
			</a>
			<p>
				World real estate la web ứng dụng - môi trường làm việc cho tất cả mọi người. Cung cấp bộ cung cụ nâng cấp doanh nghiệp đến cấp độ cao hơn. Chia sẽ thông tin và dữ liệu để dễ dàng tiếp cận khách hàng và nhiều hơn nữa...
			</p>
		</div>
		<div class="col-sm-4">
			<a href="http://recruit.vnartistworld.com" target="_blank">
				<img src="<?=$this->webroot?>files/img/logo-vi.png" /> <h2>ViRecruitment</h2>
			</a>
			<p>
				Chúng tôi là một nhóm các nhà thiết kế và lập trình viên. Chúng tôi xây dựng các ứng dụng công nghệ thông tin cho công việc kinh doanh của doanh nghiệp, cho các cá nhân và cho cuộc sống tốt đẹp hơn...
			</p>
		</div>
		<div class="col-sm-4">
			<a href="http://iphoto.vnartistworld.com" target="_blank">
				<img src="<?=$this->webroot?>files/img/logo-iphoto.png" /> <h2>iPhoto</h2>
			</a>
			<p>
				iPhoto là mái ấm để lưu trữ những kỷ niệm đẹp, khoảng khắc vui buồn của cuộc sống. 
				Hãy chia sẻ những suy nghĩ, tâm tư và niềm đam mê của bạn...
			</p>
		</div>
	</div>
</section>
<section>
	<a href="http://realestate.vnartistworld.com" target="_blank"><h1>Real estate</h1></a>
	<div class="row" ng-controller="wreCtrl">
		<div class="col-sm-3" ng-repeat="x in data">
			<a href="{{ x.link }}" target="_blank">
				<div class="square-box h-full">
					<img src="{{ x.path }}" />
				</div>
				<h3>{{ x.title }}</h3>
			</a>
			<p>{{ x.summary }}</p>
		</div>
	</div>
	
</section>
<section>
	<a href="http://recruit.vnartistworld.com" target="_blank"><h1>Recruitment</h1></a>
	<div class="row" ng-controller="viCtrl">
		<div class="col-sm-3" ng-repeat="z in vi">
			<a href="{{ z.link }}" target="_blank">
				<div class="mini-square-box">
					<img src="{{ z.logo }}" />
				</div>
				<h3>{{ z.position }}</h3>
			</a>
			<p>{{ z.address }}</p>
		</div>
	</div>
</section>
<section>
	<a href="http://iphoto.vnartistworld.com" target="_blank"><h1>Photo sharing network</h1></a>
	<div class="row" ng-controller="iphotoCtrl">
		<div class="col-sm-3" ng-repeat="y in iphoto">
			<a href="{{ y.link }}" target="_blank">
				<div class="square-box h-full">
					<img src="{{ y.path }}" />
				</div>
				<h3>{{ y.title }}</h3>
			</a>
			<p>{{ y.content }}</p>
		</div>
	</div>
</section>