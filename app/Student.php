<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $visible = [
      'name','nim','address','id'
    ];
    protected $fillable = [
        'name','address','nim'
    ];
    public static $columns = [
      'id','NIM','Name','Address'
    ];
}
