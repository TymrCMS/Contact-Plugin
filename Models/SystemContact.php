<?php

namespace Tymr\Plugins\Contact\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use SettingsHelper;

class SystemContact extends Model {

    use Notifiable;

    protected $admin;
    protected $email;
	
    public function __construct() 
    {
        $this->admin = 'Administrator'; //use a config here or have out our settings in the DB
        
        $this->email = SettingsHelper::value('contact_admin_email');
    }

}