<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded=[];
    protected $table = "services";
    protected $primaryKey = 'service_id';
}
