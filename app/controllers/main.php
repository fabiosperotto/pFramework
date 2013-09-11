<?php
class Main_Controller
{

    public function index(array $getVars)
    {    	
        $view = new View_Model('demo');
        $view->assign('nomeUsuario' , $getVars['nome']);
        $view->render();        
    }
}