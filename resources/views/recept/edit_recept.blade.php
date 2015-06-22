@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dodaj recept</div>
                    <div class="panel-body">
{{--                        {{ var_dump($data) }}--}}
                        <form action="{{ url('/recept/edit') }}" method="post" class="form-horizontal">
	                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input id="sest" type="hidden" name="sestavinee">
                            <input type="hidden" name="delit" id="delit">
                            <input type="hidden" name="recId" value="{{ $data[0]->id }}">
                            <div class="form-group">
	                        <label class="col-md-3 control-label">
	                        Naslov:
	                        </label>
                            <div class="col-md-9">
                                <input value="{{ $data[0]->naslov }}" type="text" name="naslov" class="form-control" placeholder="Moj Recept" size="255">
                            </div>
                        </div>
                        <div class="form-group">
	                        <label class="col-md-3 control-label">
	                        Čas priprave (min):
	                        </label>
                            <div class="col-md-9">
                                <input value="{{ $data[0]->casPriprave }}" type="text" name="casPriprave" class="form-control" placeholder="60 min" max="300">
                            </div>
                        </div>
                        <div class="form-group">
	                        <label class="col-md-3 control-label">
	                        Čas kuhanja (min):
	                        </label>
                            <div class="col-md-9">
                                <input value="{{ $data[0]->casKuhanja }}" type="text" name="casKuhanja" class="form-control" placeholder="60 min" max="300">
                            </div>
                        </div>
                        <div class="form-group">
	                        <label class="col-md-3 control-label">
	                        Težavnost 1-5:
	                        </label>
                            <div class="sliderr col-md-8">
                                <input name="tezavnost" class="bar form-control" type="range" id="rangeinput" value="{{ $data[0]->tezavnost }}" min="1" max="5" step="1" onchange="rangevalue.value=value"/>
                                <span class="highlight"></span>
                                <output id="rangevalue">3</output>
                            </div>
                        </div>
                        <div class="form-group">
	                        <label class="col-md-3 control-label">
	                        Sestavine:
	                        </label>
                            <div class="col-md-3">
                                <input id="sestavine_ime" type="text" name="sestavine" class="form-control" placeholder="Bucke" size="25">
                            </div>
                            <div class="col-md-2">
                                <input id="sestavine_kol" type="number" name="sestavine_kolicina" class="form-control" placeholder="3" size="25">
                            </div>     
                            <div class="col-md-2">
                                <select id="sestavine_e" name="sestavine_enota" class="form-control" >
	                                <option value="kos">kos</option>
	                                <option value="g">g</option>
	                                <option value="dag">dag</option>
	                                <option value="kg">kg</option>
	                                <option value="ml">ml</option>
	                                <option value="l">l</option>
                                </select>
                            </div>                  
                            <div class="col-md-1">
	                        	<button id="btnAdd" type="button" class="glyphicon glyphicon-plus-sign btn btn_add"></button>
                            </div> 
                        </div>       
                        <div class="form-group">
	                        <div class="col-md-9 col-md-offset-3">
		                        <ul id="sestavinels"class="sestavine">
                                    @foreach ($data[1] as $d)
                                        <li class="seslist" value="{{ $d[0]->id }}"><a class="deell">{{ $d[1] }} {{ $d[2] }}  {{ $d[0]->ime }}</a></li>
                                    @endforeach
		                        </ul>
	                        </div>
                        </div>
						<div class="form-group">
	                        <label class="col-md-3 control-label">
                                Opis:
	                        </label>
                            <div class="col-md-9">
                                <textarea name="opis" class="form-control" placeholder="Moj opis" rows="10">{{ $data[0]->opis }}</textarea>
                            </div>
                        </div>                                        
                        <button type="submit" class="btn btn-block btn_novrecept">Popravi recept </button>
                        </form>
                        <form action="{{ url('/recept/delete/'.$data[0]->id) }}" method="post" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-block btn_novrecept">Izbriši recept </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('/edit_recept.js') }}"></script>
@endsection