<?php
class TemplateBasico{
    //head básico
    public static function basicHead(string $title,string $dir)
    {?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title?></title>
        <link rel="stylesheet" href="<?php echo Find::style($dir,'style')?>">
      <?php 
    }
    
    //pone el header
    public static function header(string $pagina){
        ?>
        <header >
        	<div class="header-logo">
        		<a href="/"><?php echo self::imgTag(Find::asset(__DIR__,'logo/logo.png'),'logo','logo',150,50)?></a>
        	</div>
        	<div class="header-title">
        		<div class="header-title50">RENACAAR</div>
        		<div class="header-title25"><?php echo $pagina?></div>
        	</div>
        	<div class="header-login">
        		
        		<?php 
        		      $identificado=Login::get();
        		      
        		      if ($identificado)
        		      {
        		          ?>
        		          <ul class="login">
        		          <?php $linkUri="/usuario/show";?>
        		          <li><a href="<?php echo $linkUri."/".$identificado->id?>"><?php echo self::imgTag(Find::asset(__DIR__,'buttons/user.png'),'login','login',30,30)?>[<?php echo $identificado->usuario?>]</a></li>		
        		          <?php $linkUri="/usuario/create";?>	  
        		      		<li> <a href="<?php echo $linkUri?>"><?php echo self::imgTag(Find::asset(__DIR__,'buttons/menberregistration.png'),'registrar usuario','registrar usuario',30,30)?></a></li>
        		          <?php $linkUri="/login/logout";?>       		
        		          <li><a href="<?php echo $linkUri?>"><?php echo self::imgTag(Find::asset(__DIR__,'buttons/exit.png'),'logout','logout',30,30)?></a></li>
						</ul>
						<?php 
        		      }else
        		      {
        		      ?>
        		      	<?php $linkUri="/login";?>
        		      		<ul class="login">
        		      			<li> <a href="<?php echo $linkUri?>"><?php echo self::imgTag(Find::asset(__DIR__,'buttons/block.png'),'login','login')?>Identificarse</a></li>
        		      		</ul>      		  	
        		      <?php 
        		      }
        		?>
        	
        	</div>
        </header>
        <?php 
    }
    
