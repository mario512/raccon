<?php
class Controller {
    protected $image;
    protected $component;
    protected $doom;
    protected $language;
    
    public function __construct($data = [])
    {
        $this->image        = Registry::get('image');
        $this->component    = Registry::get('load');
        $this->doom         = Registry::get('doom');
        $this->language     = Registry::get('language');
        
    }
}