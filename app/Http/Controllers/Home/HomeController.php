<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\CountryModel;
use Validator;
use Importer;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function Hola(){
        //return view("Hola")->with('id',$id);
        //ambos hacen la misma funcion

        $data = config('admin.admin');
        $data = $data[0];
        $user = array('abc@gmail.com','ABC','XYZ');
        return view('Bienvenido.Hola',compact('data','user'));
    }

    public function insert(){
        $CountryModel = new CountryModel();
        $CountryModel->insert();
        echo "Record inserted";
    }

    public function edit(){
        $CountryModel = new CountryModel();
        $CountryModel->edit();
        echo "Record edited";
    }

    public function read(){
        //1   $CountryModel = new CountryModel();
        $data = CountryModel::find(1);
        //1   var_dump($data);
        //2   foreach($data as $country){
        //      echo '<br>'.$country->name;
        //}

        echo '<br>'.$data->name;


    }

    public function delete(){
        $CountryModel = new CountryModel();
        $CountryModel->delete();
        echo "Record deleted";
    }

    public function importFile(){
        return view('test.excel');
    }

    public function importExcel(Request $request){
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
            if(sizeof($collection[1]) == 6){
                //nombro la variable $arr y uso el json_decode para transformar todo lo que se encuentre en la fila x a un arreglo de string
                //con los parametros de $collection que fue todo lo que lei del excel
                $arr = json_decode($collection, true);
                //por cada arreglo que el json_decode me dio, yo los voy a leer como filas
                //y cada arreglo son de 6 columnas
                
                foreach($arr as $row) {
                    $insert_data[] = array(
                        'Rut'  => $row[0],
                        'ApellidoP'  => $row[1],
                        'ApellidoM'  => $row[2],
                        'Nombre'  => $row[3],
                        'Codigo_Carrera'  => $row[4],
                        'Correo_Electroninco'  => $row[5],
                        
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
                DB::table('_alumnos')->insert($insert_data);
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
