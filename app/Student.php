<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $visible = [
      'name','nim','address','id'
    ];
    public static $columns = [
      'NIM','Name','Address'
    ];
}
