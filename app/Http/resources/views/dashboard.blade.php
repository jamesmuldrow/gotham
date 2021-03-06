<?php
use gotham\Http\Controllers\MyUtilController;
?>
@extends('templates.dashboard_template')

@section('scripts')

@endsection

@section('content')

    <div id="dashboard" class="row" style="margin:25px; margin-right:125px;" class="col-md-10">
        <div>
            @if(Auth::check())
                <?php
                    $user = Auth::user();
                    $projects = $user->projects;
                    $myutil = new gotham\Http\Controllers\MyUtilController;
                ?>
            @endif
            
                <div style="padding:0; background-color:#2c2c2c; padding:5px;" class="col-md-2">
                    <table style="width:100%">
                        <th style="padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121">
                            Projects</th>
                        <tr>
                            <td>
                                <a class="glyphicon glyphicon-plus" 
                                style="text-decoration: none; padding-top:10px; padding-bottom:10px;" 
                                title="Create a new project"
                                href="/projects/create"></a>
                                <a class="glyphicon glyphicon-th-list" 
                                title="List all projects"
                                style="text-decoration: none; padding-top:10px; padding-bottom:10px;" 
                                href="/projects"></a>
                            </td>
                        
                        </tr>
                        <tr><td><hr style="margin:0; border-color:#5f4a3d"></td></tr>

                        <tr><td style="font-size: 36px; text-align: center; line-height:150px;font-weight:bold" 
                        v-on="projectCountChange">
                            <span v-if="project_count === null">{{ number_format($projects->count()) }}</span>
                            <span v-else v-text="project_count"></span>
                        </td>
                        </tr>
    
                    </table>
                </div>
                <div style="padding:0; background-color:#2c2c2c; padding:5px;" class="col-md-2 col-md-offset-1">
                    <table style="width:100%">
                        <th style="padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121">
                            Your RFI's</th>
                        <tr>
                            <td>
                                @if($projects->count()  > 0)
                                    <a class="glyphicon glyphicon-th-list" 
                                    title="List all RFI's"
                                    style="text-decoration: none; padding-top:10px; padding-bottom:10px;" 
                                    href="/projects/rfis"></a>
                                @else 
                                    <a class="glyphicon glyphicon-th-list" 
                                    title="Add a project before you can list all RFI's"
                                    style="color:#3e3537; text-decoration: none; padding-top:10px; padding-bottom:10px;" 
                                    ></a>
                                @endif
                                
                            </td>
                        </tr>
                        <tr><td><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                        <?php
                            $rfi_count = gotham\RFI::where('user_id', Auth::id())->get()->count();
                            
                        ?>
                        <tr><td style="font-size:36px; text-align: center;line-height:150px; font-weight:bold">{{ number_format($rfi_count) }}</td></tr>
                    </table>
                </div>
                <div style="padding:0; background-color:#2c2c2c; padding:5px;" class="col-md-2 col-md-offset-1">
                    <table style="width:100%">
                        <th style="padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121">
                            Users
                        </th>
                        <tr><td class="">
                            <a class="glyphicon glyphicon-plus" 
                            title="Add a new user"
                            style=" text-decoration: none; 
                            padding-top:10px;padding-bottom:10px;" href="users/create"></a>
                            <a class="glyphicon glyphicon-th-list" 
                                title="List all active users"
                                style="text-decoration: none; padding-top:10px; padding-bottom:10px;" 
                                href="/users"></a>
                            </td>
                        </tr>
                        <tr><td><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                        
                        <tr><td style="font-size: 36px; text-align: center; line-height:150px;font-weight:bold" 
                        v-on="userCountChange">
                            <span v-if="user_count === null">{{ number_format(gotham\User::count()) }}</span>
                            <span v-else v-text="user_count"></span>
                        </td>
                        </tr>
                    </table>
                </div>
                <div style="padding:0; background-color:#2c2c2c; padding:5px;" class="col-md-2 col-md-offset-1">
                    <table style="width:100%">
                        <th style="padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121">
                            Groups
                        </th>
                        <tr><td class="">
                                <a class="glyphicon glyphicon-plus"
                                   title="Add a new group"
                                   style=" text-decoration: none;
                            padding-top:10px;padding-bottom:10px;" href="groups/create"></a>
                                <a class="glyphicon glyphicon-th-list"
                                   title="List all groups"
                                   style="text-decoration: none; padding-top:10px; padding-bottom:10px;"
                                   href="/groups"></a>
                            </td>
                        </tr>
                        <tr><td><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                        <tr><td style="font-size: 36px; text-align: center; line-height:150px;font-weight:bold">{{ number_format(gotham\Group::count()) }}</td></tr>
                    </table>
                </div>

                {{--Feature not added Yet--}}
            {{--<div style="padding:5px;padding-top:100px;" class="col-md-11 col-md-offset-0">--}}
                {{--<table style="width:100%">--}}
                    {{--<th style="padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121">Announcements</th>--}}

                {{--</table>--}}
            {{--</div>--}}

            
                
            
           
        </div>
    </div>
@endsection