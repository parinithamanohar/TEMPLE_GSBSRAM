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
<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row p-0">
            <div class="col  padding_left_right_null">
                <div class="card card-small  p-0 m-b-1">
                    <div class="card-body p-2">
                        <div class="row c-m-b">
                            <div class="col-5">
                                <span class="page-title">
                                    <i class="fa fa-money"></i> Donation Info
                                </span>
                            </div>
                            <div class="col-5 mobile-title">
                                <span class="page-sub-title mobile-title">Total Donations: <?php echo $count; ?></span>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <a class="btn btn-primary mobile-btn pull-right" href="" data-toggle="modal"
                                        data-target="#Modal"><i class="fa fa-plus"></i>
                                        Add New </a>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6 col-sm-12 col-12"> -->
                            <!-- <form action="<?php echo base_url() ?>devoteeListing" method="POST" id="searchList">
                                    <div class="input-group search-box">
                                        <input type="text" name="searchText" value=""
                                            class="form-control searchText input-md pull-right"
                                            placeholder="Search By Name/Mobile/Email" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-md btn-primary searchList"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form> -->
                            <!-- </div> -->
                        </div>
                        <hr>
                        <div class="row c-m-t">


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col  padding_left_right_null">
                <div class="card card-small mb-4">
                    <div class="card-body p-1 pb-3 text-center table-responsive">
                        <table class=" table mb-0 form-table-padding bordeless ">
                            <tr class="bg-deafult">
                                <form action="<?php echo base_url() ?>donationListing" method="POST"
                                    id="byFilterMethod">

                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width " type="text"
                                                name="devotee_name" id="" value="<?php echo $devotee_name ?>"
                                                class="form-control input-sm pull-right"
                                                style="text-transform: uppercase" placeholder="By Devotee Name"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-user"></i></div>
                                        </div>
                                    </th>

                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width " type="text" name="address"
                                                id="address" value="<?php  ?>" class="form-control input-sm pull-right"
                                                style="text-transform: uppercase" placeholder="Address"
                                                autocomplete="off" readonly>
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-user"></i></div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text" name="amount"
                                                value="<?php echo $amount ?>" class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Amount"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-user"></i></div>
                                        </div>
                                    </th>
                                    <th width="150" style="padding: 0px;">
                                        <div class="form-group position-relative mb-0"><input
                                                class="form-control is-valid mobile-width" type="text" name="payment_type_filter"
                                                value="<?php echo $payment_type_filter ?>" class="form-control input-sm pull-right "
                                                style="text-transform: uppercase" placeholder="By Payment Type"
                                                autocomplete="off">
                                            <div class="valid-feedback feedback-icon"><i class="fa fa-user"></i></div>
                                        </div>
                                    </th>

                                    <th width="180" class="text-center btn-padding"><button type="submit"
                                            class="btn btn-success btn-block mobile-width"> Search</button></th>
                                </form>
                            </tr>
                            <tr class=" text-white bg-black ">
                                <th>Devotee Name</th>
                                <th>Address</th>
                                <th>Amount</th>
                                <th>Payment Type</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                    if(!empty($donationRecords))
                    {
                        foreach($donationRecords as $record)
                        {
                    ?>
                            <tr class="text-black">
                                <td><?php echo $record->name ?></td>

                                <td><?php echo $record->address ?></td>
                                <td><?php echo $record->amount ?></td>
                                <td><?php echo $record->payment_type ?></td>
                                <td class="text-center">

                                    <!-- <a class="btn  btn-sm btn-info"
                                        href="<?php echo base_url().'editDevoteePageView/'.$record->row_id; ?>"
                                        title="Edit"><i class="fas fa-edit"></i></a> -->
                                    <!-- <a href="<?php echo base_url().'donationReceiptPrint/'.$record->row_id; ?>"
                                        target="_blank"><i class="fa fa-print"></i>Receipt</a> -->
                                    <a class="btn btn-sm btn-danger deleteDonationDetail" href="#"
                                        data-row_id="<?php echo $record->row_id; ?>" title="Delete"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                            <tr>
                                <td class="text-center " colspan="10">
                                    Donation Not Found!!.
                                </td>
                            </tr>
                            <?php }
                      ?>
                        </table>
                        <div>
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col">
        <div id="Modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header modal-call-report p-2">
                        <div class=" col-md-10 col-10">
                            <span class="text-white mobile-title" style="font-size : 20px">Add Donation
                                Details</span>
                        </div>
                        <div class=" col-md-2 col-2">
                            <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addFamily" action="<?php echo base_url() ?>addDonationDetails"
                            method="post" role="form">
                            <!-- Default Light Table -->
                            <div class="row form-contents">
                                <div class="col-lg-12 col-md-12 col-sm-12  padding_left_right_null">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-row">


                                            <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label for="purpose">Donation From</label>
                                                        <select class="form-control " id="donation_from" name="donation_from" required>
                                                            <option value=""> Select Donation From </option>
                                                            <option value="Devotee">Devotee</option>
                                                            <option value="Committee">Committee</option>
                                                        </select>
                                                    </div>
                                                </div>




                                                <div class="form-group col-md-6 devotee_name">
                                                    <label for="fname">Devotee Name*</label>
                                                    <input class="form-control is-valid mobile-width " type="text"
                                                        name="devotee_name" id="devotee_name" value=""
                                                        class="form-control input-sm pull-right "
                                                        style="text-transform: uppercase" placeholder="Name"
                                                        autocomplete="off">
                                                </div>

                                                <div class="col-lg-6 col-12 committee_name">
                                                    <div class="form-group">
                                                        <label for="purpose">Committee</label>
                                                        <select class="form-control " id="committee_name" name="committee_name">
                                                            <option value=""> Select Committee </option>
                                                            <?php if(!empty($committeeInfo)) {
                                                             foreach($committeeInfo as $role ){?>
                                                            <option value="<?php echo $role->row_id;?>">
                                                                <?php echo $role->type;?></option>
                                                            <?php }}?>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group col-md-6">
                                                    <label for="fname">Date</label>

                                                    <input id="dob" type="text" name="in_date"
                                                        class="form-control datepicker date-col-3" placeholder="Date"
                                                        value="<?php echo date('d-m-Y') ?>" autocomplete="off">
                                                </div>

                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="fname">Amount*</label>
                                                    <input class="form-control is-valid mobile-width " type="text"
                                                        name="amount" id="amount" value=""
                                                        onkeypress="return isNumberKey(event)"
                                                        class="form-control input-sm pull-right "
                                                        style="text-transform: uppercase" placeholder="Amount" required
                                                        autocomplete="off">
                                                </div>

                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label for="purpose">Purpose</label>
                                                        <select class="form-control " id="purpose" name="purpose"
                                                            >
                                                            <option value=""> Select Purpose </option>
                                                            <?php if(!empty($purposeInfo)) {
                                                             foreach($purposeInfo as $role ){?>
                                                            <option value="<?php echo $role->row_id;?>">
                                                                <?php echo $role->purpose_name;?></option>
                                                            <?php }}?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label for="purpose">Payment Type*</label>
                                                        <select class="form-control " id="payment_type" name="payment_type"
                                                            required>
                                                        <option value="">Select payment Type</option>
                                                        <option value="CASH">CASH</option>
                                                        <option value="BANK">BANK</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-12">
                                                    <div class="form-group">
                                                        <label for="role">Address</label>
                                                        <textarea class="form-control required"
                                                            value="<?php echo set_value('devotee_address'); ?>"
                                                            name="devotee_address" id="devotee_address" rows="4"
                                                            placeholder="Address" autocomplete="off"></textarea>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> <!-- form end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->


</div>
</div>
<!-- End Modal -->


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8">
</script>
<script type="text/javascript">
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function alphaOnly(event) {
    var key = event.keyCode;
    return ((key >= 65 && key <= 90) || key == 8 || key == 32);
};

jQuery(document).ready(function() {

    $('.devotee_name').hide();
    $("#devotee_name").prop('required', false);
    $('.committee_name').hide();
    $("#committee_name").prop('required', false);

    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#searchList").attr("action", baseURL + "donationListing/" + value);
        jQuery("#searchList").submit();
    });
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#byFilterMethod").attr("action", baseURL + "donationListing/" + value);
        jQuery("#byFilterMethod").submit();
    });
    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });




        $("#donation_from").change(function() {
            donation_from = $('#donation_from').val();
        if (donation_from == 'Devotee') {
            $('.devotee_name').show();
            $("#devotee_name").prop('required', true);
            $('.committee_name').hide();
            $("#committee_name").prop('required', false);
        } else {
            $('.devotee_name').hide();
            $("#devotee_name").prop('required', false);
            $('.committee_name').show();
            $("#committee_name").prop('required', true);
        }
    });




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
$("#vImg").change(function() {
    readURL(this);
});
</script>