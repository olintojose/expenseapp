<?php 

require_once 'controllers/errors.php';
class App{

    function __construct(){
        error_log('APP::construct-> no hay controlador especificado');
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url,'/');
        $url = explode("/", $url);
      

        if (empty($url[0])){
            $fileController= 'controllers/login.php';
            require_once $fileController;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;

        }

        $fileController = 'controllers/' . $url[0] . '.php';

        if(file_exists($fileController)){
            require_once $fileController;
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            if(isset($url[1])){
                if(method_exists($controller, $url[1])){
                    if(isset($url[2])){
                        //no de parametros
                        $nparam = count($url) -2;
                        //arreglo de parametros 
                        $params=[];

                        for($i = 0; $i < $nparam; $i++){
                            array_push($params, $url[$i] + 2 );
                        }
                        $controller->{$url[1]}($params);
                    }else{
                        $controller->{$url[1]}();
                    }

                }else{
                    //Error no existe el metodo
                    $controller = new Errors(); 
                }
            }else{
                // no hay metodo a cargar, se carga el metodo por default
                $controller->render();
            }

        }else{
            // no existe em archivo, manda error 
            $controller = new Errors(); 
         //   $controller->render();
        }


    }
}
