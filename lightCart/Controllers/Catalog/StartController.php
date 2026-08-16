<?php
class StartController extends Controller
{
    public function actionIndex() 
    {
       
        $dataPage = [];
        $this->component->load('controllers_catalog_headerController')->headerAction();
       
        echo Template::view('pages_start',$dataPage);
        
        $this->component->load('controllers_catalog_footerController')->footerAction();
    }
}
