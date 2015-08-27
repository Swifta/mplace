<?php
require_once 'globals.php';
require_once 'head.php';



?>
<div class="row">
    <div class='col-sm-9'>
        <?php
            if(isset($_REQUEST['nav'])){
                if(file_exists($_REQUEST['nav'].'.php')){
                    @require_once $_REQUEST['nav'].'.php';
                }
                else{
                    echo "<p class='alert alert-danger text-center'>Not Implemented Yet</p>";
                }
            }
        ?>
    </div>
    <div class='col-sm-3'>
        <p>Test Menu Lists <></p>
        <ul>
            <li><a href='?nav=branch_list'>getBranchList</a></li>
            <li><a href='?nav=account_class'>getAccountClass</a></li>
            <li><a href='?nav=verify_account'>verify Account</a></li>
            <li><a href='?nav=create_account'>create Account</a></li>
        </ul>
    </div>
</div>

<?php
require_once 'foot.php';
?>
