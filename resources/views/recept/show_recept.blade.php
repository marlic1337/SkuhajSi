@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"></div>

				<div class="panel-body">
					<div class="intro"><h1>{{ $data[0]->naslov }}</h1>Objavil: {{ $data[2]->name }}, objavljeno/urejeno: {{ $data[0]->updated_at }}</div>
					<div class="recept">
						<a href="#"></a>
	                    <div class="recept_body">
			                <span class="detail_ele">
				                <span class="recept_detail">čas priprave: {{ $data[0]->casPriprave }} min.</span>
							</span>	                    
							<span class="detail_ele">
								<span class="recept_detail">čas kuhanja: {{ $data[0]->casKuhanja }} min.</span>
							</span>
		                    <span class="detail_ele">
			                    <span class="recept_detail">težavnost: {{ $data[0]->tezavnost }}/5</span>
			                </span>
	                    </div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="recept_ses">
                                    <label >Sestavine:</label>
								<ul>
                                    @foreach ($data[1] as $d)
									<li style="text-align: left; padding: 0.2em; padding-left: 0.4em">{{ $d[1] }} {{ $d[2] }}  {{ $d[0] }}</li>
                                    @endforeach
								</ul>
								</div>
							</div>
							<div class="col-md-6">
			                   <div class="recept_opis">{{ $data[0]->opis }}</div>
							</div>
						</div>	
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection