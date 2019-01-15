<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    public $timestamps = false;
    protected $primaryKey = 'id';
}
