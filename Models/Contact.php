<?php

namespace Tymr\Plugins\Contact\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    //
    protected $table = 'contact_users';


    public $fillable = [ 
        'name',
        'email',
        'message'
    ];    

}
