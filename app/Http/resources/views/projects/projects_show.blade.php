@extends('templates.dashboard_template')

@section('scripts')
<script>
        function deleteProject() {
            var response = confirm("Are you sure you would like to delete this project?\nThis process is not reversible!");
            if (response){
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection

@section('content')
    <div class="row" style="margin:25px; margin-bottom: 200px; padding-right:10px;">
        <?php   
            $colspan = 3;
        ?>
        <div style="margin-bottom: 10px; background-color:#2c2c2c; padding:5px; " class="col-md-11">
            <table style="width:100%">
                <th colspan="{{$colspan}}" style="font-size:18px;text-align:center;padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121">
                        Project: {{ $project->name }}</th>
                <tr><td>
                        <a class="glyphicon glyphicon-edit" 
                        title="Edit RFI"
                        style="text-decoration: none; padding-top:10px;padding-bottom:10px;" href="/projects/{{$project->slug}}/edit"></a>
                </td></tr>
                <tr><td colspan="{{$colspan}}"><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                <tr><td>Description: {{ $project->description }}</td></tr>
                
                
            </table>
        </div>
        <div class="col-md-8" style="padding:0; padding-right:10px;">
            <div style="margin-right: 2px; background-color:#2c2c2c;padding: 5px;" class="col-md-12">
                <table style="width:100%; ">
                    <th colspan=4
                        style="text-align:center;padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121">
                        Your RFI's
                    </th>
                     <tr>
                        <td>
                            <a class="glyphicon glyphicon-plus" 
                            title="Create a new RFI"
                            style="text-decoration: none; padding-top:10px;padding-bottom:10px;" href="/rfis/create"></a>
                         </td>
                    </tr>
                    <tr><td colspan="4"><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                    <th style="padding-left:10px;border-bottom:1px solid #5f4a3d;background-color: #212121">#</th>
                    <th style="padding-left:10px;border-bottom:1px solid #5f4a3d;background-color: #212121">Subject</th>
                    <th style="border-bottom:1px solid #5f4a3d;background-color: #212121">Date/Time submitted</th>
                    <th style="border-bottom:1px solid #5f4a3d;background-color: #212121">Last update</th>
                    <tr><td colspan="{{$colspan}}"><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                    
                    <tr>
                        @foreach($project->rfis()->get() as $rfi)
                            @if($rfi->user_id == Auth::id())
                                <td>{{ $rfi->control_number }}</td>
                                <td style="padding:3px;"><a href="/rfis/{{$rfi->slug}}">{{ $rfi->subject }}</a></td>
                                <td>{{ $rfi->created_at }}</td>
                                <td>{{ $rfi->updated_at }}</td>
                            @endif
                    </tr>
                    @endforeach
                </table>
            </div>
            <div style="padding:0; background-color:#2c2c2c; padding:5px;margin-top: 10px;" class="col-md-12">
                <table style="width:100%">
                    <th colspan="5"
                        style="font-size:18px;text-align:center;padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121">
                        All Other RFI's
                    </th>
    
                    <tr><td colspan="5"><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                    <th style="padding-left:10px;border-bottom:1px solid #5f4a3d;background-color: #212121">#</th>
                    <th style="padding-left:10px;border-bottom:1px solid #5f4a3d;background-color: #212121">Subject</th>
                     <th style="border-bottom:1px solid #5f4a3d;background-color: #212121">Date/Time submitted</th>
                    <th style="border-bottom:1px solid #5f4a3d;background-color: #212121">Last update</th>
                    <th style="border-bottom:1px solid #5f4a3d;background-color: #212121">Submitted by</th>
                    <tr><td colspan="{{$colspan}}"><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                    </tr>
                    <?php 
                        $myUtil = new \gotham\Http\Controllers\MyUtilController;
                        $rfiCollection = $myUtil->paginate($project->rfis()->get(),15);
                    ?>
                    <tr><td colspan="5">{{ $rfiCollection->links() }}</td></tr>
                    <tr>
                        @foreach( $rfiCollection as $rfi)
                            @if($rfi->user_id != Auth::id())
                                <td>{{ $rfi->control_number }}</td>
                                <td style="padding:3px;"><a href="/rfis/{{$rfi->slug}}">{{ $rfi->subject }}</a></td>
                                <td>{{ $rfi->created_at }}</td>
                                <td>{{ $rfi->updated_at }}</td>
                                <td>{{ gotham\User::find($rfi->user_id)->getFullName() }}</td>
                            @endif
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div style="background-color:#2c2c2c; padding:5px;" class="col-md-3">
            <table style="width:100%">
                <th colspan="{{$colspan}}" style="text-align:center;font-size:18px;padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121">
                    Collaborators</th>
              
                <tr>
                    <td>
                        <a class="glyphicon glyphicon-plus" 
                        style="text-decoration: none; padding-top:10px; padding-bottom:10px;" 
                        title="Add new collaborator(s) to this project"
                        href="/projects/add_collaborator/{{$project->slug}}"></a>
                    
                        <a class="glyphicon glyphicon-minus" 
                        style="text-decoration: none; padding-top:10px; padding-bottom:10px;" 
                        title="Remove collaborator(s) from this project"
                        href="/projects/remove_collaborator/{{$project->slug}}"></a>
                    </td>
                </tr>
                <tr><td><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                @foreach(gotham\Project::find($project->id)->users as $collaborators)
                    <tr><td>{{ $collaborators->last_name }}, {{ $collaborators->first_name }}</td></tr>
                @endforeach
            </table>
        </div>

        

    </div>
    
@endsection