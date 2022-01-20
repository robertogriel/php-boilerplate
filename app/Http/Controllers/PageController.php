<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class PageController extends BaseController
{

    private $options = [
        'header'=>true,
        'footer'=>true
    ];

    private $template = 'public';
    private $cache = [
        'dir'=>'public/cache',
        'status'=>false
    ];
    public $loader;
    public $twig;

    public function __construct($options = [])
    {

        $cacheStatus = $this->cache['status'] == true ? $cacheStatus = $this->cache['dir'] : false;

        $this->loader = new \Twig\Loader\FilesystemLoader($this->template);
        $this->twig = new \Twig\Environment($this->loader,  [
            'cache'=>$cacheStatus
        ]);

        $this->setOptions($options);

    
        if ($this->options['header']) {
            echo $this->twig->render('header.html', $this->options);
        }

    }

    public function render($page, $options = [])
    {
        echo $this->twig->render($page . '.html', $this->options);
    }
    
    public function setOptions($opts)
    {
        foreach($opts as $key => $value) {
            $this->options[$key] = $value;
        }
    }

    public function __destruct()
    {
        if ($this->options['footer']) {
            echo $this->twig->render('footer.html', $this->options);
        }
    }
}
