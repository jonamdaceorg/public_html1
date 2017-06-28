<link rel="stylesheet" href="<?php echo base_url(); ?>assets/validation/css/formValidation.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/js/formValidation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/js/framework/bootstrap.js"></script>
<?php $reportUrl = base_url()."Frontend/updateReportAboutAds"; ?>



<div id="contentdiv">
<form id="defaultForm" action="<?php echo $reportUrl; ?>"  method="post" class="form-horizontal" >

<input type="hidden" name="adsId" id="adsId" value="<?php echo $adsId; ?>" >


    <div class="form-group row">
        <div class="col-sm-8 col-sm-offset-1">
            <?php for ($i = 0; $i < count($adsReportingArray); $i++) { ?>
                <?php $adsReportingId = $adsReportingArray[$i]['reportingId']; ?>

            <div class="radio">
                <label>
                    <input type="radio" name="adsreport" id="adsreport"  value="<?php echo $adsReportingArray[$i]['reportingId']; ?>">
                    <?php echo $adsReportingArray[$i]['reportingType']; ?>
                </label>
            </div>
            <?php  } ?>

                  </div>
    </div>

    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-1">
            <textarea name="description" id="description" class="form-control" placeholder="<Provide additional information which will be helpful in checking your report, if you want to get response from us please provide your e-mail address>" ></textarea>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            <input  type="submit"  name="report"  id="report" value="Report"  class="btn btn-info"  />

        </div>
    </div>
</form>
</div>


<script type="text/javascript">
        $(document).ready(function () {
            $('#defaultForm').formValidation({
                message: 'This value is not valid',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    adsreport: {
                        message: 'The Mobile Number is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The Mobile Number is required'
                            }
                        }
                    },
                    description: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    }
                }
            }).on('success.form.fv', function(e) {
                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the FormValidation instance
                var bv = $form.data('formValidation');
                var postData=$form.serialize()+"&report=Report"
                // Use Ajax to submit form data
                $.get($form.attr('action'), postData, function(result) {
                    console.log(result);
                    //alert("ssss"+result)
                    $("#contentdiv").html(result);
                });
            });
        });
    </script>

</div>
