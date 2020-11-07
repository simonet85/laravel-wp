<?php
    function check_users_permissions( $request, $actionName = NULL, $id = NULL){

        $currentUser = $request->user();

        if ($actionName) {
            $currentActionName = $actionName;
        } else {
            
            $currentActionName = $request->route()->getActionName();
            //dd( $currentActionName);
        }
        
        //splitting by @ sign
      
        
        list($controller, $method) = explode('@', $currentActionName);
        
        $controller = str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"], "", $controller);
        //str_replace( $search, $replace, $subject)
        // dd('C : '.$controller,' A : '.$method);
      
        //create : ['create', 'store']
        //update : ['edit', 'update']
        //delete : ['destroy', 'forcedestroy', 'restore']
        //create : ['index', 'view']
        // dd($controller);
       
        $crudPermissionMap = [
            'crud' => ['create','store', 'edit', 'update', 'destroy', 'forcedestroy', 'restore','index', 'view'],
        ];

        $classesMap = [
            'Backend' => 'post',
            'Categories' => 'category',
            'Users' => 'user',
        ];

        
        // dd($requestRoute);
        
        foreach( $crudPermissionMap as $permission => $methods){
            //Check if the method exists in the method list
            //we'll check the permission
            if( in_array($method, $methods) && isset($classesMap[ $controller ]) ){
                
                
                $className = $classesMap[ $controller ]; 
                

                if ($className == 'post' && in_array($method, ['edit', 'update', 'destroy', 'forcedestroy', 'restore'])) {
                    // dd('Full path :'.request()->url().'  '.'Segment1 :'.request()->segment(1).'  '.'Segment2 :'.request()->segment(2).' '.'Segment3 :'.request()->segment(3));
                    // dd($permission.'-'.$className);
                    $id = !is_null( $id ) ? $id : request()->segment(2);
                 
                    if ( $id  && (!$currentUser->can('update-others-post')) || (!$currentUser->can('delete-others-post'))) {
                        // Get the second parameter of the url which contains the id
                       
                        $post = \App\Post::withTrashed()->find($id);
                        // dd($post);
                        // dd($currentUser->id);
                    if ($post->author_id !== $currentUser->id) {
                        // abort(403, 'Forbidden Access !');
                        return false;
                       
                    }

                   }
                }else if ( ! $currentUser->can("{$permission}-{$className}")) {
                    // abort(404, 'Forbidden Access !');
                    return false;
                }
            break;
            }
        }
        return true;

    }
?>