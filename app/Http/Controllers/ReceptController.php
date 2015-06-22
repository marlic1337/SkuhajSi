<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use DB;
use Auth;
use Form;
use Request;
use Carbon\Carbon;
class ReceptController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function new_recept() {
        return view('recept/add_recept');
    }

    public function create_recept() {
        $naslov = Request::input('naslov');
        $casP = Request::input('casPriprave');
        $casK = Request::input('casKuhanja');
        $tezavnost = Request::input('tezavnost');
        $opis = Request::input('opis');
        $sestavine = Request::input('sestavinee');

        if($casP >= 0 && $casK >= 0 && $casP <= 300 && $casK <= 300 && $tezavnost > 0 && $tezavnost <= 5 && strlen($opis) <= 1000 && strlen($opis) > 0 && strlen($naslov) > 0 && strlen($naslov) <= 255 && strlen($sestavine) > 5) {
            DB::table('recepti')->insert(['user_id' => Auth::user()->id, 'naslov' => $naslov, 'casPriprave' => $casP, 'casKuhanja' => $casK, 'tezavnost' => $tezavnost, 'opis' => $opis, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            $idRecepta = DB::table('recepti')->select('id')->where('naslov', $naslov)->where('opis', $opis)->get()[0]->id;
        } else {
            return view('recept/add_recept');
        }


        $temp = "";
        $sestavinaTemp = "";
        $kolicinaTemp = "";
        $enotaTemp = "";
        $count = 0;
        $idSestavine = 0;

        for($i = 0; $i < strlen($sestavine)-1; $i++) {
            if($sestavine[$i] == ';' && $sestavine[$i+1] == ';') {
                switch($count) {
                    case 0:
                        if(DB::table('sestavine')->where('ime', $temp)->count() > 0) {
                            $idSestavine = DB::table('sestavine')->select('id')->where('ime', $temp)->get()[0]->id;
                        } else {
                            DB::table('sestavine')->insert(['ime' => $temp]);
                            $idSestavine = DB::table('sestavine')->select('id')->where('ime', $temp)->get()[0]->id;
                        }
                        $temp = "";
                        $count++;
                        break;
                    case 1:
                        $kolicinaTemp = $temp;
                        $count++;
                        $temp = "";
                        break;
                    case 2:
                        $enotaTemp = $temp;
                        DB::table('receptisestavine')->insert(['recept_id' => $idRecepta, 'sestavina_id' => $idSestavine, 'kolicina' => $kolicinaTemp, 'enota' => $enotaTemp]);
                        $count = 0;
                        $temp = "";
                        $sestavinaTemp = "";
                        $kolicinaTemp = "";
                        $enotaTemp = "";
                        break;
                }
            } else if($sestavine[$i] != ';'){
                $temp = $temp . $sestavine[$i];
            }
        }
        return view('recept/recept_created');
    }

    public function get_recept($idRecepta){
        $receptData = DB::table('recepti')->where('id',$idRecepta)->get()[0];
        $sestavineData = DB::table('receptisestavine')->where('recept_id', $idRecepta)->get();
        $avtor = DB::table('users')->select('name')->where('id', $receptData->user_id)->get()[0];
        for($i = 0; $i < count($sestavineData); $i++) {
            $sestavine[$i] = Array(DB::table('sestavine')->select('ime')->where('id', $sestavineData[$i]->sestavina_id)->get()[0]->ime, $sestavineData[$i]->kolicina, $sestavineData[$i]->enota);
        }
        $data = Array($receptData, $sestavine, $avtor);

        /*$data = DB::table('receptisestavine')
            ->join('recepti', 'receptisestavine.recept_id', '=', 'recepti.id')
            ->join('sestavine', 'receptisestavine.sestavina_id', '=', 'sestavine.id')
            ->where('receptisestavine.recept_id', $idRecepta)
            ->get();*/

        return view('recept/show_recept', ['data' => $data]);
//        return DB::table('sestavine')->select('ime')->where('id', $sestavineData[0]->sestavina_id)->get()[0]->value;
    }

    public function get_my() {
        $data = DB::table('recepti')->where('user_id', Auth::user()->id)->get();
        return view('home', ['data' => $data]);
    }

    public function edit_recept($idRecepta){
        $receptData = DB::table('recepti')->where('id',$idRecepta)->get()[0];
        $sestavineData = DB::table('receptisestavine')->where('recept_id', $idRecepta)->get();
        $avtor = DB::table('users')->select('name')->where('id', $receptData->user_id)->get()[0];
        for($i = 0; $i < count($sestavineData); $i++) {
            $sestavine[$i] = Array(DB::table('sestavine')->where('id', $sestavineData[$i]->sestavina_id)->get()[0], $sestavineData[$i]->kolicina, $sestavineData[$i]->enota);
        }
        $data = Array($receptData, $sestavine, $avtor);
        return view('recept/edit_recept', ['data' => $data]);
    }

    public function put_edit()
    {
        $naslov = Request::input('naslov');
        $casP = Request::input('casPriprave');
        $casK = Request::input('casKuhanja');
        $tezavnost = Request::input('tezavnost');
        $opis = Request::input('opis');
        $sestavine = Request::input('sestavinee');
        $delSes = Request::input('delit');
        $recId = Request::input('recId');

        if ($casP >= 0 && $casK >= 0 && $casP <= 300 && $casK <= 300 && $tezavnost > 0 && $tezavnost <= 5 && strlen($opis) <= 1000 && strlen($opis) > 0 && strlen($naslov) > 0 && strlen($naslov) <= 255) {
            DB::table('recepti')->where('id', $recId)->update(['naslov' => $naslov, 'casPriprave' => $casP, 'casKuhanja' => $casK, 'tezavnost' => $tezavnost, 'opis' => $opis, 'updated_at' => Carbon::now()]);
        } else {
            return view('recept/add_recept');
        }


        $temp = "";
        $sestavinaTemp = "";
        $kolicinaTemp = "";
        $enotaTemp = "";
        $count = 0;
        $idSestavine = 0;
        //return $delSes.strlen($delSes);
        if (strlen($delSes) != 0) {
            //return "dela";
            for ($i = 0; $i < strlen($delSes)-1; $i++) {
                if ($delSes[$i] == ';' && $delSes[$i + 1] == ';') {
                    DB::table('receptisestavine')->where(['recept_id' => $recId, 'sestavina_id' => $temp])->delete();//->where('sestavina_id', $temp)->delete();
                    $temp = "";
                } else if ($delSes[$i] != ';') {
                    $temp = $temp . $delSes;
                }
            }
        }
        //return "ne dela";
        if (strlen($sestavine) != 0) {
            for ($i = 0; $i < strlen($sestavine)-1; $i++) {
                if ($sestavine[$i] == ';' && $sestavine[$i + 1] == ';') {
                    switch ($count) {
                        case 0:
                            if (DB::table('sestavine')->where('ime', $temp)->count() > 0) {
                                $idSestavine = DB::table('sestavine')->select('id')->where('ime', $temp)->get()[0]->id;
                            } else {
                                DB::table('sestavine')->insert(['ime' => $temp]);
                                $idSestavine = DB::table('sestavine')->select('id')->where('ime', $temp)->get()[0]->id;
                            }
                            $temp = "";
                            $count++;
                            break;
                        case 1:
                            $kolicinaTemp = $temp;
                            $count++;
                            $temp = "";
                            break;
                        case 2:
                            $enotaTemp = $temp;
                            if (DB::table('receptisestavine')->where(['recept_id' => $recId, 'sestavina_id' => $idSestavine])->count() == 0) {
                                DB::table('receptisestavine')->insert(['recept_id' => $recId, 'sestavina_id' => $idSestavine, 'kolicina' => $kolicinaTemp, 'enota' => $enotaTemp]);
                            }
                            $count = 0;
                            $temp = "";
                            $sestavinaTemp = "";
                            $kolicinaTemp = "";
                            $enotaTemp = "";
                            break;
                    }
                } else if ($sestavine[$i] != ';') {
                    $temp = $temp . $sestavine[$i];
                }
            }
        }

        $receptData = DB::table('recepti')->where('id',$recId)->get()[0];
        $sestavineData = DB::table('receptisestavine')->where('recept_id', $recId)->get();
        $avtor = DB::table('users')->select('name')->where('id', $receptData->user_id)->get()[0];
        $sestavine1 = "";
        for($i = 0; $i < count($sestavineData); $i++) {
            $sestavine1[$i] = Array(DB::table('sestavine')->select('ime')->where('id', $sestavineData[$i]->sestavina_id)->get()[0]->ime, $sestavineData[$i]->kolicina, $sestavineData[$i]->enota);
        }
        $data = Array($receptData, $sestavine1, $avtor);

        return view('recept/show_recept', ['data' => $data]);
    }

    public function delete_recept($idRecepta){
        DB::table('receptisestavine')->where('recept_id', $idRecepta)->delete();
        DB::table('recepti')->where('id', $idRecepta)->delete();

        $data = DB::table('recepti')->where('user_id', Auth::user()->id)->get();
        return view('home', ['data' => $data]);
    }
}
