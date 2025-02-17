<?php
    $stmt = $db->prepare("SELECT * FROM nuns ");
    $stmt->execute();
    $results = $stmt->fetchAll();
    if(!$results){
        ?><p></p><?php
    }else{
        foreach($results as $result){
            ?>
                
            <?php
        }
    }
?>