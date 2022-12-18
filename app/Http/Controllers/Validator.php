<?php
namespace App\Http\Controllers;

class Validator {

    public function run($struct, $data, $nameType) {
        $status = [
            'name' => $nameType,
            "valid" => 1,
            "elem" => []
        ];

        foreach ($struct as $key => $eStruct) {
            $name = $eStruct['name'];
            $type = $eStruct['type'];

            $status['elem'][$key] = [
                'name' => $name,
                'valid' => 0
            ];
            $eStatus =& $status['elem'][$key];

            if(array_key_exists($name, $data)) {
                
                if ($type == 'ifstring') {
                    
                    $this->valIfString($eStatus, $data[$name], $eStruct);
                }
                elseif ($type == 'string'){
                    $eStatus['valid'] = 1;
                }
                elseif ($type == 'enum') {
                    $this->valEnum($eStatus, $data[$name], $eStruct);
                }
                elseif ($type == 'object') {
                    $this->valObject($eStatus, $data[$name], $eStruct);
                    
                }
                elseif ($type == 'array') {
                    $this->valArray($eStatus, $data[$name], $eStruct);
                }
            }
            
            $status['valid'] = ($status['valid']) * ($eStatus['valid']);
        }
        return $status;
    }

    public function valIfString(&$eStatus, $eData, $eStruct) {
        $cond = $eStruct['condition'];
        if (preg_match($cond, $eData) === 1) {
            $eStatus['valid'] = 1;
        }
    }

    public function valEnum(&$eStatus, $eData, $eStruct) {
        $variants = $eStruct['variants'];
        foreach($variants as $variant) {
            if ($eData == $variant){
                $eStatus['valid'] = 1;
            }
        }
    }

    public function valObject(&$eStatus, $eData, $eStruct) {
        $contained = $eStruct['contained'];
        $nameType = $eStruct['name'];
        $eStatus = $this->run($contained, $eData, $nameType);
    }

    public function valArray(&$eStatus, $Data, $eStruct) {
        // dd($eStruct);
        $eStatus['valid'] = 1;
        $variants = $eStruct['variants'];
        $nameType = $eStruct['name'];
        foreach ($Data as $key => $eData) {
            $eeStatus =& $eStatus['elem'][$key];
            foreach ($variants as  $variant) {
                $stat = $this->run($variant, $eData, $key);
                if ($stat['valid'] == 0) {
                    $eeStatus = $stat;
                }
                elseif ($stat['valid'] == 1) {
                    $eeStatus = $stat;
                    break;
                }
            }
            $eStatus['valid'] = ($eStatus['valid']) * ($eeStatus['valid']);
        }
    }
}