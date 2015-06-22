@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dodaj recept</div>
                    <div class="panel-body">
                        <form action="{{ url('/recept/create') }}" method="post" class="form-horizontal">
	                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input id="sest" type="hidden" name="sestavinee">
                            <div class="form-group">
	                        <label class="col-md-3 control-label">
	                        Naslov:
	                        </label>
                            <div class="col-md-9">
                                <input type="text" name="naslov" pattern="^[ a-zA-Z0-9šđčćžŠĐČĆŽ\.\-]+$" class="form-control" placeholder="Moj Recept" size="255" required>
                            </div>
                        </div>
                        <div class="form-group">
	                        <label class="col-md-3 control-label">
	                        Čas priprave (min):
	                        </label>
                            <div class="col-md-9">
                                <input type="number" required name="casPriprave" min="0" max="300" class="form-control" placeholder="60 min" max="300">
                            </div>
                        </div>
                        <div class="form-group">
	                        <label class="col-md-3 control-label">
	                        Čas kuhanja (min):
	                        </label>
                            <div class="col-md-9">
                                <input type="number" required name="casKuhanja"min="0" max="300"  class="form-control" placeholder="60 min" max="300">
                            </div>
                        </div>
                        <div class="form-group">
	                        <label class="col-md-3 control-label">
	                        Težavnost 1-5:
	                        </label>
                            <div class="sliderr col-md-8">
                                <input name="tezavnost" class="bar form-control" type="range" id="rangeinput" value="3" min="1" max="5" step="1" onchange="rangevalue.value=value"/>
                                <span class="highlight"></span>
                                <output id="rangevalue">3</output>
                            </div>
                        </div>
                        <div class="form-group">
	                        <label class="col-md-3 control-label">
	                        Sestavine:
	                        </label>
                            <div class="col-md-3">
                                <input id="sestavine_ime" required pattern="^[ a-zA-Z0-9šđčćžŠĐČĆŽ\.\-]+$" type="text" name="sestavine" class="form-control" placeholder="Bucke" size="25">
                            </div>
                            <div class="col-md-2">
                                <input id="sestavine_kol" required min="0" max="1000" type="number" name="sestavine_kolicina" class="form-control" placeholder="Količina" size="25">
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
			                        
		                        </ul>
	                        </div>
                        </div>
                        
                        
						<div class="form-group">
	                        <label class="col-md-3 control-label">
	                        Opis:
	                        </label>
                            <div class="col-md-9">
                                <textarea name="opis" required class="form-control" placeholder="Moj opis" rows="10"></textarea>
                            </div>
                        </div>                                        
                        <button type="submit" class="btn btn-block btn_novrecept">Dodaj recept </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection