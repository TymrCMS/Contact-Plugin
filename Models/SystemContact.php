<?php

namespace Tymr\Plugins\Contact\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use Tymr\Modules\Settings\Models\Settings;

class SystemContact extends Model {

    use Notifiable;

    protected $admin;
    protected $email;
	
    public function __construct() 
    {
        $this->admin = 'Administrator'; //use a config here or have out our settings in the DB
        
        //$this->email = Settings::where('slug','contact_admin_email')->first()->value;
        $this->email = Settings::value('contact_admin_email');
    }

}