    public static function nav(int $active=0){
        $uri= $_SERVER['REQUEST_URI'];
        ?>
        	<nav class="nav-menu">
        			 <input type="checkbox" id="menuToggle">
            		<label for="menuToggle" class="menu-icon"><?php echo self::imgTag(Find::asset(__DIR__,'buttons/hamburger.png'),'menu','menu',40,40)?></label>
                	<ul class="nav">
                		<?php $linkUri="/index.php";
                		$identificado=(Login::isAdmin() || Login::hasPrivilege(MIN_PRIVILEGE))?true:false;
                		?>
                		<li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri?>">Inicio</a></li>
                		<?php $linkUri="/modelo";?>
                		<li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri?>">Modelo de coches</a></li>
                		
                		<?php 
                		  
                		  if ($identificado){
                		      $linkUri="/modelo/create";?>
                		      <li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri?>">Nuevo modelo de coche</a></li>
                		 <?php }
                		 ?>
                		<?php $linkUri="/piloto";?>
                		<li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri?>">Conductor</a></li>
                		<?php 
                		  
                		  if ($identificado){
                		      $linkUri="/piloto/create";?>
                		      <li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri?>">Nuevo conductor</a></li>
                		 <?php }
                		 ?>
                		<?php 
                		  /*
                		   * $linkUri="/contact";
                		   * <li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri?>">Contactar</a></li>
                		   */
                		 ?> 	
                	<?php 
                	/**
                		      $identificado=Login::get();
                		      
                		      if ($identificado)
                		      {
                		          ?>
                		          <?php $linkUri="/usuario/show";?>
                		          <li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri."/".$identificado->id?>">Bienvenido [<?php echo $identificado->usuario?>]</a><li>			
                		          <?php $linkUri="/usuario/create";?>	  
                		      		  <li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri?>">Registrar Usuario</a></li>
                		          <?php $linkUri="/login/logout";?>       		
                		          <li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri?>">Salir</a></li>
        						<?php 
                		      }else
                		      {
                		      ?>
                		      	<?php $linkUri="/login";?>
                		      		  <li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri?>">Identificarse</a></li>
                		      	
                		      <?php 
                		      }
                		**/
                		?>
                		<?php 
                		$noUser=false;
                		if(($noUser && (Login::isAdmin() || Login::hasPrivilege(MIN_PRIVILEGE))))
                		{
                		?>
                		<?php $linkUri="/usuario";?>
                			<li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri?>">Usuarios</a></li>
                		<?php $linkUri="/usuario/create";?>	
                			<li><a <?php echo ($uri==$linkUri)?"class='active' ":" ";?>href="<?php echo $linkUri?>">Nuevo usuario</a></li>        		
                		<?php 
                		}
                		?>    	
                	</ul>
        	</nav>
        <?php 
        }
        
        
        public static function imgTag(string $imgHref,string $alt='',string $title='',string $w='20',string $h='20'):string
        {
            $out='<img class="zoom" height="'.$h.'" width="'.$w.'" src="'.$imgHref.'"';
            if (!empty($alt)){$out.=' alt="'.$alt.'"';};
            if (!empty($title)){$out.=' title="'.$title.'"';};
            $out.='>';
            return $out;
        }
        public static function linkList(string $dir,string $controller,string $alt='',string $title=''):string
        {
            $title=empty($title)?'Listar':$title;
            $alt=empty($alt)?'Listar':$alt;
            $imgList=self::imgTag(Find::asset($dir,'buttons/list.png'),$alt,$title);
            return "<a href='/$controller/list'>$imgList</a>".PHP_EOL; 
        }
        public static function linkDelete(string $dir,string $controller,int $id,bool $identificado=false,string $alt='',string $title=''):string {
            if (!$identificado){
                $identificado=(Login::isAdmin() || Login::hasPrivilege(MIN_PRIVILEGE))?true:false;};
            if ($identificado)
            {
                $title=empty($title)?'Borrar':$title;
                $alt=empty($alt)?'Borrar':$alt;
                $imgDelete=self::imgTag(Find::asset($dir,'buttons/delete.png'),$alt,$title);
                return "<a href='/$controller/delete/$id'>$imgDelete</a>".PHP_EOL; 
            }else{return '';}
        }
        public static function linkEdit(string $dir,string $controller,int $id,bool $identificado=false,string $alt='',string $title=''):string {
            if (!$identificado){
                $identificado=(Login::isAdmin() || Login::hasPrivilege(MIN_PRIVILEGE))?true:false;};
            if ($identificado)
            {
            $title=empty($title)?'Actualizar':$title;
            $alt=empty($alt)?'Actualizar':$alt;
            $imgUpdate=self::imgTag(Find::asset($dir,'buttons/update.png'),$alt,$title);
            return "<a href='/$controller/edit/$id'>$imgUpdate</a>".PHP_EOL;
            }else{return '';}
        }
        public static function linkShow(string $dir,string $controller,int $id,bool $identificado=false,string $alt='',string $title=''):string {
            $title=empty($title)?'Ver detalles':$title;
            $alt=empty($alt)?'Ver detalles':$alt;
            $imgUpdate=self::imgTag(Find::asset($dir,'buttons/show.png'),$alt,$title);
            return "<a href='/$controller/show/$id'>$imgUpdate</a>".PHP_EOL;
        }
        public static function linkCreate(string $dir,string $controller,int $id,bool $identificado=false,string $alt='',string $title=''):string {
            if (!$identificado){
                $identificado=(Login::isAdmin() || Login::hasPrivilege(MIN_PRIVILEGE))?true:false;};
            if ($identificado)
            {
            $title=empty($title)?'Añadir':$title;
            $alt=empty($alt)?'Añadir':$alt;
            $imgCreate=self::imgTag(Find::asset($dir,'buttons/add.png'),$alt,$title);
            return "<a href='/$controller/create/$id'>$imgCreate</a>".PHP_EOL;
            }else{return '';}
        }
        
        
        public static function linkEditDelete(string $dir,string $controller,int $id):string{
            $out='';
            $out.=self::linkEdit($dir, $controller, $id);
            $out.=self::linkDelete($dir, $controller, $id);
            return $out;
        }
        public static function linkShowEdit(string $dir='',string $controller,int $id):string
        {
            $identificado=(Login::isAdmin() || Login::hasPrivilege(MIN_PRIVILEGE))?true:false;
            $out='';
            $out=self::linkShow($dir, $controller, $id);
            if ($identificado)
            {
                $out.=self::linkEdit($dir, $controller, $id,true);
            }
            return $out;
        }
        public static function linkShowEditDelete(string $dir='',string $controller,int $id):string
        {
            $identificado=(Login::isAdmin() || Login::hasPrivilege(MIN_PRIVILEGE))?true:false;
            $out='';
            $out=self::linkShow($dir, $controller, $id); 
            if ($identificado)
            {
                $out.=self::linkEdit($dir, $controller, $id,true);
                $out.=self::linkDelete($dir, $controller, $id,true);
            }
            return $out;
        }
        public static function linkEditDeleteList(string $dir,string $controller,int $id):string{
            $identificado=(Login::isAdmin() || Login::hasPrivilege(MIN_PRIVILEGE))?true:false;
            $out='';
            $out=self::linkList($dir, $controller, $id);
            if ($identificado)
            {
                $out.=self::linkEdit($dir, $controller, $id,true);
                $out.=self::linkDelete($dir, $controller, $id,true);
            }
            return $out;
        }
        
