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
        <div class="row p-0 ">
            <div class="col padding_left_right_null">
                <div class="card card-small  p-0 ">
                    <div class="card-body p-2 ">
                        <div class="row c-m-b">
                            <div class="col-lg-6 col-12">
                                <span class="page-title ">
                                    <i class="material-icons">ev_station</i> Fuel Account Management
                                </span>
                            </div>
                            <div class="col-lg-6 col-12 box-tools">
                                <form action="<?php echo base_url() ?>fuelAccountListing" method="POST" id="searchList">
                                    <div class="input-group search-box">
                                        <input type="text" name="searchText" value=""
                                            class="form-control searchText input-md pull-right" autocomplete="off"
                                            placeholder="Search By Fuel Account Name" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-md btn-primary searchList"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="row c-m-t">
                            <div class="col-md-6 col-5">
                                <span class="page-sub-title mobile-title">Total Fuel Accounts:
                                    <?php echo $count; ?></span>
                            </div>
                            <div class="col-md-6 col-7">
                                <a class="btn btn-primary mobile-btn ml-2 pull-right" href="" data-toggle="modal"
                                    data-target="#Modal"><i class="fa fa-plus"></i> Add New </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col padding_left_right_null">
                <div class="card card-small mb-4">
                    <div class="card-body p-1 pb-3 text-center table-responsive">
                        <table class="table mb-0 form-table-padding bordeless">

                            <tr class=" text-white  bg-black">
                                <th>Account Name</th>
                                <th>Account Type</th>
                                <th>Account Balance</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                        if(!empty($fuelAccountRecords))
                        {
                            foreach($fuelAccountRecords as $record)
                            {
                        ?>
                            <tr class="text-black">
                                <td><?php echo $record->fuel_account_name ?></td>
                                <td><?php echo $record->fuel_account_type ?></td>
                                <td><?php echo $record->account_balance ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary"
                                        href="<?= base_url().'viewFuelAccount/'.$record->row_id; ?>"
                                        title="View More"><i class="fa fa-eye"></i></a>
                                    <?php if($role == ROLE_ADMIN || $role == ROLE_EMPLOYEE) { ?>
                                    <a class="btn  btn-sm btn-info"
                                        href="<?php echo base_url().'editFuelAccountPageView/'.$record->row_id; ?>"
                                        title="Edit"><i class="fas fa-edit"></i></i></a>
                                    <a class="btn btn-sm btn-danger deleteFuelAccount" href="#"
                                        data-row_id="<?php echo $record->row_id; ?>" title="Delete"><i
                                            class="fas fa-trash"></i></a>
                                    <a class="btn btn-sm btn-success text-white" href="" data-toggle="modal"
                                        data-target="#Modal2"
                                        onclick="openModal2('<?php echo $record->row_id; ?>','<?php echo $record->account_balance; ?>')"><i
                                            class="fa fa-money "></i>&nbsp;&nbsp;Add Cash</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                            <tr>
                                <td class="text-center " colspan="10">
                                    Fuel Account Not Found!!.
                                </td>
                            </tr>
                            <?php }
                      ?>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Bigin -->

        <div id="Modal2" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header modal-call-report p-2">
                        <div class=" col-lg-10 col-10">
                            <span class="text-white mobile-title" style="font-size : 20px">Add Cash Amount
                                to Fuel Account</span>
                        </div>
                        <div class=" col-lg-2 col-2  ">
                            <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addCashToFuel" action="<?php echo base_url() ?>addCashToFuelAccount"
                            method="post" role="form">
                            <div class="row form-contents">
                                <div class="col-md-6 col-12">
                                    <label for="cash_date">Date</label>
                                    <div class="input-group ">
                                        <span class="input-group-append">
                                            <span class="input-group-text material-icons date-icon">date_range</span>
                                        </span>
                                        <input id="cash_date" type="text" name="cash_date"
                                            value="<?php echo date('d-m-Y'); ?>" class="form-control datepicker  "
                                            placeholder="Enter Date" autocomplete="off" required>
                                        <input type="hidden" name="fuel_account_rowid" id="fuel_account_rowid" />
                                        <input type="hidden" name="account_balance" id="modal_account_balance" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="cash_amount">Amount</label>
                                        <input type="text" class="form-control " id="cash_amount"
                                            onkeypress="return isNumberKey(event)" name="cash_amount"
                                            placeholder="Enter Amount" autocomplete="off" required>
                                        <input type="hidden" name="vehicle_number" id="modal2_vehicle_number" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="bank_rowid">Transaction Type</label>
                                        <select required name="tran_type" id="tran_type" class="form-control required"
                                            required>
                                            <option value="">Select Transaction Type</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Bank">Bank</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group" id="bank_type_select">
                                        <label for="bank_rowid">Select Bank</label>
                                        <select name="bank_row_id" id="bank_row_id"
                                            class="form-control selectpicker " data-live-search="true">
                                            <option value="">Select Bank</option>
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
                                            <option value="">Select Cash Account</option>
                                            <?php if(!empty($cashAccount))
                                                        { foreach ($cashAccount as $b1)
                                                            { ?>
                                            <option value="<?php echo $b1->row_id ?>">
                                                <?php echo $b1->cash_account_name .'(Bal: '.$b1->account_balance.')'; ?>
                                            </option>
                                            <?php   } 
                                          } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="comments">Comments (Optional)</label>
                                        <textarea class="form-control " placeholder="Enter Comments" name="comments"
                                            id="comments" rows="3" autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" style="flaot : left" value="Submit" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- End Modal -->
        <!-- Mpdal Bigin -->

        <div id="Modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header modal-call-report p-2">
                        <div class=" col-lg-10 col-10">
                            <span class="text-white mobile-title" style="font-size : 20px">Add Fuel Account
                                Details</span>
                        </div>
                        <div class=" col-lg-2 col-2  ">
                            <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addFuelAccount" action="<?php echo base_url() ?>addFuelAccount"
                            method="post" role="form">
                            <div class="row form-contents">
                                <div class="col-md-6  col-12">
                                    <div class="form-group">
                                        <label for="fuel_account_name">Cash Fuel Name </label>
                                        <input type="text" class="form-control "
                                            value="<?php echo set_value('fuel_account_name'); ?>" id="fuel_account_name"
                                            name="fuel_account_name" maxlength="128"
                                            placeholder="Enter Fuel Account Name" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-6  col-12">
                                    <div class="form-group">
                                        <label for="fuel_account_type"> Cash Fuel Type </label>
                                        <select class="form-control" id="fuel_account_type" name="fuel_account_type"
                                            required>
                                            <option value="">Select Fuel Type</option>
                                            <option value="Company">Company</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-contents">
                                <div class="col-md-6  col-12">
                                    <div class="form-group">
                                        <label for="account_opening_bal">Opening Balance </label>
                                        <input type="text" class="form-control "
                                            value="<?php echo set_value('account_opening_bal'); ?>" id="account_opening_bal"
                                            name="account_opening_bal" maxlength="128"
                                            placeholder="Opening Balance" autocomplete="off" required>
                                    </div>
                                </div>
                              
                            </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" style="float : left" value="Submit" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- End Modal -->
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/fuel_account/fuel_account.js" type="text/javascript"></script>
<script type="text/javascript">
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function openModal2(row_id, account_balance) {
    $("#Modal2").modal('show');
    document.getElementById("fuel_account_rowid").value = row_id;
    document.getElementById("modal_account_balance").value = account_balance;

}

jQuery(document).ready(function() {
    $("#bank_type_select").hide();
    $("#cash_type_select").hide();

    $('.js-example-basic-single').select2();
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        var value = link.substring(link.lastIndexOf('/') + 1);
        jQuery("#searchList").attr("action", baseURL + "fuelAccountListing/" + value);
        jQuery("#searchList").submit();
    });

    jQuery('.datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });

    $("#tran_type").change(function() {

        if (this.value == 'Cash') {
            $("#bank_type_select").hide();
            $("#cash_type_select").show();
        } else if (this.value == 'Bank') {
            $("#bank_type_select").show();
            $("#cash_type_select").hide();

        }

    });
});
</script>