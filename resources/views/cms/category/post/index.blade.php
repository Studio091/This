@extends('cms.layout.master')

@section('post')
class="active"
@endsection


@section('content')
<h1 class="page-header">Post</h1>

                 <div class="col-lg-12"><p><a href="/cms/post">Add post</a></p></div>
                   <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Visible</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($post as $p)
                                        <tr>
                                            <td><a href="/cms/view/{{$p->id}}">{{$p->title}}</a></td>
                                            <td>@if($p->visible == 1) Visible @else Invisible @endif</td>
                                            <td>{{$p->created_at}}</td>
                                            
                                            <td><a href="/cms/publish/{{$p->id}}">Edit</a> | <a href="/cms/post/delete/{{$p->id}}">Delete</a></td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
@endsection