        public static function linkEditDeleteListAddSub(string $dir,string $controller,int $id,string $type='',string $subController='',string $subType=''):string{
            $out='';
            $identificado=(Login::isAdmin() || Login::hasPrivilege(MIN_PRIVILEGE))?true:false;
            if ($identificado)
            {
                if (!empty($subController))
                {
                    $out.=self::linkCreate($dir, $subController, $id,true,"Añadir  $subType","Añadir  $subType");
                };
                $out.=self::linkEdit($dir, $controller, $id,true,"Actualizar $type","Actualizar $type");
                $out.=self::linkDelete($dir, $controller, $id,true,"Borrar $type","Borrar $type");
            }
            $type=(!empty($type))?"de {$type}s":'';
            $out.=self::linkList($dir, $controller, $id,"Listado $type","Listado $type");
            return $out;
        }
       
       public static function linkImg(array $img,array $href):string
       {

           $dir=$img['dir']??'';
           $source=$img['source']??'';
           $alt=$img['alt']??'';
           $title=$img['title']??'';
           $controller=$href['controller']??'';
           $method=$href['method']??'';
           $id=$href['id']??'';
           $href=$href['href']??'';
           
           if (empty($href))
           {
               if (!empty($controller))
               {
                   $href.='/'.$controller;
                   if (!empty($id))
                   {
                       $href.='/'.$id;
                   }
                   if (!empty($method))
                   {
                       $href.='/'.$method;
                   }
               }
           }
           if (!empty($dir)){$source=Find::asset($dir,$source);}
           $img=self::imgTag($source,$alt,$title);
           return "<a href='$href'>$img</a>".PHP_EOL;
       }
       
       public static function linkErase(array $img,array $href):string
       {
           $img['source']='buttons/erase.png';
          return self::linkImg($img, $href);
       }
       
        
        
        
        public static function selectValues(string $nameSelect='',array &$selectsValues=NULL,string $toCompare='')
        {?>
            <select name="<?php echo $nameSelect?>">
            
            <?php 
            
            if (isset($selectsValues)){
                foreach ($selectsValues as $key=>$value) {
                ?>
				        	<option value="<?php echo $key?>" 
				        	<?php echo (!empty($toCompare) && $toCompare==$key)?'selected':''?>>
				        	               <?php echo $value?>
        	               </option>
				        <?php 
				    }
            }?>
			</select><?php 
        }
        
        public static function selectRadio(string $nameRadio='',array $radioValues=NULL,string $toCompare=''){
            if (isset($radioValues)){
            foreach ($radioValues as $key=>$value) 
                   {
                       ?>
                       		<input type="radio" name="<?php echo $nameRadio?>" value="<?php echo $key?>" <?php echo (!empty($toCompare) && $toCompare == $key)?' checked':'';?>>
                       		<label><?php echo $value?></label>
                       <?php 
                       
                   }
            } 
        }
        
       
            
}