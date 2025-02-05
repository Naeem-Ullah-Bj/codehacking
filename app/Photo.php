<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $photo = "/images/";
    //
    protected $fillable =['file'];

    public function getFileAttribute($value)
    {
        return $this->photo.$value;
    }
}
