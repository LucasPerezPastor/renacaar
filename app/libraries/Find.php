<?php
class Find
{
    public static function view(string $routeView=''):string{
        $out='';
        if (file_exists(__DIR__.RESOURCE.$routeView.'.php'))
        {
            $out=__DIR__.RESOURCE.$routeView.'.php';
        }else
        {
            $route=RESOURCE.'/'.$routeView.'.php';
            for ($i = 0; $i < MAX_DEEP_RESOURCE; $i++)
            {
              $route='../'.$route;
              //echo __DIR__.'/'.$route.'<br>';
              if (file_exists(__DIR__.'/'.$route))
              {
                  $out=__DIR__.'/'.$route;
                  break;
              }
            }
        }
        return $out;
    }
    
    public static function style(string $dir='',string $routeView=''):string{
        $out='';
        if (file_exists($dir.'/'.ROOT_PUBLIC.'/'.STYLE.'/'.$routeView.'.css'))
        {
           $out=STYLE.$routeView.'.css';
        }else
        {
            $route='';
            for ($i = 0; $i < MAX_DEEP_RESOURCE; $i++)
            {
                $route='../'.$route;

                if (file_exists($dir.'/'.$route.ROOT_PUBLIC.'/'.STYLE.'/'.$routeView.'.css'))
                {
                   $out= $route.STYLE.'/'.$routeView.'.css';
                    break;
                }
            }
        }
        return $out;
        
    }
    
    public static function asset(string $dir='',string $routeView=''):string{
        $out='';
        
        if (file_exists($dir.'/'.ROOT_PUBLIC.'/'.IMG.'/'.$routeView))
        {
            $out=IMG.$routeView;
        }else
        {
            $route='';
            for ($i = 0; $i < MAX_DEEP_RESOURCE; $i++)
            {
                $route='../'.$route;
                
                if (file_exists($dir.'/'.$route.ROOT_PUBLIC.'/'.IMG.'/'.$routeView))
                {
                    $out= $route.IMG.'/'.$routeView;
                    break;
                }
            }
        }
        return $out;
        
    }
}
