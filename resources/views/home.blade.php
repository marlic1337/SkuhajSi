@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"></div>

				<div class="panel-body">

					@foreach ($data as $d)
					<div class="recept">

						<a href="recept/get/{{ $d->id }}"><h2>{{ $d->naslov }}</h2></a>
	                    <div class="recept_body">
			                <span class="detail_ele">
				                <span class="recept_detail">čas priprave:</span>{{ $d->casPriprave }}
							</span>
							<span class="detail_ele">
								<span class="recept_detail">čas kuhanja:</span>{{ $d->casKuhanja }}
							</span>
		                    <span class="detail_ele">
			                    <span class="recept_detail">težavnost:</span>{{ $d->tezavnost }}/5
			                </span>
	                    </div>
                    </div>
              @endforeach
				</div>
			</div>
            <button type="submit" class="dodaj btn btn-block btn_novrecept"><a href="/recept/add">Dodaj recept</a></button>
		</div>
	</div>
</div>
@endsection