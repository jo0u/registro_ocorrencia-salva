<?php

namespace App\Http\Controllers;

use App\Models\Ocorrencias;
use App\Models\Os;
use App\Models\TopicoOcorrencias;
use App\Models\Topicos;
use Illuminate\Http\Request;

class OsController extends Controller 
{
    public function index(Request $request){



        $controle = Ocorrencias::all();
        $topicos = Topicos::all();
        
        $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $os = Ocorrencias::whereBetween('data', [$startDate, $endDate])->get();
        
   
        $obitos = 0;
        $prevencoes = 0;
        $salvamentosNF = 0;
        $criancasEncontradas = 0;
        $sos = 0;
        
        foreach ($os as $key => $value){
      
            switch ($value['topicos_id']){

                case 1:
                    $prevencoes++;
                    break;
                
                    case 2:
                    $salvamentosNF++;

                    break;
                
                    case 3:
                    
                    $criancasEncontradas++;
        
                    break;
                
                    case 4:
                    $sos++;

                    break;
                case 5:
                    $obitos++;
                    break;
               

            }
      
    

     }

        return view('/os/index',[
            'obitos' => $obitos ,
            'prevencoes' => $prevencoes,
            'salvamentosNF' => $salvamentosNF,
            'criancasEncontradas' => $criancasEncontradas,
           'sos' => $sos,
           'startDate' => $startDate,
           'endDate' => $endDate,
           'controle' => $controle,
           'topicos' => $topicos,
           
        
        ]);
    }


    public function create(){
        $topicos = Topicos::all();
    return view('os.cadastro',['topicos' => $topicos]);
    }

    public function store(Request $request){
        $topicos = Topicos::all();
        $os = new Ocorrencias;
        $os->data = $request->data;
        $os->hora = $request->hora;
        $os->posto =$request->posto;
        $os->topicos_id = $request->topicos_id;
        $os->nome_salva_vidas =$request->nome_salva_vidas;
        $os->nome_vitima = $request->nome_vitima;
        $os->grau = $request->grau;
        $os->sexo =$request->sexo ;
        $os->idade =$request->idade ;
        $os->estado_civil =$request->estado_civil ;
        $os->profissao =$request->profissao ;
        $os->cidade =$request->cidade ;
        $os->uf = $request->uf;
        $os->endereco = $request->endereco;
        $os->turista = $request->turista;
        $os->observacao =$request->observacao ;
   
        $os->save();


    return view('os.cadastro',['topicos' => $topicos]);

    }

    public function consultar(Request $request){   
        $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $os = Ocorrencias::whereBetween('data', [$startDate, $endDate])->get();
       // $os = Ocorrencias::all();

   
       

   
        return view('os.consultar',[
            'os' => $os,
            'startDate' => $startDate,
            'endDate' => $endDate,
           // 'busca' => $busca,
           
           
    ]);
    }

    public function edit(Request $request ,$id){
       
        $os = Ocorrencias::findOrFail($id);

        $topico = Topicos::all();

        

        return view('os.edit',['ocorrencia' => $os, 'topicos' => $topico]);
    }


    public function update(Request $request){
      
        $os = Ocorrencias::findOrFail($request->id);
        $os->fill($request->except('topicos_id'));
        $os->topicos_id = $request->topicos_id;
        $os->save();
        return redirect('/os/consultar');
    }


    public function destroy($id)
{
    $item = Ocorrencias::find($id);
    $item->delete();
    return redirect()->route('os.consultar')->with('success', 'Item excluído com sucesso.');
}


}
