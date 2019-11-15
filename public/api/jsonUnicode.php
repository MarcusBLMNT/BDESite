<?php
function jsonEncodeArray( $array ){
  array_walk_recursive( $array, function(&$item) { 
     $item = utf8_encode( $item ); 
  });
  return json_encode( $array );
}
?>