<!-- <style>
.ss {
color: #fff;
padding: 20px;
display: none;
margin-top: 20px;
}

.red {
background: red;
}

.green {
background: green;
}

.blue {
background: blue;
}
</style> -->
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
<?php } ?>
<div class="row">
    <div class="col-md-12">
        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
    </div>
</div>
<div class="main-content-container container-fluid px-4 pt-2">
    <div class="content-wrapper">
        <div class="row p-0">
            <div class="col  padding_left_right_null">
                <div class="card card-small  p-0 m-b-1">
                    <div class="card-body p-2">
                        <div class="row ">
                            <div class="col-lg-5 col-sm-8 col-8">
                                <span class="page-title">
                                    <i class="fa fa-user"></i> Panchanga Pooja Management
                                </span>
                            </div>
                            <div class="col-lg-5 col-sm-8 col-8">
                                <span class="page-title">
                                  Total Count : <?php echo $panchangaPoojaCount ?>
                                </span>
                            </div>
                            <div class="col-lg-2 col-sm-8 col-4 ">
                                <a class="btn btn-primary mobile-btn pull-right" href="" data-toggle="modal"
                                    data-target="#Modal"><i class="fa fa-plus"></i> Add New </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col  padding_left_right_null">
                <div class="card card-small mb-4">
                    <div class="card-body p-1  text-center table-responsive">
                        <table id="member-list" style="width:100%"
                            class="display table table-striped table-hover nowrap ">
                            <thead>
                                <tr>
                                    <!-- <th>ID</th> -->
                                    <th>Seva By</th>
                                    <th>Pooja Type</th>
                                    <th>Masa</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <div id="Modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header modal-call-report p-2">
                        <div class=" col-md-10 col-10">
                            <span class="text-white mobile-title" style="font-size : 20px">Add Panchanga Pooja
                                Details</span>
                        </div>
                        <div class=" col-md-2 col-2">
                            <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body m-0">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addSubscription" action="<?php echo base_url() ?>addDailyPooja"
                            method="post" role="form">
                            <input type="hidden" name="row_id" id="row_id" />
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="devotee_id">Seva By*</label>
                                        <select class="form-control selectpicker" id="devotee_id" name="devotee_id" required data-live-search="true">
                                            <option value=""> Select Seva By </option>
                                            <?php if(!empty($poojaInfo)) {
                                        foreach($poojaInfo as $role ){?>
                                            <option value="<?php echo $role->row_id;?>">
                                                <?php echo $role->devotee_name;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="event_type">Pooja Type*</label>
                                        <select class="form-control " id="event_type" name="event_type" required>
                                            <!-- <option value="">Select Pooja Type</option>
                                            <option value="Date">Date</option> -->
                                            <!-- <option value="Event">Event</option>
                                                <option value="Tithi">Tithi</option>
                                                <option value="Nakshathra">Nakshathra</option>
                                                <option value="Masa">Masa</option>
                                                <option value="Rashi">Rashi</option>  -->
                                            <option value="Panchanga">Panchanga</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="event_date_only col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="date">Date*</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <span
                                                    class="input-group-text material-icons date-icon">date_range</span>
                                                <input id="date" type="text" name="date"
                                                    class="form-control datepicker date-col-3 required "
                                                    placeholder="Select Date" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-12 event_panchanga">
                                    <div class="form-group">
                                        <label for="tithi_id">Tithi*</label>
                                        <select class="form-control selectpicker" id="tithi_id" name="tithi_id" data-live-search="true">
                                            <option value=""> Select Tithi </option>
                                            <?php if(!empty($tithiInfo)) {
                                        foreach($tithiInfo as $tithi ){?>
                                            <option value="<?php echo $tithi->row_id;?>">
                                                <?php echo $tithi->tithi;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 event_date" id="dpnakshathra">
                                    <div class="form-group">
                                        <label for="nakshathra_id">Nakshathra*</label>
                                        <select class="form-control selectpicker" id="nakshathra_id" name="nakshathra_id" required data-live-search="true">
                                            <option value=""> Select Nakshathra </option>
                                            <?php if(!empty($nakshathraInfo)) {
                                        foreach($nakshathraInfo as $nakshathra ){?>
                                            <option value="<?php echo $nakshathra->row_id;?>">
                                                <?php echo $nakshathra->nakshathra;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 event_panchanga">
                                    <div class="form-group">
                                        <label for="masa_id">Masa*</label>
                                        <select class="form-control selectpicker" id="masa_id" name="masa_id" data-live-search="true">
                                            <option value=""> Select Masa </option>
                                            <?php if(!empty($masaInfo)) {
                                        foreach($masaInfo as $masa ){?>
                                            <option value="<?php echo $masa->row_id;?>">
                                                <?php echo $masa->masa;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 event_date" id="dprashi">
                                    <div class="form-group">
                                        <label for="rashi_id">Rashi*</label>
                                        <select class="form-control selectpicker" id="rashi_id" name="rashi_id" required data-live-search="true">
                                            <option value=""> Select Rashi </option>
                                            <?php if(!empty($rashiInfo)) {
                                        foreach($rashiInfo as $rashi){?>
                                            <option value="<?php echo $rashi->row_id;?>">
                                                <?php echo $rashi->rashi;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 event_date" id="dpgothra">
                                    <div class="form-group">
                                        <label for="gothra_id">Gothra*</label>
                                        <select class="form-control selectpicker" id="gothra_id" name="gothra_id" required data-live-search="true">
                                            <option value=""> Select Gothra </option>
                                            <?php if(!empty($gothraInfo)) {
                                        foreach($gothraInfo as $gothra ){?>
                                            <option value="<?php echo $gothra->row_id;?>">
                                                <?php echo $gothra->gothra;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 event_date">
                                    <div class="form-group">
                                        <label for="occation_id">Occasion*</label>
                                        <select class="form-control selectpicker" id="occation_id" name="occation_id" required data-live-search="true">
                                            <option value=""> Select Occasion </option>
                                            <?php if(!empty($occationInfo)) {
                                        foreach($occationInfo as $occation ){?>
                                            <option value="<?php echo $occation->row_id;?>">
                                                <?php echo $occation->occation;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-12 event_panchanga">
                                    <div class="form-group">
                                        <label for="paksha_id">Paksha*</label>
                                        <select class="form-control selectpicker" id="paksha_id" name="paksha_id" data-live-search="true">
                                            <option value=""> Select Paksha </option>
                                            <?php if(!empty($pakshaInfo)) {
                                        foreach($pakshaInfo as $paksha ){?>
                                            <option value="<?php echo $paksha->row_id;?>">
                                                <?php echo $paksha->paksha;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="amount">Amount*</label>
                                        <select class="form-control selectpicker" id="amount" name="amount" required data-live-search="true">
                                            <option value=""> Select Amount </option>
                                            <?php if(!empty($subscriptionInfo)) {
                                        foreach($subscriptionInfo as $sub ){?>
                                            <option value="<?php echo $sub->amount;?>">
                                                <?php echo $sub->amount;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label for="role">Notes</label>
                                        <textarea class="form-control required" value="" name="remarks" id="remarks"
                                            rows="4" placeholder="Notes" autocomplete="off"></textarea>
                                    </div>
                                </div>

                            </div>



                            <div class="form-group">
                                <input style="float:right;" type="submit" class="btn btn-primary" value="Add" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>





    </div>
</div>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/committee/committee.js" charset="utf-8"> -->
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

// function changeStatus(){
//     //document.getElementById("booktype").style.visibility="hidden";
//     var status = document.getElementById("event_type");

//     if(status.value=="Date"){
//         document.getElementById("dpdate").style.visibility="visible";

//     }else{
//         document.getElementById("dpdate").style.visibility="hidden";
//     }
//     if(status.value=="Event"){
//         document.getElementById("dpevent").style.visibility="visible";

//     }else{
//         document.getElementById("dpevent").style.visibility="hidden";
//     }
//     if(status.value=="Tithi"){
//         document.getElementById("dptithi").style.visibility="visible";

//     }else{
//         document.getElementById("dptithi").style.visibility="hidden";
//     }
//     if(status.value=="Nakshathra"){
//         document.getElementById("dpnakshathra").style.visibility="visible";

//     }else{
//         document.getElementById("dpnakshathra").style.visibility="hidden";
//     }
//     if(status.value=="Masa"){
//         document.getElementById("dpmasa").style.visibility="visible";

//     }else{
//         document.getElementById("dpmasa").style.visibility="hidden";
//     }
//     if(status.value=="Rashi"){
//         document.getElementById("dprashi").style.visibility="visible";

//     }else{
//         document.getElementById("dprashi").style.visibility="hidden";
//     }
//     if(status.value=="Gothra"){
//         document.getElementById("dpgothra").style.visibility="visible";

//     }else{
//         document.getElementById("dpgothra").style.visibility="hidden";
//     }
// }

jQuery(document).ready(function() {
    $('#member-list thead tr').clone(true).appendTo('#member-list thead');
    $('#member-list thead tr:eq(1) th').each(function(i) {

        var title = $(this).text();
        if (title != 'Actions') {
            $(this).html(
                '<div class="form-group position-relative mb-0 mt-0 search-padding "><input type="text" class="form-control input-sm" placeholder="Search" ' +
                title + '" /> </div>');
            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        } else {
            $(this).html('');
        }
    });
    var table = $('#member-list').DataTable({

        processing: true,
        orderCellsTop: true,
        fixedHeader: true,
        responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Search records",
            "lengthMenu": "Show _MENU_ PanchangaPooja",
            "infoFiltered": "(filtered from _MAX_ total PanchangaPooja)",
            "info": "Showing _START_ to _END_ of _TOTAL_ PanchangaPooja",
            "infoEmpty": "Showing 0 to 0 of 0 PanchangaPooja",


            processing: '<img src="' + baseURL + 'assets/dist/img/load.gif" width="150"  alt="loader">'

        },

        columnDefs: [{
            width: 150,
            targets: 0
        }],


        "ajax": {
            url: '<?php echo base_url(); ?>/PanchangaPoojaDetails',
            type: 'POST',

        },
    });




    jQuery('.datepicker').datepicker({
        autoclose: true,
        orientation: "bottom",
        format: "dd-mm-yyyy"
    });

    jQuery(document).on("click", ".deleteDailyPooja", function() {
        // $("#wizard-picture").change(function() {
        //     readURL(this);
        // });
        var row_id = $(this).data("row_id"),
            hitURL = baseURL + "deleteDailyPooja",
            currentRow = $(this);

        var confirmation = confirm("Are you sure to delete this Daily Pooja?");

        if (confirmation) {
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: hitURL,
                data: {
                    row_id: row_id
                }
            }).done(function(data) {
                // console.log(data);
                currentRow.parents('tr').remove();
                if (data.status = true) {
                    alert("Daily Pooja successfully deleted");
                } else if (data.status = false) {
                    alert("Daily Pooja deletion failed");
                } else {
                    alert("Access denied..!");
                }
            });
        }
    });

});


// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             $('#uploadedImage').attr('src', e.target.result);
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }


$("#vImg").change(function() {
    readURL(this);
});

$(document).ready(function() {

    $('.event_date_only').hide();
    $('.event_date').show();
            $('.event_date_only').hide();
            $('.event_panchanga').show();
            $("#date").prop('required', false);
            $("#paksha_id").prop('required', true);
            $("#masa_id").prop('required', true);
            $("#tithi_id").prop('required', true);

    // $("#event_type").change(function() {
    //     event_type = $('#event_type').val();
    //     if (event_type == 'Date') {
    //         $('.event_date').show();
    //         $('.event_date_only').show();
    //         $('.event_panchanga').hide();
    //         $("#date").prop('required', true);
    //         $("#paksha_id").prop('required', false);
    //         $("#masa_id").prop('required', false);
    //         $("#tithi_id").prop('required', false);
    //     } else {
    //         $('.event_date').show();
    //         $('.event_date_only').hide();
    //         $('.event_panchanga').show();
    //         $("#date").prop('required', false);
    //         $("#paksha_id").prop('required', true);
    //         $("#masa_id").prop('required', true);
    //         $("#tithi_id").prop('required', true);
    //     }
    // });

});
</script>