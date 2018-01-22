<?php namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Modules\Account\Models\SystemFunction;
use Modules\Account\Models\SystemController;
use Modules\Account\Models\Menu;
use Modules\Account\Models\Group;
use Modules\Account\Models\Privilege;
use Modules\Account\Models\PrivilegeFunction;
use DB;

class GeneratePrivilegeCommand extends Command
{
    protected $name = 'facile:privilege:generate';
    protected $signature = 'facile:privilege:generate {--controller=} {--dir=}';
    protected $description = 'Generate privilege';

    private $except = ['.','..'];

    private $save_data = [];
    private $menugroup_order = 1;
    private $menu_order = 1;

    public function fire()
    {
        
        $controller = $this->option('controller');
        $dir = $this->option('dir');

        if (!empty($controller)) {
            
        } 
        else {
            $dirPath = "app/Http/Controllers/Admin";
            if($dir)
                $dirPath = $dirPath .'/'. $dir;
            
            $this->doTheDir($dirPath);
            //dd($this->save_data);
            if(count($this->save_data))
            {
                $this->saveData();
            }
        }
    }

    protected function getArguments()
    {
        return [
            //['controller', InputArgument::OPTIONAL, 'Name of the controller you wish to publish']
        ];
    }

    private function saveData()
    {
        try 
        {
            DB::beginTransaction();
            foreach($this->save_data as $menu_group)
            {
                if(!($menugroup_id = $this->saveMenuGroup($menu_group)))
                    DB::rollBack();

                if(!($menu_id = $this->saveAllData($menu_group['data'], $menugroup_id)))
                    DB::rollBack();

            }
            DB::commit();
            $this->info('Success saving privilege');
        }
        catch(\Exception $e)
        {
            dd($e->getMessage());
        }   

        
    }

    private function saveAllData($data, $menugroup_id)
    {
        try 
        {
            foreach($data as $obj)
            {
                $menu_id = $this->saveMenu($obj['menu'], $menugroup_id);
                if($controller_id = $this->saveController($obj['controller']))
                {
                    $this->saveFunction($obj['functions'], $controller_id);
                    $this->savePrivilege(3, $menu_id, $controller_id);
                }

            }
            return true;
        } catch(\Exception $e) {
            dd($e->getMessage());
            return false;
        }
        
    }   


    private function saveFunction($data, $controller_id)
    {
        $func = new SystemFunction;
        foreach($data as $key => $obj)
        {
            $data[$key]['system_controller_id'] = $controller_id;
        }
        
        if($func->insert($data))
            return true;
        else 
            return false;
    }


    private function saveController($data)
    {
        $controller = new SystemController;
        $controller->name = $data['name'];
        $controller->display_name = $data['display_name'];
        
        if($controller->save())
            return $controller->id;
        else 
            return false;
    }



    private function saveMenu($data, $menugroup_id)
    {
        $menu = new Menu;
        $menu->name = $data['name'];
        $menu->uri = $data['uri'];
        $menu->order = $data['order'];
        $menu->function_js = $data['function_js'];
        $menu->menu_group_id = $menugroup_id;
        if($menu->save())
            return $menu->id;
        else 
            return false;
    }


    private function savePrivilege($system_id, $menu_id, $controller_id)
    {
        $functions = SystemFunction::where('system_controller_id', $controller_id)->get();
        foreach ($functions as $key => $function) {
            $privilege = new Privilege;
            $privilege->name = $function['display_name'];
            $privilege->desc = $function['display_name'];
            $privilege->system_id = $system_id;
            $privilege->menu_id = $menu_id;
            if($privilege->save())
            {
                $privilege_id = $privilege->id;
                $pf = new PrivilegeFunction;
                $pf->privilege_id = $privilege_id;
                $pf->system_function_id = $function['id'];
                $pf->save();
            }
        }
    }




    private function saveMenuGroup($menu_group)
    {
        $menu_group = $menu_group['menu_group'];
        $menugroup = new Group;
        $menugroup->name = $menu_group['name'];
        $menugroup->icon = $menu_group['icon'];
        $menugroup->order = $menu_group['order'];
        $menugroup->system_id = $menu_group['system_id'];
        if($menugroup->save())
            return $menugroup->id;
        else 
            return false;
    }

    private function doTheDir($dirPath, $menu_group = '')
    {
        if(is_dir($dirPath))
        {

            $files = scandir($dirPath);
            foreach ($files as $value) {
                if(!in_array($value, $this->except))
                {
                    if(is_dir($dirPath."/".$value))
                    {
                        $this->doTheDir($dirPath."/".$value, $value);
                    }
                    else
                    {
                        //echo "BEDA :".$value."\n";
                        $file = $dirPath."/".$value;
                        $temp = explode(".",$file);
                        unset($temp[count($temp)-1]);
                        $controller_name = ucfirst(implode("",$temp));

                        $php_file = file_get_contents($file);
                        $data = $this->get_functions_classes($php_file);

                        $pieces = preg_split('/(?=[A-Z])/', str_replace("Controller", '', $data['class']));
                        $name = implode("",$pieces). " Manager";

                        $functions = [];
                        foreach($data['functions'] as $function)
                        {
                            $functions[] = [
                                'name' => $function,
                                'display_name' => ucfirst($function)." $name"
                            ];
                        }

                        $key = isset($menu_group) && $menu_group != '' ? $menu_group : explode(" ", $name)[0];
                        if($key == '') dd($menu_group);

                        if(!isset($this->save_data[$key]))
                        {
                            $arr_menugroup = [
                                'name' => $key,
                                'icon' => 'ico-dashboard',
                                'order' => $this->menugroup_order++,
                                'system_id' => '3',
                            ];
                            $this->save_data[$key] = [
                                'menu_group' => $arr_menugroup,
                                'data' => array(),
                            ];
                        }
                        
                        $menu_name = strtolower(explode(" ", $name)[0]);
                        $this->save_data[$key]['data'][] = [
                            'menu' => [
                                'name' => $menu_name,
                                'uri' => "cms.$menu_name.index",
                                'order' => $this->menu_order++,
                                'function_js' => $menu_name,
                            ],
                            'controller' => [
                                'name' => str_replace("/", "\\", $controller_name),
                                'display_name' => $name,
                            ],
                            'functions' => $functions,

                        ];

                        
                    }    
                }
            }
            //dd($files);
            //$this->info('Success generate privilege');
        }
        else 
        {
            $this->info('Failed to find '.$dirPath);
        }
    }

    private function get_functions_classes($php_code) {
        $class = '';
        $functions = array();
        $tokens = token_get_all($php_code);
        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i - 2][0] == T_CLASS
                && $tokens[$i - 1][0] == T_WHITESPACE
                && $tokens[$i][0] == T_STRING) {
                $class_name = $tokens[$i][1];
                $class = $class_name;
            }
        }

        for ($i = 4; $i < $count; $i++) {
            if ($tokens[$i - 4][0] == T_PUBLIC
                && $tokens[$i - 3][0] == T_WHITESPACE
                && $tokens[$i - 2][0] == T_FUNCTION
                && $tokens[$i - 1][0] == T_WHITESPACE
                && $tokens[$i][0] == T_STRING && $tokens[$i][1] != '__construct') {

                $function_name = $tokens[$i][1];
                $functions[] = $function_name;
            }
        }
        return array(
                'functions' => $functions,
                'class'   => $class
            );
    }
}
