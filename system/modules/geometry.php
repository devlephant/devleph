<?


class Geometry {
    
    
    static function collision2D($obj1, $obj2){
        
        if (is_object($obj1)){
            $tmp['w'] = $obj1->w;
            $tmp['h'] = $obj1->h;
            $tmp['x'] = $obj1->x;
            $tmp['y'] = $obj1->y;
            $obj1 = $tmp;
        }
        
        if (is_object($obj2)){
            $tmp['w'] = $obj2->w;
            $tmp['h'] = $obj2->h;
            $tmp['x'] = $obj2->x;
            $tmp['y'] = $obj2->y;
            $obj2 = $tmp;
        }
        
        // центральная точка 1
        $xy1['x'] = $obj1['x'] + round($obj1['w']/2);
        $xy1['y'] = $obj1['y'] + round($obj1['h']/2);
        
        // центральная точка 2
        $xy2['x'] = $obj2['x'] + round($obj2['w']/2);
        $xy2['y'] = $obj2['y'] + round($obj2['h']/2);
        
        if ($xy1['x'] > $xy2['x'])
            $w = $xy1['x'] - $xy2['x'];
        else
            $w = $xy2['x'] - $xy1['x'];
            
        if ($xy1['y'] > $xy2['y'])
            $h = $xy1['y'] - $xy2['y'];
        else
            $h = $xy2['y'] - $xy1['y'];
        
        
        $b1 = $w < (intval($obj1['w']/2) + intval($obj2['w']/2)); 
        $b2 = $h < (intval($obj1['h']/2) + intval($obj2['h']/2));
            
        return $b1 && $b2;
    }
    
    static function pointInRegion($x, $y, $region){
        
        $b = ($x > $region['x']) && ($x < $region['x'] + $region['w']) 
                && ($y > $region['y']) && ($y < $region['y'] + $region['h']);
                
        return $b;
    }

}

?>