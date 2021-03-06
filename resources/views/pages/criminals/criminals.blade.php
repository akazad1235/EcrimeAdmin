@extends('layouts.master')
@section('content')
<div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <h4 class="header-title font-weight-bold text-primary font">All Wanted Criminals List</h4>
                    
                        @if(Session::has('added_recorded'))
                            <script>
                                toastr.success("{!!Session::get('added_recorded')!!}");
                            </script>
                        @endif
                         @if(Session::has('error_recorded'))
                            <script>
                                toastr.error("{!!Session::get('error_recorded')!!}");
                            </script>
                        @endif
                    <table id="demo-custom-toolbar"  data-toggle="table"
                           
                            data-search="true"
                            data-show-refresh="true"
                            data-show-columns="true"
                            data-sort-name="id"
                            data-page-list="[5, 10, 20]"
                            data-page-size="5"
                            data-pagination="true" data-show-pagination-switch="true" class="table-borderless">
                        <thead class="thead-light">
                        <tr>
                        
                            <th data-field="no" data-sortable="true" data-formatter="dateFormatter">No</th>
                            <th data-field="name" data-sortable="true" data-formatter="dateFormatter">Name</th>
                            <th data-field="image" data-sortable="true" data-formatter="dateFormatter">Image</th>
                            <th data-field="desc" data-sortable="true" data-formatter="dateFormatter">Description</th>
                            <th data-field="create_date" data-sortable="true" data-formatter="dateFormatter">Create Date</th>
                            <th data-field="status" data-sortable="true" data-formatter="dateFormatter">Status</th>
                            <th data-field="action" data-sortable="true">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            @php
                                $i=1;     
                            @endphp
                        @foreach($allCrimicals as $value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ $value->name }}</td>
                           <td><img style="width:80px; height:50px; border-radius:5px" src="{{asset('admin/images/criminals/'.$value->image)}}" /></td>
                            <td>{{ substr($value->desc, 0, 20) }}</td>
                            {{-- <td>{{ date("d-m-Y", strtotime($value->updated_at)) }}</td> --}}

                            <td>{{ $value->updated_at->diffForHumans() }}</td>
                            
                            <td><span class="badge badge-{{$value->status == 0?'success':'danger'}}">{{$value->status == 1 ? 'Warrant': 'Arrest'}}</span></td>
                            <td><a class="btn btn-info btn-sm" href="{{ route('criminals.edit', base64_encode($value->id))}}">Edit</a> <a class="btn btn-danger btn-sm" href="{{ route('criminals.delete', base64_encode($value->id))}}">Delete</a></td>
                        </tr>
                        @endforeach
                       
                        
                        </tbody>
                    </table>
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        </div>

@endsection