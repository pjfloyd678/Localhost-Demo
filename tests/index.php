<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="en">

<head>
	<title>Test Script</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link type="text/css" rel="stylesheet" href="/jquery-ui/jquery-ui.min.css">
	<link type="text/css" rel="stylesheet" href="/jquery-ui/jquery-ui.theme.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		#show-message {
			border: 1px solid darkolivegreen;
			background-color: lightgreen;
			position: fixed;
			z-index: 100;
			bottom: 0;
			left: 0;
			width: 100%;
		}
	</style>
</head>

<body>
	<div class="container-fluid" role="main">
		<div class="row rows-col-1">
			<div class="col-xs-12 col-md-10 offset-md-1">
				<!-- Nav tabs -->
				<h2 class="demoHeaders">Tabs</h2>
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1">Main</a></li>
						<li><a href="#tabs-2">Second</a></li>
						<li><a href="#tabs-3">Third</a></li>
					</ul>
					<div id="tabs-1">
						<div class="container-fluid">
							<div class="row">
								<div class="container">
									<form action="#" method="post" id="check-radio">
										<div class="form-group row">
											<legend class="col-form-label col-sm-2 float-sm-left pt-0">Choose</legend>
											<div class="col-sm-10">
												<select name="choose" id="choose">
													<option value="" disabled selected label="Please Choose"></option>
													<option value="1">Option 1</option>
													<option value="2">Option 2</option>
													<option value="3">Option 3</option>
												</select>
											</div>
										</div>
										<fieldset class="form-group row">
											<legend class="col-form-label col-sm-2 float-sm-left pt-0">Radios</legend>
											<div class="col-sm-10">
												<div class="form-check">
													<input class="form-check-input" type="radio" name="checks" id="checks-none" value="" checked>
													<label class="form-check-label" for="checks1">
														None
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="checks" id="checks1" value="option1">
													<label class="form-check-label" for="checks1">
														First radio
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="checks" id="checks2" value="option2">
													<label class="form-check-label" for="checks2">
														Second radio
													</label>
												</div>
												<div class="form-check disabled">
													<input class="form-check-input" type="radio" name="checks" id="checks3" value="option3">
													<label class="form-check-label" for="checks3">
														Third radio
													</label>
												</div>
											</div>
										</fieldset>
										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="submit" id="check-btn" class="btn btn-primary">Reset Radios</button>
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="submit" id="disable-btn" class="btn btn-primary">Disable</button>
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div id="tabs-2">
						<div class="col-12">
							<h2>Test JavaScript</h2>
							<button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="display( true );">Show Message</button>
						</div>
						<div class="col-12 col-md-10 offset-md-1">
							<div class="container">
								<form name="form_test">
									<div class="form-group row">
										<label for="inputName" class="col-sm-1-12 col-form-label"></label>
										<div class="col-sm-1-12">
											<input type="text" class="form-control" name="inputName" id="inputName" placeholder="Test">
										</div>
									</div>
									<div class="form-group row">
										<div class="offset-sm-2 col-sm-10">
											<button type="submit" class="btn btn-primary">Action</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="tabs-3">
						<div class="col-12">
							<h2>Test Array with Ajax</h2>
							<button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off" id="test_array_ajax">Run the Script</button>
						</div>
						<div id="modal-forms">
							<!-- Modal Upload -->
							<div id="processing" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								<style>
									@keyframes glowing {
										0% {
											color: #5BA6BC;
										}

										50% {
											color: #00509e;
										}

										100% {
											color: #5BA6BC;
										}
									}

									.icon-glow {
										animation: glowing 1000ms infinite;
										font-size: 72px;
									}
								</style>
								<div class="modal-dialog modal-lg modal-dialog-centered">
									<div class="modal-content" style="border-radius:20px;">
										<div class="modal-header d-block">
											<h1 class="modal-title text-center" id="staticBackdropLabel">Processing</h1>
										</div>
										<div class="modal-body">
											<div class="container-fluid">
												<div class="row align-items-center pb-30 text-center">
													<div class="col-10 offset-1">
														<h3 class="pt-30 pb-30">
															<div class="pb-15">
																<span class="mdi mdi-cloud-upload-outline icon-glow"></span>
																<span class="mdi mdi-arrow-right-bold" style="font-size:72px"></span>
																<img style="position:relative; top:-18px; max-height:128px;" src="/assets/images/logos/brand-logo_en_CA.png" alt="SYNVISC">
															</div>
															<div class="progress portal-button" style="height:2rem; background-color:#00509e; border-color:#00509e;">
																<div class="progress-bar progress-bar-striped progress-bar-animated" style="background-color:#3c883a !important; width:0%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
															<div class="pt-30 icon-glow" style="font-size:unset;">Please wait</div>
														</h3>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="/jquery-ui/external/jquery/jquery.js"></script>
	<script src="/jquery-ui/jquery-ui.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js"></script>
	<!-- Setup some data -->
	<script>
	// globals to pass to scripting engine (translations, links etc)
	var _G = {
		success_msg: "INFORMATION SAVED",
		failed_msg:  "SAVE DATA FAILED",
		id:          1234
	};
    </script>

	<!-- Load Scripts -->
	<script src="test.js" async defer></script>
	<script src="test_array_ajax.js" async defer></script>
</body>

</html>