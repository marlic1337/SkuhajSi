@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>
                    <div class="panel-body">
{{--                        {{ var_dump($data) }}--}}
                        <form method="post" action="{{ url('/user/profile/edit') }}" method="post" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Ime</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="inputEmail3" value="{{ $data->name }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="inputEmail3" value="{{ $data->email }}" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn_novrecept">Spremeni profil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection