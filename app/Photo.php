<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $path = '/images/';
    protected $fillable = ['file'];


//accessor to append path befor image file 

// public function getFileAttribute($photo){

//     return $this->path.$photo;
// }


}
