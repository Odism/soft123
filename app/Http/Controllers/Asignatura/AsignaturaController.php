<?php

namespace App\Http\Controllers\Asignatura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\CountryModel;
use Validator;
use Importer;
use Illuminate\Support\Facades\DB;


class AsignaturaController extends Controller
{
    
    public function importfileAsignatura(){
        return view('test.AsignaturaExcel');
    }

    public function importExcelAsignatura(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:5000|mimes:xlsx,xls,csv'
        ]);



        if($validator->passes()){

            //obtengo el año, mes y dia actual
            $dataTime = date('Ymd_His');
            //nombro una variable file, de un request (archivo) que se pidio por la vista 
            $file = $request->file('file');
            $fileName = $dataTime . '-' . $file->getClientOriginalName();
            $savePath = public_path('/upload/');
            $file->move($savePath, $fileName);

            $excel = Importer::make('Excel');
            $excel->load($savePath.$fileName);
            $collection = $excel->getCollection(); 
            //verifico que esten las 6 columnas que me pedian
            if(sizeof($collection[1]) == 3){
                //nombro la variable $arr y uso el json_decode para transformar todo lo que se encuentre en la fila x a un arreglo de string
                //con los parametros de $collection que fue todo lo que lei del excel
                $arr = json_decode($collection, true);
                //por cada arreglo que el json_decode me dio, yo los voy a leer como filas
                //y cada arreglo son de 6 columnas
                
                foreach($arr as $row) {
                    $insert_data[] = array(
                        'Codigo'  => $row[0],
                        'NRC'  => $row[1],
                        'Asignatura'  => $row[2],
                        
                        
                    );
                    
                }
                /*
                for($row=1; $row<sizeof($collection); $row++){
                    try{
                        var_dump($collection[$row]);
                        

                    }catch(\Exception $e){
                        return redirect()->back()
                        ->with(['errors' =>$e->getMessage()]);
                    }
                }
                */
                //la subo a la base de datos que esta conectado al .env especificando la tabla
                /*
                for($IndexArr=1; $IndexArr<($contador); $IndexArr++){
                    DB::table('_alumnos')->insert($insert_data[$IndexArr]);
                }
                */
                DB::table('asignatura')->insert($insert_data);
            }else{
                return redirect()->back()
                ->with(['errors' => [0 => 'Porfavor Ingresa el archivo de acuerdo al ejemplo.']]);
            }


            //return redirect()->back()
            //    ->with(['success'=>'El archivo se cargo exitosamente.']);
        }else{
            return redirect()->back()
                ->with(['errors'=>$validator->errors()->all()]);
        }
    }
}
