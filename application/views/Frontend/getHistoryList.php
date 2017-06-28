<?php
/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 1/3/17
 * Time: 10:10 PM
 */
?>

<div class="form-group">
    <div class="row">
        <div class="col-sm-12 text-right">
            <?php
            $previousPage = $page-1;
            $nextPage = $page+1;
            if($previousPage>=0){
//                echo '<a href="javascript:void(0)" onclick="loadsearchData('.$previousPage.')">Previous '.$rec_limit.'</a>';
                echo '&nbsp;<a href="javascript:void(0)" onclick="loadsearchData('.$previousPage.')" class="btn btn-danger btn-sm"><span class="fa fa-arrow-left text-white fa-1x"></span>&nbsp;Previous '.$rec_limit.'</a>';

            }
            if($left_rec>0)
                echo '&nbsp;<a href="javascript:void(0)" onclick="loadsearchData('.$nextPage.')" class="btn btn-success btn-sm">Next '.$rec_limit.' <span class="fa fa-arrow-right text-white fa-1x"></span></a>';
            ?>
        </div>
    </div>
</div>


<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
       cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>S.No</th>
        <th>Action</th>
        <th>Page Name</th>
        <th>Date</th>
        <th>Description</th>
        <th>From Ip</th>
    </tr>
    </thead>
    <tbody>
    <?php
//    echo '<pre>';
//    print_r($historyArray);
//    echo '</pre>';
    for ($i = 0; $i < count($historyArray); $i++) { ?>
        <tr>
            <?php $id = $historyArray[$i]['id']; ?>
            <td><?php echo $i + 1; ?></td>
            <td><?php echo $historyArray[$i]['action']; ?></td>
            <td><?php echo $historyArray[$i]['pageName']; ?></td>
            <td><?php echo $historyArray[$i]['createdAt']; ?></td>
            <td><?php echo $historyArray[$i]['description']; ?></td>
            <td><?php echo $historyArray[$i]['fromIp']; ?></td>

        </tr>
    <?php } ?>
    </tbody>
</table>

