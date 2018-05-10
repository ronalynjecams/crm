<?php 
function make_thumb($src, $dest, $desired_width,$desired_h) {

  /* read the source image */
  $source_image = imagecreatefromjpeg($src);
  $width = imagesx($source_image);
  $height = imagesy($source_image);

  $desired_height = $desired_h;

  /* create a new, "virtual" image */
  $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

  /* copy source image at a resized size */
  imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

  /* create the physical thumbnail image to its destination */
  imagejpeg($virtual_image, $dest);
}


        
function cfind($func,$id){
        
        return $func();
        $cacheDir = '/tmp/cache/';
        $cacheFile = $cacheDir . $id.'.cache';
        if(file_exists($cacheFile)){
            return json_decode(file_get_contents($cacheFile),true);
        }else{
            // $dataSource->execute(
            //     sprintf('LOCK TABLES %s AS %s WRITE;',
            //         $c->table,
            //         $c->alias
            //     )
            // );

            
            $data = $func();
            $cacheData = json_encode($data);
            file_put_contents($cacheFile,$cacheData);
            
            return $data;
        }
	//var_dump($func);exit;
}
function cdel($id){
    //echo 'rm -fr '.$this->chacheDir.$id.'.cache';exit;
    //shell_exec('rm -fr '.$this->chacheDir.$id.'.cache');
}
function logtmp($str){
 // file_put_contents('/tmp/logtmp',date("m/d H:i:s")." ".$str."\n",FILE_APPEND);
}