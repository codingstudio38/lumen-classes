<?php 
foreach (glob(__DIR__.'/Helpers/*.php') as $key => $filename) {
    include $filename;
}
?>