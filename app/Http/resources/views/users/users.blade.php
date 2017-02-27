@extends('templates.dashboard_template')

@section('scripts')
    <link href="/css/bootstrap-switch.css" rel="stylesheet">
    <script src="/js/bootstrap-switch.js"></script>
    <script>
        // Enables animation for the selected item
        $('#animated-switch').bootstrapSwitch('setAnimated', true);
        // Disables animation for the selected item
        $('#animated-switch').bootstrapSwitch('setAnimated', false);
    </script>
@endsection

@section('content')
    <div class="row" style="margin:25px; margin-bottom: 200px;">
        <?php
        $colspan = 4;
        ?>
        @if($users->count() > 0)

            <div style="padding:0; background-color:#2c2c2c; padding:5px;" class="col-md-7 col-md-offset-2">
                <table style="width:100%">
                    <th colspan="2" style="padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121">
                        Users</th>
                    <th colspan="1" style="padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121;">
                        @if($currentpage == 'enabled_users')
                            <p style="text-align:right">Records found: <span id="user_total">{{ number_format($users->total())}}</span></p>
                            <a style="text-align: right" href="/users/disabled">View disabled accounts</a>
                        @elseif($currentpage == 'disabled_users')
                            <p style="text-align:right">Records found: <span id="user_total">{{ number_format($users->total())}}</span></p>
                            <a style="text-align: right" href="/users">View enabled accounts</a>
                        @elseif($currentpage == 'search')
                            <p style="text-align:right">Records found: <span id="user_total">{{ number_format($users->total())}}</span></p>
                            <a style="text-align: right"  href="/users">View enabled accounts</a>
                        @endif

                    </th>

                    <?php
                    $myUtil = new \gotham\Http\Controllers\MyUtilController;
                    $users = $myUtil->paginate($users, 10);
                    ?>
                    <tr><td colspan="{{$colspan}}" style="text-align: center">{{ $users->links() }}</td></tr>


                    <tr><td colspan="{{$colspan}}"><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                    <th style="border-bottom:1px solid #5f4a3d;background-color: #212121">
                        <a class="glyphicon glyphicon-plus"
                           style="text-decoration: none; padding-left:10px; padding-bottom:0px;"
                           title="Create a new project"
                           href="/users/create"></a>
                    </th>
                    <th style="border-bottom:1px solid #5f4a3d;background-color: #212121">First Name</th>
                    <th style="border-bottom:1px solid #5f4a3d;background-color: #212121">Updated at</th>

                    <tr><td colspan="{{$colspan}}"><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                    <?php
                    $row = 0;
                    $lineCount = $users->firstItem();

                    ?>
                    @foreach($users as $user)
                        <?php
                        $row++;
                        if($row % 2 == 0){
                            $color = "#4C3E31";
                        } else {
                            $color = "none";
                        }
                        ?>
                        <tr style="background-color: {{ $color }}">
                            <td style="padding-left:10px;padding-right:5px">{{$lineCount}}.</td>
                            <td style="padding-right:15px"><a href="users/{{Hashids::encode($user->id)  }}">{{$user->last_name}}, {{$user->first_name}}</a></td>

                            <td style="padding-right:15px">{{$user->updated_at}}</td>
                        </tr>
                        <?php
                        $lineCount += 1;
                        ?>
                    @endforeach
                </table>
            </div>
        @else
            <div style="padding:0; background-color:#2c2c2c; padding:5px;" class="col-md-6 col-md-offset-3">
                <table style="width:100%">
                    <th colspan="{{$colspan}}" style="padding:10px;border-bottom:3px solid #5f4a3d;background-color: #212121">
                        Users</th>
                    <tr><td colspan="{{$colspan}}"><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                    <th style="border-bottom:1px solid #5f4a3d;background-color: #212121">
                        <a class="glyphicon glyphicon-plus"
                           style="text-decoration: none; padding-left:10px; padding-bottom:0px;"
                           title="Create a new project"
                           href="/users/create"></a>
                    </th>
                    <tr><td colspan="{{$colspan}}"><hr style="margin:0; border-color:#5f4a3d"></td></tr>
                    <tr><td style="text-align:center;padding-top:5px;font-weight:bolder; color:black" colspan="{{$colspan}}">No project records found</td></tr>
                </table>
            </div>

        @endif
    </div>

@endsection