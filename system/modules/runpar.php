<?
 function RunPar($program, $launch_options, $background_mode=false){
   return ($background_mode)? shell_exec_wait($program.' '.$launch_options, 1) : shell_exec($program.' '.$launch_options);
} 
?>