<?php

try{
    $soap = new SoapClient(SOAP_URL, array('trace' => 1));
    //$soap_functions = $soap->__getFunctions();
    //var_dump($soap_functions);
    $fun_resp = $soap->getAccountClass($arg);
    //var_dump($fun_resp);
}
catch(SoapFault $sE){
    var_dump($sE);
}

?>
<div class="panel panel-default">
    <div class="panel-heading">getAccountClass Response</div>
  <div class="panel-body">
<?php
    foreach($fun_resp->getAccountClassResult->ClassCode as $value){
        echo $value->ClassName."(".$value->ClassCodes.") , ";
    }
?>
  </div>
</div>