<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href={{assets('admin_asset/images/logo.png')}} rel="icon">
    <link href={{assets('admin_asset/images/logo.png')}} rel="apple-touch-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href={{assets('admin_asset/css/bootstrap.min.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/font-awesome/css/font-awesome.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/css/plugins/dataTables/datatables.min.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/css/plugins/footable/footable.core.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/css/plugins/datapicker/datepicker3.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/css/plugins/iCheck/custom.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/css/plugins/steps/jquery.steps.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/css/plugins/select2/select2.min.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/css/plugins/select2/select2-bootstrap4.min.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/css/plugins/chosen/bootstrap-chosen.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/css/animate.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/css/style.css')}} rel="stylesheet">
    <link href={{assets('admin_asset/css/plugins/sweetalert/sweetalert.css')}} rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href={{assets('admin_asset/css/plugins/summernote/summernote-bs4.css')}} rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <!-- menu starts here -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header" style="height: 60px; margin-top: -6px;">
                        <div class="dropdown profile-element">
                            <p style="color: #1ab394;font-size: 20px;margin-top: -10px;"><strong>MIL</strong></p>
                        </div>
                        <div class="logo-element">
                            m!
                        </div>
                    </li>
                    <li class="">
                        <a href="">
                            <i class="fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a>
                            <i class="fa fa-cogs"></i>
                            <span class="nav-label">Operational Setting</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">

                        </ul>
                    </li>

                    <li class="">
                        <a>
                            <i class="fa fa-book"></i>
                            <span class="nav-label">Course</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href=""> &rArr; Category</a>
                            </li>
                            <li>
                                <a href=""> &rArr; Add Course</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a>
                            <i class="fa fa-cog"></i>
                            <span class="nav-label">User</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="#"> Change Password</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i> </a>
                        <a class="navbar-minimalize minimalize-styl-2" style="color: #1ab394;font-size: 20px;margin-top: 9px;padding-left: 0px;"><strong>Shikhalo</strong></a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li style="padding: 20px">
                            <span class="m-r-sm text-muted welcome-message"><strong>Welcome</strong> </span>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-sign-out"></i> <strong>Sign out</strong></a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">

                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- menu ends here -->
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Quick Menu</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <a href="#">
                                            <div class="dashshort">
                                                <div class="ibox">
                                                    <div class="shortcut">
                                                        <p align="center"><i class="fa fa-question-circle"></i></p>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <h4 align="center" class="no-margins">Total Quiz</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a><br />
                                    </div>

                                    <div class="col-lg-3">
                                        <a href="#">
                                            <div class="dashshort">
                                                <div class="ibox ">
                                                    <div class="shortcut">
                                                        <p align="center"><i class="fa fa-file-video-o"></i></p>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <h4 align="center" class="no-margins">Total Video</h4>
                                                    </div>

                                                </div>
                                            </div>
                                        </a><br />
                                    </div>

                                    <div class="col-lg-3">
                                        <a href="cntntoprtion.php?mipf=AddCampaign">
                                            <div class="dashshort">
                                                <div class="ibox ">
                                                    <div class="shortcut">
                                                        <p align="center"><i class="fa fa-bullhorn"></i></p>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <h4 align="center" class="no-margins">Campaign</h4>
                                                    </div>

                                                </div>
                                            </div>
                                        </a><br />
                                    </div>

                                    <div class="col-lg-3">
                                        <a href="cntntoprtion.php?mipf=Contact">
                                            <div class="dashshort">
                                                <div class="ibox">
                                                    <div class="shortcut">
                                                        <p align="center"><i class="fa fa-phone"></i></p>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <h4 align="center" class="no-margins">Update Contact</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a><br />
                                    </div>

                                    <div class="col-lg-3">
                                        <a href="cntntoprtion.php?mipf=Changpass">
                                            <div class="dashshort">
                                                <div class="ibox">
                                                    <div class="shortcut">
                                                        <p align="center"><i class="fa fa-key"></i></p>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <h4 align="center" class="no-margins">Change Password</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a><br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .dashshort {
                        border: 1px solid #1fb496;
                        border-style: dashed;
                    }
                </style>
            </div>
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