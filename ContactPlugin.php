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
		'description'   => 'Contact Plugin',      
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

		$this->seeder->install();

		$this->installer->up();

		return true;
	}

	public function uninstall() : bool
	{
		$this->installer->down();

		$this->seeder->uninstall();

		return true;
	}
      
	/**
	 * This gets executed once the Admin_Controller is ready
	 */
	public static function run()
	{
		//
	}
		
	/**
	 * This should excecute once the ModuleServiceProvider Loads the module
	 */
	public static function bootstrap()
	{
		//
	}
}
