<style>
    .footricon a i {
        color: #1ab394;
        letter-spacing: 20px;
        font-size: 25px;
    }
</style>
<div class="footer">
    <div class="text-center">
        <div class="footricon">
            <a href="http://www.musketeersidea.com/" target="_blank"><strong>Muskeeters Idea Limited</strong> <em>Simple Idea Effective Solution</em> </a>&emsp;
        </div>
    </div>
</div>
</div>
<script src={{assets('admin_asset/js/jquery-3.1.1.min.js')}}></script>
<script src={{assets('admin_asset/js/popper.min.js')}}></script>
<script src={{assets('admin_asset/js/bootstrap.js')}}></script>
<script src={{assets('admin_asset/js/plugins/metisMenu/jquery.metisMenu.js')}}></script>
<script src={{assets('admin_asset/js/plugins/slimscroll/jquery.slimscroll.min.js')}}></script>
<script src={{assets('admin_asset/js/plugins/jquery-ui/jquery-ui.min.js')}}></script>
<script src={{assets('admin_asset/js/inspinia.js')}}></script>
<script src={{assets('admin_asset/js/plugins/pace/pace.min.js')}}></script>
<script src={{assets('admin_asset/js/plugins/dataTables/datatables.min.js')}}></script>
<script src={{assets('admin_asset/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}></script>
<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel',
                    title: 'ExampleFile'
                },
                {
                    extend: 'pdf',
                    title: 'ExampleFile'
                },
                {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]
        });
    });
</script>
<script src={{assets('admin_asset/js/plugins/summernote/summernote-bs4.js')}}></script>

<script src={{assets('admin_asset/js/plugins/sweetalert/sweetalert.min.js')}}></script>
<script>
    $(document).ready(function() {
        $('.demo1').click(function() {
            swal({
                title: "Welcome in Alerts",
                text: "Lorem Ipsum is simply dummy text of the printing and typesetting industry."
            });
        });
        $('.demo2').click(function() {
            swal({
                title: "Good job!",
                text: "You clicked the button!",
                type: "success"
            });
        });
        $('.demo3').click(function() {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function() {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        });
        $('.demo4').click(function() {
            swal({
                    title: "Are you sure?",
                    text: "Your will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
        });
    });
</script>
<script src={{assets('admin_asset/js/plugins/datapicker/bootstrap-datepicker.js')}}></script>
<script src={{assets('admin_asset/js/plugins/footable/footable.all.min.js')}}></script>
<script>
    $(document).ready(function() {
        $('.footable').footable();
        $('#fromdate').datepicker({
            todayBtn: "linked",
            format: "yyyy-mm-dd",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true

        });
        $('#todate').datepicker({
            todayBtn: "linked",
            format: "yyyy-mm-dd",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        $('#date_added').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        $('#date_modified').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        $('#date_modified2').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
    });
</script>
<script src={{assets('admin_asset/js/plugins/chosen/chosen.jquery.js')}}></script>
<script src={{assets('admin_asset/js/plugins/select2/select2.full.min.js')}}></script>
<script>
    $('.chosen-select').chosen({
        width: "100%"
    });
    $("#ionrange_1").ionRangeSlider({
        min: 0,
        max: 5000,
        type: 'double',
        prefix: "$",
        maxPostfix: "+",
        prettify: false,
        hasGrid: true
    });
</script>
<script src={{assets('admin_asset/js/plugins/steps/jquery.steps.min.js')}}></script>
<script src={{assets('admin_asset/js/plugins/validate/jquery.validate.min.js')}}></script>
<script>
    $(document).ready(function() {
        $("#wizard").steps();
        $("#form").steps({
            bodyTag: "fieldset",
            onStepChanging: function(event, currentIndex, newIndex) {
                if (currentIndex > newIndex) {
                    return true;
                }
                if (newIndex === 3 && Number($("#age").val()) < 18) {
                    return false;
                }
                var form = $(this);
                if (currentIndex < newIndex) {
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
                if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                    $(this).steps("next");
                }
                if (currentIndex === 2 && priorIndex === 3) {
                    $(this).steps("previous");
                }
            },
            onFinishing: function(event, currentIndex) {
                var form = $(this);
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                var form = $(this);
                form.submit();
            }
        }).validate({
            errorPlacement: function(error, element) {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
    });
</script>
<script src={{assets('admin_asset/js/plugins/iCheck/icheck.min.js')}}></script>
<script>
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
<script>
    $(".select2_demo_1").select2({
        theme: 'bootstrap4',
    });
    $(".select2_demo_2").select2({
        theme: 'bootstrap4',
    });
    $(".select2_demo_3").select2({
        theme: 'bootstrap4',
        placeholder: "Select a state",
        allowClear: true
    });
</script>
</body>

</html>