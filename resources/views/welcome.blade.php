<html>
	<head>
		<title>Skuhaj.si</title>	
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
	</head>
	<body>
		
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="content">
						<div class="logo">
							<img src="/images/logo.png" alt="" />
						</div>
						<div class="quote">{{ Inspiring::quote() }}</div>
		                <button class="btn btn_novrecept center-block"><a href="/home">Brskaj po receptih</a></button>
                        <button class="btn btn_novrecept center-block"><a href="/auth/login">Prijava</a></button>
					</div>
				</div>
			</div>			
		</div>
	</body>
</html>


<!-- href="/recept/add -->