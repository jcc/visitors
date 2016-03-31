<?php namespace Cjjian\Visitors\Storage;



interface VisitorInterface {

public function create( array $data);
      
public function get($ip);
      
public function update( $ip, array $data);     
      
public function delete( $ip );
   
public function all();
    
public function count( $ip );

public function countArticleIp($ip, $id);
   
public function increment( $ip, $id );

public function clicksSum();

public function range( $start, $end);

}
