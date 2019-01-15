@extends('admin.header')

@section('content')
    <div class="site-content">
        <!-- Content -->
        <div class="content-area p-y-1" >
            <div class="container-fluid">

                <ol class="breadcrumb no-bg m-t-1 m-b-1" >
                    <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/admin/user')}}">User</a></li>
                    <li class="breadcrumb-item active">data</li>
                </ol>

            </div>

        </div>

        <div class="box box-block bg-white">
            <div class="form-group" style="height: auto; overflow: hidden;">
                  <button type="button" class="  btn btn-primary w-min-sm m-b-1 waves-effect waves-light" style="float: right;display:inline-block" data-toggle="modal" data-target="#exampleModal">添加用户</button>
            </div>
            <table class="table table-striped table-bordered dataTable" id="user_tab">
                <thead>
                <tr>
                    <th>用户名</th>
                    <th>手机号</th>
                    <th>创建时间</th>
                    <th>最后登录时间</th>
                    <th>最后登录IP</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $v)
                <tr>
                    <td>{{$v->username}}</td>
                    <td>{{$v->phone}}</td>
                    <td>{{$v->created_time}}</td>
                    <td>{{$v->last_login_time}}</td>
                    <td>{{$v->ip}}</td>
                    <td></td>
                    <td><a href="" ><button type="button" class="btn btn-danger w-min-sm  waves-effect waves-light">删除用户</button></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>








</div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form-horizontal " method="post" enctype="multipart/form-data" action="{{url('/admin/user/add')}}">
                            {{ csrf_field() }}
                            <div class="form-group h-a" style="text-align: center">
                                <label for="signal-name" class=" col-form-label label120" >用户名：</label>
                                <div  style="float:left;">
                                    <input class="form-control" type="text"  placeholder="请输入用户名" name="username" required onKeyUp="if(this.value.length>8) this.value=this.value.substr(0,8)" >
                                </div>
                            </div>
                            <div class="form-group h-a">
                                <label for="signal-name" class=" col-form-label label120" >密    码：</label>
                                <div  style="float:left;">
                                    <input class="form-control" type="password"   placeholder="请输入密码" name="password" required onKeyUp="if(this.value.length>16) this.value=this.value.substr(0,16)">
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>


                </div>

            </div>
        </div>

        @if(Session::has('message'))
        <div id="toast-container" class="toast-top-right" aria-live="polite" role="alert"><div class="toast
@if(Session::get('type')=='danger')
                    toast-error
@elseif(Session::get('type')=='success')
                    toast-success
@endif " style="display: block;"><div class="toast-message">{{Session::get('message')}}</div></div></div>
        @endif

        <script>
            $(function () {

                $('#user_tab').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ]

                } );

            })
        </script>
        <script>
            $(function () {
                var toast = $('#toast-container');
                setTimeout(function () {
                    toast.fadeOut(1000);
                },3000);
            })
        </script>
@stop