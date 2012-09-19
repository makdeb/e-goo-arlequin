<?php
class MY_Upload extends CI_Upload {

    function CI_Upload(){
        parent::CI_Upload();
    }

    function is_allowed_filetype(){
        $file = substr($this->file_ext, 1);
    
        if(in_array($file, $this->allowed_types)){
            return TRUE;
        }            
        
        return FALSE;        
    }    
}
?>
