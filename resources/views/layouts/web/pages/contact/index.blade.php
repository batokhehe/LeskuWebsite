@extends('layouts.web.master.master_2')
@section('content')
<div class="contact">
		<div class="container">
			<h3 class="tittle-agileits-w3layouts">Get in touch</h3>
			<div class="agile_banner_bottom_grids">
				<div class="col-md-4 w3_agile_contact_grid">
					<div class="col-xs-4 agile_contact_grid_left">
						<i class="fa fa-map-marker" aria-hidden="true"></i>
					</div>
					<div class="col-xs-8 agile_contact_grid_right agilew3_contact">
						<h4>Address</h4>
						<p>435 City hall, NewYork City SD092.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 w3_agile_contact_grid">
					<div class="col-xs-4 agile_contact_grid_left agileits_w3layouts_left">
						<i class="fa fa-mobile" aria-hidden="true"></i>
					</div>
					<div class="col-xs-8 agile_contact_grid_right agileits_w3layouts_right">
						<h4>Phone</h4>
						<p>+00 097 338 004<span>+00 505 222 606</span></p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 w3_agile_contact_grid">
					<div class="col-xs-4 agile_contact_grid_left ">
						<i class="fa fa-envelope-o" aria-hidden="true"></i>
					</div>
					<div class="col-xs-8 agile_contact_grid_right ">
						<h4>Email</h4>
						<p><a href="mailto:info@example.com">info@example1.com</a>
							<span><a href="mailto:info@example.com">info@example2.com</a></span></p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="agile_banner_bottom_grids w3agileits-ref">
				<form action="#" method="post">
					<div class="col-md-6 w3_agileits_contact_left">
						<span class="input input--akira">
							<input class="input__field input__field--akira" type="text" id="input-22" name="Name" placeholder="" required="" />
							<label class="input__label input__label--akira" for="input-22">
								<span class="input__label-content input__label-content--akira">Your name</span>
							</label>
						</span>
						<span class="input input--akira">
							<input class="input__field input__field--akira" type="email" id="input-23" name="Email" placeholder="" required="" />
							<label class="input__label input__label--akira" for="input-23">
								<span class="input__label-content input__label-content--akira">Your email</span>
							</label>
						</span>
						<span class="input input--akira">
							<input class="input__field input__field--akira" type="text" id="input-24" name="Subject" placeholder="" required="" />
							<label class="input__label input__label--akira" for="input-24">
								<span class="input__label-content input__label-content--akira">Your subject</span>
							</label>
						</span>
					</div>
					<div class="col-md-6 w3_agileits_contact_right">
						<div class="w3_agileits_contact_right1">
							<textarea name="Message" placeholder="Your comment here..." required=""></textarea>
						</div>
						<div class="w3_agileits_contact_right2">
							<input type="submit" value="Send">
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
				</form>
			</div>
		</div>
	</div>
	<div class="map-agileits">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24804.011287515073!2d-77.42088058957434!3d39.00387414146245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b6384f20fb61ad%3A0x5bfd0cf0a55864c!2sSterling%2C+VA%2C+USA!5e0!3m2!1sen!2sin!4v1487219294651"></iframe>
	</div>
@endsection
