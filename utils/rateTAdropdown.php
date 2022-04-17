<?php
    $val = $_GET['selectvalue']; //not sure about this!


    $filename = "../db/user_data.json";
    $data = file_get_contents($filename);
    $arr = json_decode($data, true);

    echo "<option>-- Select a TA --</option>";

    foreach($arr as $key=>$value){
        //looping through each user
        for ($i=0; $i < count($value['courses']); $i++){
            //if in the given term, TA exists:
            if($value['courses'][$i]["role"] == "ta"){
                if($value['courses'][$i]["term"] == $val){
                    echo "<option> $key </option>";
                    
                }           
            }
        }
    }		
?>