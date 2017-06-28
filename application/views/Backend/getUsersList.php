<?php
if ($getGenerateExcel == 1) {

    $fileNameOfExcel = "UsersList".date("YmdHis");
    header("Content-Type: application/vnd.ms-excel");
    header("Content-disposition: attachment; filename=".$fileNameOfExcel.".xls");

    $content = "S.No\t";
    $content .= "Name\t";
    $content .= "Mobile\t";
    $content .= "Email\t";
    $content .= "Password\t";
    $content .= "Active\t";
    $content .= "Last Login\t";
    $content .= "Profile Created At\t";
    $content .= "From IP\t";
    $content .= "Country\t";
    $content .= "State\t";
    $content .= "City\t";
    $content .= "Address\t";
    $content .= "\n";

    for ($i = 0; $i < count($usersArray); $i++) {
        $sno = $i + 1;
        $userid = $usersArray[$i]['userid'];
        $name = $usersArray[$i]['name'];
        $mobile = $usersArray[$i]['mobile'];
        $email = $usersArray[$i]['email'];
        $password = $usersArray[$i]['password'];
        $active = $usersArray[$i]['active'];
        $lastLogin = $usersArray[$i]['lastlogin'];
        $country = $usersArray[$i]['countryId'];
        $state = $usersArray[$i]['stateId'];
        $city = $usersArray[$i]['districtId'];
        $address = $usersArray[$i]['address'];
        $fromIp = $usersArray[$i]['fromIp'];
        $profileCreatedAt = $usersArray[$i]['createdat'];

        $content .= $sno . "\t";
        $content .= $name . "\t";
        $content .= $mobile . "\t";
        $content .= $email . "\t";
        $content .= $password . "\t";
        $content .= $active . "\t";
        $content .= $lastLogin . "\t";
        $content .= $profileCreatedAt . "\t";
        $content .= $fromIp . "\t";
        $content .= $country . "\t";
        $content .= $state . "\t";
        $content .= $city . "\t";
        $content .= $address . "\t";
        $content .= "\n";
    }
    echo $content;
} else { ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Email Id</th>
            <th>Password</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($usersArray); $i++) { ?>
            <tr>
                <?php $userid = $usersArray[$i]['userid']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $usersArray[$i]['name']; ?></td>
                <td><?php echo $usersArray[$i]['mobile']; ?></td>
                <td><?php echo $usersArray[$i]['email']; ?></td>
                <td><?php echo $usersArray[$i]['password']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button"
                            onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $userid; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button"
                            onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $userid; ?>','<?php echo $deleteUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>