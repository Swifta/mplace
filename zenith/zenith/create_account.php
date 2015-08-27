<?php

try{
    $soap = new SoapClient(SOAP_URL, array('trace' => 1));
    $fun_resp_branch = $soap->getBranchList($arg);
    $fun_resp_class = $soap->getAccountClass($arg);
    //var_dump();
}
catch(SoapFault $sE){
    var_dump($sE);
}

if(isset($_REQUEST['submit'])){
    try{
        //$soap = new SoapClient(SOAP_URL, array('trace' => 1));
        //$soap_functions = $soap->__getFunctions();
        //var_dump($soap_functions);
        $FirstName = $_REQUEST['FirstName'];
        $LastName = $_REQUEST['LastName'];
        $EmailAddress = $_REQUEST['EmailAddress'];
        $MobilePhoneNo = $_REQUEST['MobilePhoneNo'];
        $AddressLine = $_REQUEST['AddressLine'];
        $Sex = $_REQUEST['Sex'];
        $Branchno = $_REQUEST['Branchno'];
        $ClassCode = $_REQUEST['ClassCode'];
        
        $arg['FirstName'] = $FirstName;
        $arg['LastName'] = $LastName;
        $arg['EmailAddress'] = $EmailAddress;
        $arg['MobilePhoneNo'] = $MobilePhoneNo;
        $arg['AddressLine'] = $AddressLine;
        $arg['Sex'] = $Sex;
        $arg['Branchno'] = $Branchno;
        $arg['ClassCode'] = $ClassCode;
        var_dump($arg);
        $fun_resp = $soap->CreateAccount($arg);
        var_dump($fun_resp);
    }
    catch(SoapFault $sE){
        var_dump($sE);
    }
}

?>
<div class="panel panel-default">
    <div class="panel-heading">Create Account Response</div>
  <div class="panel-body">
      <form method="post" action="">
          <div class="form-group">
              <label>FirstName</label>
              <input type="text" name="FirstName" placeholder="Max 20 character" class="form-control" required/>
          </div>
          <div class="form-group">
              <label>LastName</label>
              <input type="text" name="LastName" placeholder="Max 20 character" class="form-control" required/>
          </div>
          <div class="form-group">
              <label>EmailAddress</label>
              <input type="text" name="EmailAddress" placeholder="Max 40 character" class="form-control" required/>
          </div>
          <div class="form-group">
              <label>MobilePhoneNo</label>
              <input type="text" name="MobilePhoneNo" placeholder="Max 20 character" class="form-control" required/>
          </div>
          <div class="form-group">
              <label>AddressLine</label>
              <input type="text" name="AddressLine" placeholder="Max 40 character" class="form-control" required/>
          </div>
          <div class="form-group">
              <label>Sex</label>
              <select name="Sex" class="form-control" required>
                  <option></option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>
              </select>
          </div>
          <div class="form-group">
              <label>Branchno</label>
              <select name="Branchno" class="form-control" required>
                  <option></option>
                    <?php
                        foreach($fun_resp_branch->getBranchListResult->Branches as $value){
                            echo '<option value="'.$value->BranchNo.'">'.$value->BranchName.'</option>';
                        }
                    ?>
              </select>
          </div>
          <div class="form-group">
              <label>ClassCode</label>
              <select name="ClassCode" class="form-control" required>
                  <option></option>
                    <?php
                        foreach($fun_resp_class->getAccountClassResult->ClassCode as $value){
                            echo '<option value="'.$value->ClassCodes.'">'.$value->ClassName.'</option>';
                        }
                    ?>
              </select>
          </div>
          <div class="form-group">
              <input type="submit" name="submit" value="Send" class="btn btn-success" />
          </div>
      </form>
  </div>
</div>