<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogdata extends Model
{
    protected $table    =   "db_blog";
    public $timestamps  =   false;
    protected $guarded  = [];
}
