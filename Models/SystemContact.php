<?php

namespace Tymr\Plugins\Contact\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use TymrSetting;

class SystemContact extends Model {

    use Notifiable;

    protected $admin;
    protected $email;
	
    public function __construct() 
    {
        $this->admin = 'Administrator'; //use a config here or have out our settings in the DB
        
        $this->email = TymrSetting::value('contact_admin_email');
    }

}