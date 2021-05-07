@extends('admin.Layouts.master')
@section('title','Contact')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-eye"></i>
        </div>
        <div class="header-title">
            <h1>Contact</h1>
            <small>Contact Messages</small>
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

    <div id="message_success" style="display:none;" class="alert alert-sm alert-success">Status Enabled</div>
    <div id="message_error" style="display:none;" class="alert alert-sm alert-danger">Status Disabled</div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                            <a href="#">
                                <h4>View Contact messages</h4>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="info">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contactDetails as $contact)
                                    <tr>
                                        <td>{{$contact->id}}</td>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->subject}}</td>
                                        <td>{{$contact->message}}</td>

                                        {{-- <td>
                                            <input type="checkbox" class="CustomerStatus btn btn-success" rel="{{$contact->id}}" data-toggle="toggle" data-on="Active" data-of="Inactive" data-onstyle="success" data-offstyle="danger" @if($contact['status'] == "1" ) checked @endif>
                                            <div id="myElem" style="display:none;" class="alert alert-success">Active</div>
                                        </td> --}}
                                        <td>
                                            <a href="#" class="btn btn-add btn-sm" title="View More" data-toggle="modal" data-target="#myModal{{$contact->id}}"><i class="fa fa-eye"></i></a>
                                            <a href="{{url('/admin/delete_contact/'.$contact->id)}}" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure!');"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

                <!-- Modal -->
                @foreach($contactDetails as $contact)
                    <div class="modal fade in" id="myModal{{$contact->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h1 class="modal-title">{{$contact->name}}</h1>
                                </div>
                                <div class="modal-body">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        
                                        <tr>
                                            <td class="taskDesc">Name</td>    
                                            <td class="taskStatus">{{$contact->name}}</td>    
                                        </tr>
                                        <tr>
                                            <td class="taskDesc">Email</td>    
                                            <td class="taskStatus">{{$contact->email}}</td>    
                                        </tr>
                                        <tr>
                                            <td class="taskDesc">Subject</td>    
                                            <td class="taskStatus">{{$contact->subject}}</td>    
                                        </tr>
                                        <tr>
                                            <td class="taskDesc">Message</td>    
                                            <td class="taskStatus">{{$contact->message}}</td>    
                                        </tr>
                                        <tr>
                                            <td class="taskDesc">Status</td>    
                                            <td class="taskStatus">
                                                @if($contact->status == 0)
                                                    Inactive
                                                @else
                                                    Active
                                                @endif
                                            </td>    
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <!-- <button type="button" class="btn btn-add">Save changes</button> -->
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                @endforeach
                <!-- /.Modal -->
<!-- /.content-wrapper -->

@endsection