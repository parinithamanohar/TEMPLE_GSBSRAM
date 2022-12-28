<?php
$this->load->helper('form');
$error = $this->session->flashdata('error');
if ($error) { 
    ?>
<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <i class="fa fa-check mx-2"></i>
    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
</div>
<?php } ?>
<?php
        $success = $this->session->flashdata('success');
        if ($success) {
        ?>
<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <i class="fa fa-check mx-2"></i>
    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
</div>
<?php }?>
<div class="row">
    <div class="col-md-12">
        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
    </div>
</div>
<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row ">
            <div class="col-md-12 col-lg-12  padding_left_right_null">
                <div class="card ">
                    <div class="card-header text-white card-content-title p-1">
                        <div class="row ">
                            <div class="col-lg-6 text-white ">Expense Management</div>
                            <div class="col-lg-6 "> <a href="#" onclick="GoBackWithRefresh();return false;"
                                    class="btn text-white btn-success btn-bck pull-right mobile-bck "><i
                                        class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Back </a></div>
                        </div>
                    </div>

                    <!-- form start -->
                    <div class="card-body contents-body ">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="editDevotee" action="<?php echo base_url() ?>updateExpense" method="post"
                            role="form" enctype="multipart/form-data">
                            <!-- Default Light Table -->
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="account_type">Expense Name*</label>
                                            <select class="form-control " id="expense_type" name="expense_type" required>
                                            <option value="<?php echo  $expenseInfo->expense_type; ?>">Selected:
                                                <?php echo $expenseInfo->expense_type; ?></option>
                                                <?php if(!empty($expenseNameInfo)) {
                                                    foreach($expenseNameInfo as $expense){ ?>
                                                <option value="<?php echo $expense->expense_name ?>"><?php echo $expense->expense_name ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="account_type">Expense Type*</label>
                                            <select class="form-control " id="type_of_expense" name="type_of_expense"
                                                required>
                                                <option value="<?php echo $expenseInfo->type_of_expense; ?>">Selected:
                                                <?php echo $expenseInfo->type_of_expense; ?></option>
                                                <option value="Event">Event</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12 committee_name">
                                        <div class="form-group">
                                            <label for="purpose">Committee</label>
                                            <select class="form-control " id="committee_name" name="committee_name">
                                            <option value="<?php echo  $expenseInfo->committee_id; ?>">Selected:
                                                <?php echo $expenseInfo->committee_name; ?></option>
                                                <?php if(!empty($committeeInfo)) {
                                                             foreach($committeeInfo as $role ){?>
                                                <option value="<?php echo $role->row_id;?>">
                                                    <?php echo $role->type;?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12 event_type">
                                        <div class="form-group">
                                            <label for="purpose">Event Type</label>
                                            <select class="form-control " id="event_type" name="event_type">
                                            <option value="<?php echo  $expenseInfo->event_type; ?>">Selected:
                                                <?php echo $expenseInfo->event_type; ?></option>
                                                <?php if(!empty($eventInfo)) {
                                                             foreach($eventInfo as $role ){?>
                                                <option value="<?php echo $role->events;?>">
                                                    <?php echo $role->events;?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>



                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="amount">Amount*</label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $expenseInfo->amount; ?>" id="amount"
                                            name="expense_amount" onkeypress="return isNumberKey(event)" maxlength="128"
                                            placeholder="Enter Amount" autocomplete="off" required>
                                        <input type="hidden" value="<?php echo $expenseInfo->row_id; ?>" name="row_id"
                                            id="row_id" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="account_type">Payment Type*</label>
                                        <select class="form-control " id="account_type" name="account_type" required>
                                            <option value="<?php echo  $expenseInfo->account_type; ?>">Selected:
                                                <?php echo $expenseInfo->account_type; ?></option>
                                            <option value="Cash">Cash</option>
                                            <option value="Bank">Bank</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="invoice_no">Invoice No</label>
                                        <input type="text" class="form-control " id="invoice_no"
                                            value="<?php echo $expenseInfo->invoice_no; ?>" name="invoice_no"
                                            maxlength="128" placeholder="Enter Invoice No" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                        <div class="form-group" id="bank_type_select">
                                            <label for="bank_rowid">Select Bank</label>
                                            <select name="bank_row_id" id="bank_row_id"
                                                class="form-control selectpicker " data-live-search="true">
                                                <?php if($expenseInfo->bank_id>0){ ?>
                                                    <option value="<?php echo $expenseInfo->bank_id ?>">Selected:<?php echo $expenseInfo->bank_name ?></option>
                                                <?php } ?>
                                                <option value="0">Select Bank Account</option>
                                                <?php if(!empty($bank))
                                                        { foreach ($bank as $b1)
                                                            { ?>
                                                <option value="<?php echo $b1->row_id ?>">
                                                    <?php echo $b1->bank_name ?></option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group" id="cash_type_select">
                                            <label for="bank_rowid">Select Cash Account</label>
                                            <select name="cash_row_id" id="cash_row_id"
                                                class="form-control required selectpicker" data-live-search="true">
                                                <?php if($expenseInfo->cash_id>0){ ?>
                                                    <option value="<?php echo $expenseInfo->cash_id ?>">Selected:<?php echo $expenseInfo->cash_account_name ?></option>
                                                <?php } ?>
                                                <option value="0">Select Cash Account</option>
                                                <?php if(!empty($cashAccount))
                                                        { foreach ($cashAccount as $b1)
                                                            { ?>
                                                <option value="<?php echo $b1->row_id ?>">
                                                     <?php echo $b1->cash_account_name; ?><!-- .'(Bal: '.$b1->account_balance.')' -->
                                                </option>
                                                <?php   } 
                                          } ?>
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group required">
                                        <label for="party">Party</label>
                                        <select class="form-control " id="party" name="party">
                                            <option value="<?php echo $expenseInfo->party_id; ?>">
                                                Selected:<?php echo $expenseInfo->party_name; ?>
                                            </option>
                                            <?php if(!empty($partyInfo)) {
                                                foreach($partyInfo as $party ){?>
                                            <option value="<?php echo $party->row_id;?>">
                                                <?php echo $party->party_name;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label for="account_type">Year*</label>
                                            <select class="form-control " id="year" name="year"
                                                required>
                                                <option value="<?php echo $expenseInfo->year; ?>">Selected:
                                                <?php echo $expenseInfo->year; ?></option>
                                                <option value="2022">2022</option>
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="comments">Comments</label>
                                        <textarea class="form-control " name="comments" id="comments" rows="2"
                                            placeholder="Comments"
                                            autocomplete="off"> <?php echo $expenseInfo->comments; ?></textarea>
                                    </div>
                                </div>

                            </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" style="float:right;" class="btn btn-primary mr-1">Update</button>
                    </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- form end -->
<!-- End Default Light Table -->


<script src="<?php echo base_url(); ?>assets/js/devotee/editDevotee.js" type="text/javascript"></script>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = '<?php echo base_url(); ?>/expenseListing';
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}

jQuery(document).ready(function() {

    // $('.committee_name').hide();
    //     $("#committee_name").prop('required', false);
    //     $('.event_type').hide();
    //     $("#event_type").prop('required', false);


    type_of_expenses = $('#type_of_expense').val();

if (type_of_expenses == 'Event') {
        $('.committee_name').show();
        $("#committee_name").prop('required', true);
        $('.event_type').show();
        $("#event_type").prop('required', true);
    } else {
        $('.committee_name').hide();
        $("#committee_name").prop('required', false);
        $('.event_type').hide();
        $("#event_type").prop('required', false);
    }


        
    var trans_type = $("#account_type").val();
    if(trans_type=='Cash'){
        $("#bank_type_select").hide();
    }else if(trans_type=='Bank'){
        $("#cash_type_select").hide();
    }
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        jQuery("#searchList").attr("action", link);
        jQuery("#searchList").submit();
    });
    jQuery('.resetFilters').click(function() {
        $(this).closest('form').find("input[type=text]").val("");
    })
    // Prepare the preview for profile picture
    $("#wizard-picture").change(function() {
        readURL(this);
    });
    jQuery('.datepicker').datepicker({
        autoclose: true,
        orientation: "bottom",
        format: "dd-mm-yyyy"

    });
});

$("#account_type").change(function() {
    if (this.value == 'Cash') {
        $("#bank_type_select").hide();
        $("#bank_type_select select").val(0);
        $("#cash_type_select").show();
    } else if (this.value == 'Bank') {
        $("#bank_type_select").show();
        $("#cash_type_select").hide();
        $("#cash_type_select select").val(0);
    }

});

$("#type_of_expense").change(function() {
    type_of_expense = $('#type_of_expense').val();
    if (type_of_expense == 'Event') {
        $('.committee_name').show();
        $("#committee_name").prop('required', true);
        $('.event_type').show();
        $("#event_type").prop('required', true);
    } else {
        $('.committee_name').hide();
        $("#committee_name").prop('required', false);
        $('.event_type').hide();
        $("#event_type").prop('required', false);
    }
});




function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#sImg").change(function() {
    readURL(this);
});
</script>