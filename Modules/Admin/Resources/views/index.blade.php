@extends('layouts.master')
@section('content')
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
                                        <h4 align="center" class="no-margins">Total Brands</h4>
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
                                        <h4 align="center" class="no-margins">Total Category</h4>
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
                                        <h4 align="center" class="no-margins">Total Products</h4>
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
@endsection