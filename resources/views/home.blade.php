@extends('layouts.app_home')
@section('content')
  <div id="page-content">
                    <div class="content-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="header-section">
                                    <h1>Suggestion </h1>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden-xs">
                                <div class="header-section">
                                    <ul class="breadcrumb breadcrumb-top">
                                        <li>Dashboard</li>
                                        <li><a href="">My Suggestion</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert_message"></div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="main_page_content" id="main_page_content">
                                <div class="block full">
                                    <div class="block-title">
                                        <h2>My Suggestion</h2>
                                        <div class="block-options pull-right">
                                            <a href="risk_impact_master_manage.html" class="btn btn-primary active" id="style-striped" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Add Risk Imapact"></a>
                                            
                                        </div>

                                    </div>
                                    <div class="table-responsive">
                                        <table id="example-datatable" class="table draggable table-striped table-bordered table-vcenter">
                                            <thead>
                                                <tr>
                                                    <td>S.no</td>
                                                    <td>Category</td>                                                    
                                                    <td class="text-center">Edit/Delete</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Define the Template TR to Clone for rest of the Rows -->
                                                <tr>
                                                    <td>1</td>
                                                    <td>Risk Rating</td>                                
                                                    <td class="text-center action-buttons">
                                                        <a href="edit_project.html" data-toggle="tooltip" title="Edit User" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                                        <a href="javascript:confirm('Delete')" data-toggle="tooltip" title="Delete User" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection
