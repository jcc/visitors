<?php namespace Cjjian\Visitors\Services\Cache;



interface CacheInterface {

public function destroy( $key );

public function rememberForever( $key, $data );      


}