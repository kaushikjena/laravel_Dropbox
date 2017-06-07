@extends('layouts.app')

@section('content')
    <!-- Bootstrap Boilerplate... -->
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <div class="container">
        	<div class="col-sm-12" align="center"><b>@if(isset($sts)) File uploaded successfully. @endif</b></div>
            
            <!-- New Task Form -->
            <form action="{{ url('save-file') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
    
                <!-- Task Name -->
                <div class="form-group">
                    <label for="task" class="col-sm-3 control-label">File Name</label>
    
                    <div class="col-sm-6">
                        <input type="text" name="file_name" id="file_name" class="form-control">
                    </div>
                </div>
    			<div class="form-group">
                    <label for="task" class="col-sm-3 control-label">Upload File</label>
    
                    <div class="col-sm-6">
                        <input type="file" name="drop_file" id="drop_file" class="form-control">
                    </div>
                </div>
                <!-- Add Task Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                             Upload
                        </button>
                    </div>
                </div>
            </form>
         </div>
     </div>
    <!-- TODO: Current Tasks -->
@endsection