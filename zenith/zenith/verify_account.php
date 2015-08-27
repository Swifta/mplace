<?php

if(isset($_REQUEST['submit'])){
    try{
        $soap = new SoapClient(SOAP_URL);
        //$soap_functions = $soap->__getFunctions();
        //var_dump($soap_functions);
        $account_number = $_REQUEST['acct'];
        $arg['account_number'] = $account_number;
        $fun_resp = $soap->VerifyAccount($arg);
        var_dump($fun_resp);
    }
    catch(SoapFault $sE){
        var_dump($sE);
    }
}

?>
<div class="panel panel-default">
    <div class="panel-heading">Verify Account Response</div>
  <div class="panel-body">
      <form method="post" action="">
          <div class="form-group">
              <label>Account Number</label>
              <input type="text" name="acct" class="form-control" />
          </div>
          <div class="form-group">
              <input type="submit" name="submit" value="Send" class="btn btn-success" />
          </div>
      </form>
  </div>
</div>