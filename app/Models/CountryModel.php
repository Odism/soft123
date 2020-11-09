<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CountryModel extends Model
{
    
    protected $table = 'country';
    protected $primaryKey = 'id';
    
    /* public function insert(){

        $date = new \DateTime();
        $unixTimeStamp = $date->getTimeStamp();
        DB::insert("insert into country (code, name, dname, num_code, phone_code, created, register_by, modified, modified_by) 
        values(?,?,?,?,?,?,?,?,?)",['AB', 'ABC', 'ABC', 0, 0,$unixTimeStamp, 1 , $unixTimeStamp, 1]);
    }

    public function edit(){
        DB::update("update country set name = ? where id = ?", ['XYZ', 2]);
    }

    public function read(){
        return DB::select("Select * from country");     
    }

    public function delete(){
        DB::delete("delete from country where id = ?", [2]);
    }

    */
}
