<?php

namespace Tymr\Plugins\Contact;

use Tymr\Models\Module;
use Tymr\Core\Contracts\Installable;
use Tymr\Modules\Users\Models\Permission;
use Tymr\Modules\Navigation\Models\Link;


class ContactPlugin extends Module implements Installable
{
    public $info = [
        'name'          => 'Contact',
        'description'   => 'Contact Module',      
        'version'       => '1.0.0',
        'slug'          => 'contact'
    ];

    protected $installer;
    protected $seeder;

    public function __construct()
    {
        $this->seeder = new \Tymr\Plugins\Contact\Database\TymrSeeder();        
        $this->installer = new \Tymr\Plugins\Contact\Database\TymrTables();
    }

	public function help() : string
	{
		return "No help documentation supplied.";
	} 

	public function info() : array
	{
		return $this->info;
	}

    public function install() : bool
    {
        
        $route_file = app_path()."/Plugins/Contact/Storage/Routes/web.php";     
        $new_route_file = app_path()."/Plugins/Contact/Routes/web.php";     

        if( file_exists( $new_route_file ) ) 
        {
            unlink( $new_route_file );
        }

        copy( $route_file , $new_route_file );

        $this->seeder->install();

        $this->installer->up();

        return true;
    }

    public function uninstall() : bool
    {
        
        $route_file = app_path()."/Plugins/Contact/Routes/web.php";     

        if( file_exists( $route_file ) ) 
        {
            unlink( $route_file );
        }

         $this->installer->down();

         $this->seeder->uninstall();

        return true;
    }
   
}
