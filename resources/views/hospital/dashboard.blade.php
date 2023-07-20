@extends('layouts.hospital')
@section('title', 'Dashboard')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">

                <div class="mt-2 mb-2">
                    <div class="row">

                        <div class="">
                            <div class="text-center justify-content-center">
                            <h1 class="mt-4"><strong><span style="color: #000000;"> Welcome </span> to <span style="color: #3E4097;" > BHARAT </span> <span style="color: #FF9E0D;" >CLAIMS</span> </strong></h1>

                            <h1 class="mt-2"><strong><p><span style="color: #000000;"><p>Claimstack 2.O</p></span></p></strong></h1>
                            </div>


                            <div class="col-12 mt-2">
                                <div class=" mb-md-0 mb-3">
                                    <div class="hospital-dashboard" style="position: absolute;   width: 936px;   height: 415px;    left: 294px;     top: 235px;    background: #FFFFFF;    border: 2px solid rgba(253, 226, 157, 0.3);    box-shadow: inset 0px 2px 2px rgba(0, 0, 0, 0.25);    border-radius: 15px; box-shadow: 0px 4px 4px 0px #00000040 inset;">

                                        <h2 style="margin-left: 15px; margin-top: 20px;"><span style="color:#3E4097">The Executive you are </span> <span style="color:#FF9E0D"> Linked to </span> <span style="color:#3E4097"> is:</span></h2>
                                        <div style="margin-left: 130px; color: #000000;">
                                        <h4>
                                            <p>Name            :  {{ @$linked_employee->firstname }}</p>
                                            <p>Email ID        :  {{ @$linked_employee->email }}</p>
                                            <p>Contact No. :  {{ @$linked_employee->phone }}</p>
                                        </h4>
                                        </div>

                                        <h2 style="margin-left: 15px;"> <span style="color:#3E4097">For all your Operational Queries, Our </span> <span style="color:#FF9E0D"> Assigned Executive </span> <span style="color:#3E4097"> is: </span></h2>
                                        <div style="margin-left: 130px; color:#000000;">
                                        <h4>
                                            <p>Name            :  {{ @$assigned_employee->firstname }} {{ @$assigned_employee->lastname }}</p>
                                            <p>Email ID        :  {{ @$assigned_employee->email }}</p>
                                            <p>Contact No. :  {{ @$assigned_employee->phone }}</p>

                                        </h4>
                                    </div>
                                        <h2 style="margin-left: 15px;"><span style="color:#3E4097">For any escalations, you may </span> <span style="color:#FF9E0D"> Connect </span> <span style="color:#3E4097">to </span></h2>
                                        <p></p>
                                        <h3 style="color:#000000; margin-left: 10px; margin-left:30px;">       <span class="mdi mdi-card-account-mail"> helpdesk@bharatclaims.com              </span>  <span > <span style="float:right; margin-right: 30px;">        +919990301101</span></h3>
                                    </div>
                                </div> 
                            </div>

                        </div> 
                    </div>

                </div>
            </div>      
        </div>
@endsection
