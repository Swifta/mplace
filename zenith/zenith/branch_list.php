<?php

try{
    $soap = new SoapClient(SOAP_URL, array('trace' => 1));
    $fun_resp = $soap->getBranchList($arg);
    //var_dump();
}
catch(SoapFault $sE){
    var_dump($sE);
}

?>
<div class="panel panel-default">
    <div class="panel-heading">getBranchList Response</div>
  <div class="panel-body">
<?php
    foreach($fun_resp->getBranchListResult->Branches as $value){
        echo $value->BranchName."(".$value->BranchNo.") , ";
    }
?>
  </div>
</div>