<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Periodofiscal;
use App\Models\Aluno;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $periodofiscal = Periodofiscal::all()->last();
        
        // dd($periodofiscal);
        $hoje = Carbon::now();
        if($periodofiscal === null){
            
            $periodofiscal = new Periodofiscal();
            $periodofiscal->data = Carbon::now();
            if($hoje->day < 10){
                $periodofiscal->data->day = 10;
                $periodofiscal->data->month = $hoje->month - 1;
            }
            if($hoje->day >= 10){
                $periodofiscal->data->day = 10;
                $periodofiscal->data->month = $hoje->month;
            }
            
            

            $periodofiscal->save();
            
        }
        else{

            $periodofiscal->data = new Carbon($periodofiscal->data);
            // dd($hoje->day < 10 && $periodofiscal->data->addMonth(1) < $hoje);

            if($hoje->day < 10 && $periodofiscal->data->addMonth(1) < $hoje){

                $periodofiscal = new Periodofiscal();
                $periodofiscal->data = Carbon::now();


                $periodofiscal->data->day = 10;
                $periodofiscal->data->month = $hoje->month - 1;
                $periodofiscal->save();
                Aluno::query()->update(['pagamento_id' => NULL]);
            }
            if($hoje->day >= 10 && $periodofiscal->data->addMonth(1) < $hoje){
                $periodofiscal = new Periodofiscal();
                $periodofiscal->data = Carbon::now();
                $periodofiscal->data->day = 10;
                $periodofiscal->data->month = $hoje->month;
                $periodofiscal->save();
                Aluno::query()->update(['pagamento_id' => NULL]);
            }
            
            
                
                
                
            
            
            
            

            
        }
        
        return view('home');
    }
}
