@extends('layouts.app')

@section('page_header', 'Category')
@section('page_header_description', 'Create')

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create new Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                  <label for="avatar">Avatar</label>
                  <input type="file" id="avatar" name="avatar">

                  <p class="help-block">Upload avatar of this category</p>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
    </div>
@endsection
