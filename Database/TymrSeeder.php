<?php

namespace Tymr\Plugins\Contact\Database;

use Tymr\Modules\Users\Models\Permission;
use Tymr\Modules\Navigation\Models\Link;
use Illuminate\Support\Facades\DB;

class TymrSeeder
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function install()
    {
        //get the group id if it exeist
        if($id = DB::table('navigation_groups')->where('slug','public_apps')->where('is_admin', false)->first()->id){
            DB::table('navigation_links')->insert(
                [
                    'group_id'          => $id,
                    'title'             => 'Contact',
                    'description'       => 'Contact Plugin link',
                    'icon'              => 'fa fa-phone',
                    'parent'            => 0,
                    'type'              => 'route',
                    'url'               => 'app.contact.show',
                    'order'             => 0,
                    'permission'        => '',
                    'module'            => 'contact',
                    'data'              => '',
                    'css_id'            => '',
                    'css_class'         => '',
                    'published'         => true
                ]);   
        }

 
        DB::table('core_settings')->insert([
            'slug'          => 'contact_method',
            'module'        => 'contact',
            'name'          => 'Contact Method',
            'description'   => 'How would you like to handle user contact request ',
            'value'         => 'both',
            'options'       => 'both=Both Database and Email|emailonly=Email Only|dbonly=DB Only',
            'default'       => 'both',
            'type'          => 'select',
            'is_core'       => false,
            'is_gui'        => true,
            'is_required'   => false,
            'order'         => 200,
        ]);     

        DB::table('core_settings')->insert([
            'slug'          => 'contact_admin_name',
            'module'        => 'contact',
            'name'          => 'Contact Admin Name',
            'description'   => 'The name of the Admin, i.e John Smith',
            'value'         => 'Admin',
            'options'       => '',
            'default'       => 'Admin',
            'type'          => 'text',
            'is_core'       => true,
            'is_gui'        => true,
            'is_required'   => false,
            'order'         => 150,
        ]);   
        
        DB::table('core_settings')->insert([
            'slug'          => 'contact_admin_email',
            'module'        => 'contact',
            'name'          => 'Contact Admin Email',
            'description'   => 'This is the Admins email when the Admin needs to be contacted by the site or user',
            'value'         => '',
            'options'       => '',
            'default'       => '',
            'type'          => 'text',
            'is_core'       => true,
            'is_gui'        => true,
            'is_required'   => false,
            'order'         => 151,
        ]);            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function uninstall()
    {
        // Remove Links where module is contact        
        Link::where('module','contact')->delete();

        // Remove settings where module is contact
        \Tymr\Models\Settings::where('module','contact')->delete();
    }
}
