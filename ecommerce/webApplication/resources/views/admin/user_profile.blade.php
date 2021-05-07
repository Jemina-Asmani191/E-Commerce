@extends('admin.Layouts.master')
@section('title','User Profile')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-eye"></i>
        </div>
        <div class="header-title">
            <h1>User Profile</h1>
            <small></small>
        </div>
    </section>
    @if(Session::has('flash_message_error'))
    <div class="alert alert-sm alert-danger alert-block" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{!! session('flash_message_error') !!}</strong>
    </div>
    @endif
    @if(Session::has('flash_message_success'))
    <div class="alert alert-sm alert-success alert-block" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{!! session('flash_message_success') !!}</strong>
    </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Form controls -->
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <!-- <div class="btn-group" id="buttonlist">
                            <a class="btn btn-add " href="{{url('admin/view_products')}}">
                                <i class="fa fa-eye"></i> View Products </a>
                        </div> -->
                    </div>
                    <div class="panel-body">
                        <form class="col-sm-6" enctype="multipart/form-data" action="{{url('/admin/user_profile')}}" method="post"> {{csrf_field()}}
                        <input type="hidden" class="form-control" name="old_pwd" id="old_pwd" required>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" value="{{$userDetail->username}}" name="username" id="username" required>
                            </div>
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" class="form-control" placeholder="Enter Old Password" name="current_pwd" id="current_pwd" required>
                            </div>
                            <div class=" form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" placeholder="Enter New Password" name="new_pwd" id="new_pwd" required>
                            </div>
                            <div class="reset-button">
                                <input type="submit" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection