<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>@yield('pageTitle')</title>

		<!-- Site favicon -->
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="/images/site/{{ get_settings()->site_favicon }}"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="/back/vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="/back/src/plugins/jquery-steps/jquery.steps.css"
		/>
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />

		<!-- Global site tag (gtag.js) - Google Analytics 
		<script
			async
			src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
		></script>
		<script
			async
			src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
			crossorigin="anonymous"
		></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>-->
		<!-- Google Tag Manager 
		<script>
			(function (w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != "dataLayer" ? "&l=" + l : "";
				j.async = true;
				j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
		</script>
		 End Google Tag Manager -->
        @stack('stylesheets')
	</head>

	<body class="login-page">
		<div class="login-header box-shadow">
			<div
				class="container-fluid d-flex justify-content-between align-items-center"
			>
				<div class="brand-logo">
					<a href="{{ route('client.login') }}">
						<img src="/images/site/{{ get_settings()->site_logo }}" alt="" />
					</a>
				</div>
				<div class="login-menu">
					<ul>
						<li><a href="{{ route('client.login') }}">Login</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div
			class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-7">
						<img src="/back/vendors/images/register-page-img.png" alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						@if ($errors->any())
						<div class="d-block text-danger">
							@foreach ($errors->all() as $error)
							<li>
								{{ $error }}
							</li> 
							@endforeach
						</div>							
						@endif
						<div class="register-box bg-white box-shadow border-radius-10">
							<div class="wizard-content">
								<form class="tab-wizard2 wizard-circle wizard" action="{{ route('client.save-client') }}" method="POST" id="step_form" >
									@csrf
									<h5>Basic Account Credentials</h5>
									<section>
										<div class="form-wrap max-width-600 mx-auto">
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Email Address*</label>
												<div class="col-sm-8">
													<input type="email" class="form-control" name="email" id="email" />
												</div>
                                                <span class="text-danger" id="error-email"></span>
                                            </div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Username*</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"  name="username" id="username"/>
												</div>
                                                <span class="text-danger" id="error-username"></span>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Password*</label>
												<div class="col-sm-8">
													<input type="password" class="form-control"  name="password" id="password"/>
												</div>
                                                <span class="text-danger" id="error-password"></span>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Confirm Password*</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="password_confirmation" id="password_confirmation"/>
												</div>
                                                <span class="text-danger" id="error-password_confirmation"></span>
											</div>
										</div>
									</section>
									<!-- Step 2 -->
									<h5>Personal Information</h5>
									<section>
										<div class="form-wrap max-width-600 mx-auto">
											<div class="form-group row">
												<label class="col-sm-4 col-form-label"
													>Full Name*</label
												>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="name" id="name"/>
												</div>
												<span class="text-danger" id="error-name"></span>
											</div>
											<div class="form-group row align-items-center">
												<label class="col-sm-4 col-form-label">Gender*</label>
												<div class="col-sm-8">
													<div
														class="custom-control custom-radio custom-control-inline pb-0"
													>
														<input
															type="radio"
															id="male"
															name="gender"
															value="male"
															onfocus="$('#seller_gender').val('male')"
															class="custom-control-input"
														/>
														<label class="custom-control-label" for="male"
															>Male</label
														>
													</div>
													<div
														class="custom-control custom-radio custom-control-inline pb-0"
													>
														<input
															type="radio"
															id="female"
															name="gender"
															value="female"
															class="custom-control-input"
															onfocus="$('#seller_gender').val('female')"
														/>
														<label class="custom-control-label" for="female"
															>Female</label
														>
													</div>
												</div>
												<span class="text-danger" id="error-gender"></span>
												<input type="hidden" name="seller_gender" id="seller_gender">
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">City</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="city" id="city"/>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">State</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="state" id="state"/>
												</div>
											</div>
										</div>
									</section>
									<!-- Step 3 -->
									<h5>Payment Method & Info</h5>
									<section>
										<div class="form-wrap max-width-600 mx-auto">
											<div class="form-group row">
												<label class="col-sm-4 col-form-label"
													>Credit Card Type</label
												>
												<div class="col-sm-8">
													<select
														class="form-control selectpicker"
														name="payment_method_id"
														id="payment_method_id"
													>
													    <option value="1">Select Card Type</option>
													    
													</select>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label class="col-sm-4 col-form-label"
													>Credit Card Number</label
												>
												<div class="col-sm-8">
													<input type="text" name="card_number" id="card_number" class="form-control" />
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">CVC</label>
												<div class="col-sm-3">
													<input type="text" name="cvc" id="cvc" class="form-control" />
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label"
													>Expiration Date</label
												>
												<div class="col-sm-8">
													<div class="row">
														<div class="col-6">
															<select
																class="form-control selectpicker"
																data-size="5"
																name="month"
																id="month"
															>
															    <option value="0">Month</option>
																<option value="01">January</option>
																<option value="02">February</option>
																<option value="03">March</option>
																<option value="04">April</option>
																<option value="05">May</option>
																<option value="06">June</option>
																<option value="07">July</option>
																<option value="08">August</option>
																<option value="09">September</option>
																<option value="10">October</option>
																<option value="11">November</option>
																<option value="12">December</option>
															</select>
														</div>
														<div class="col-6">
															<select
																class="form-control selectpicker"
																data-size="5"
																name="year"
																id="year"
															>
															    <option value="0">Year</option>
																<option value="2035">2035</option>
																<option value="2034">2034</option>
																<option value="2033">2033</option>
																<option value="2032">2032</option>
																<option value="2031">2031</option>
																<option value="2030">2030</option>
																<option value="2029">2029</option>
																<option value="2028">2028</option>
																<option value="2027">2027</option>
																<option value="2026">2026</option>
																<option value="2025">2025</option>
																<option value="2024">2024</option>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
									<!-- Step 4 -->
									<h5>Ovrview Information</h5>
									<section>
										<div class="form-wrap max-width-600 mx-auto">
											<ul class="register-info">
												<li>
													<div class="row">
														<div class="col-sm-4 weight-600">Email Address</div>
														<div class="col-sm-8" id="email-review">example@abc.com</div>
													</div>
												</li>
												<li>
													<div class="row">
														<div class="col-sm-4 weight-600">Username</div>
														<div class="col-sm-8" id="username-review">Example</div>
													</div>
												</li>
												<li>
													<div class="row">
														<div class="col-sm-4 weight-600">Password</div>
														<div class="col-sm-8" id="password-review">.....000</div>
													</div>
												</li>
												<li>
													<div class="row">
														<div class="col-sm-4 weight-600">Full Name</div>
														<div class="col-sm-8" id="name-review">john smith</div>
													</div>
												</li>
												<li>
													<div class="row">
														<div class="col-sm-4 weight-600">Location</div>
														<div class="col-sm-8" id="location-review">123 Example</div>
													</div>
												</li>
											</ul>
											<div class="custom-control custom-checkbox mt-4">
												<input
													type="checkbox"
													class="custom-control-input"
													onfocus="$('#agree').val('agreed')"
													onblur="$('#agree').val('')"
													id="customCheck1"
												/>
												<label class="custom-control-label" for="customCheck1"
													>I have read and agreed to the terms of services and
													privacy policy</label
												>
											</div>
											<span class="text-danger" id="error-agree"></span>
											<input type="hidden" name="agree" id="agree">
										</div>
									</section>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- success Popup html Start -->
		<button
			type="button"
			id="success-modal-btn"
			hidden
			data-toggle="modal"
			data-target="#success-modal"
			data-backdrop="static"
		>
			Launch modal
		</button>
		<div
			class="modal fade"
			id="success-modal"
			tabindex="-1"
			role="dialog"
			aria-labelledby="exampleModalCenterTitle"
			aria-hidden="true"
		>
			<div
				class="modal-dialog modal-dialog-centered max-width-400"
				role="document"
			>
				<div class="modal-content">
					<div class="modal-body text-center font-18">
						<h3 class="mb-20">Form Submitted!</h3>
						<div class="mb-30 text-center">
							<img src="/back/vendors/images/success.png" />
						</div>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
						eiusmod
					</div>
					<div class="modal-footer justify-content-center">
						<a href="{{ route('client.login') }}" class="btn btn-primary">Done</a>
					</div>
				</div>
			</div>
		</div>
		<!-- success Popup html End -->
		<!-- welcome modal start -->
		<div class="welcome-modal">
			<button class="welcome-modal-close">
				<i class="bi bi-x-lg"></i>
			</button>
			<iframe
				class="w-100 border-0"
				src="https://embed.lottiefiles.com/animation/31548"
			></iframe>
			<div class="text-center">
				<h3 class="h5 weight-500 text-center mb-2">
					Open source
					<span role="img" aria-label="gratitude">❤️</span>
				</h3>
				<div class="pb-2">
					<a
						class="github-button"
						href="https://github.com/dropways/deskapp"
						data-color-scheme="no-preference: dark; light: light; dark: light;"
						data-icon="octicon-star"
						data-size="large"
						data-show-count="true"
						aria-label="Star dropways/deskapp dashboard on GitHub"
						>Star</a
					>
					<a
						class="github-button"
						href="https://github.com/dropways/deskapp/fork"
						data-color-scheme="no-preference: dark; light: light; dark: light;"
						data-icon="octicon-repo-forked"
						data-size="large"
						data-show-count="true"
						aria-label="Fork dropways/deskapp dashboard on GitHub"
						>Fork</a
					>
				</div>
			</div>
			<div class="text-center mb-1">
				<div>
					<a
						href="https://github.com/dropways/deskapp"
						target="_blank"
						class="btn btn-light btn-block btn-sm"
					>
						<span class="text-danger weight-600">STAR US</span>
						<span class="weight-600">ON GITHUB</span>
						<i class="fa fa-github"></i>
					</a>
				</div>
				<script
					async
					defer="defer"
					src="https://buttons.github.io/buttons.js"
				></script>
			</div>
			<a
				href="https://github.com/dropways/deskapp"
				target="_blank"
				class="btn btn-success btn-sm mb-0 mb-md-3 w-100"
			>
				DOWNLOAD
				<i class="fa fa-download"></i>
			</a>
			<p class="font-14 text-center mb-1 d-none d-md-block">
				Available in the following technologies:
			</p>
			<div class="d-none d-md-flex justify-content-center h1 mb-0 text-danger">
				<i class="fa fa-html5"></i>
			</div>
		</div>
		<button class="welcome-modal-btn">
			<i class="fa fa-download"></i> Download
		</button>
		<!-- welcome modal end -->
		<!-- js -->
		<script src="/back/vendors/scripts/core.js"></script>
		<script src="/back/vendors/scripts/script.min.js"></script>
		<script src="/back/vendors/scripts/process.js"></script>
		<script src="/back/vendors/scripts/layout-settings.js"></script>
		<script src="/back/src/plugins/jquery-steps/jquery.steps.js"></script>
		<script src="/back/vendors/scripts/steps-setting.js"></script>
		<script>
			$(document).ready(function(){
				
				//$('#payment_method_id').find('option').not(':first').remove();
		            var option = "<option value='0'>Select Card Type</option>";
					// AJAX request 
					$.ajax({
						url: '/client/payment-methods-guest',
						type: 'get',
						dataType: 'json',
						success: function(response){
							console.log(response);
							var len = response.length;
							if(response != null){
								//len = response.length;
							}
		
							//if(len > 0){
								// Read data and create <option >
								for(var i=0; i<len; i++){
		
									var id = response[i].id;
									var name = response[i].payment_name;
		
									option += ("<option value='"+id+"'>"+name+"</option>");
		
									//$("#payment_method_id").append(option); 
									$("#payment_method_id").append(
										$('<option></option>').val(id).html(name)
									);
								}
								console.log(option);
								//$("#payment_method_id").html(option);
							//}
		
						}
					});
				});
		</script>
		@stack('scripts')
	</body>
</html>
