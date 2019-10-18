<?php

namespace App\Service;


use App\Entity\Api;

/* @class service request service */
class ParserService
{

   public function parse(string $parser, string $flow, $data){
        $startScript = '$data_str = \'{{data_input}}\';$data = json_decode($data_str);';
        $startScript = str_replace('{{data_input}}', json_encode($data), $startScript);       
        $script = '{{start_script}}'.$parser.'{{end_script}}';
        $script = str_replace('{{start_script}}', $startScript, $script);
        $script = str_replace('{{end_script}}', 'return json_encode ($data);', $script); 
        $datas = eval($script);
        return $this->{$flow}($datas);
   }

   public function out($data): array
   {
        $params = json_decode($data,true);
        return $params;
   }

   public function in($data)
   {
        $params = json_decode($data);
        return $params;
   }
}
