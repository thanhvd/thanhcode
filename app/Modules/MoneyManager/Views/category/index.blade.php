@extends('layouts.app')

@section('title', trans('MoneyManager::category.index.title'))
@section('page_header', trans('MoneyManager::category.index.page_header'))
@section('page_header_description', trans('MoneyManager::category.index.page_header_description'))

@section('content')
  <!-- will be used to show any messages -->
  @if (Session::has('message'))
      <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

  <div class="row">
    <!-- Create form -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('MoneyManager::category.create.title') }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
          <div class="box-body">
            @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{ csrf_field() }}
            <div class="form-group">
              <label for="name">{{ trans('MoneyManager::category.create.labels.name') }}</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="{{ trans('MoneyManager::category.create.placeholders.name') }}" value="{{ old('name') }}">
            </div>
            <div class="form-group">
              <label for="avatar">{{ trans('MoneyManager::category.create.labels.avatar') }}</label>
              <input type="file" id="avatar" name="avatar">

              <p class="help-block">{{ trans('MoneyManager::category.create.descriptions.avatar') }}</p>
            </div>
            <div class="form-group">
              <label for="parent_id">{{ trans('MoneyManager::category.create.labels.parent') }}</label>
              <input class="easyui-combotree" style="width:100%" name="parent_id"
                data-options="
                    url: 'money-manager/combotree-categories',
                    method: 'get',
                    formatter: formatComboTree
              ">
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{ trans('MoneyManager::category.create.buttons.submit') }}</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!-- List category -->
    <div class="col-md-6">
      <div class="box">
        <!-- /.box-header -->
        <table id="tg" class="easyui-treegrid" title="{{ trans('MoneyManager::category.index.title') }}" style="width:100%;"
            data-options="
                rownumbers: true,
                animate: true,
                fitColumns: true,
                url: 'money-manager/treegrid-categories',
                method: 'get',
                idField: 'id',
                treeField: 'name',
                toolbar: '#category-toolbar',
            ">
            <thead>
                <tr>
                    <th data-options="field:'name',width:50,editor:'text',formatter:formatName">{{ trans('MoneyManager::category.index.table.head.name') }}</th>
                </tr>
            </thead>
        </table>
        <div id="category-toolbar">
            <a class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit()">Edit User</a>
            <a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroy()">Remove User</a>
        </div>

        <form id="destroy-form" role="form" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection

@section('page_script')
<script type="text/javascript">
    $(function(){
        // Auto resize treegrid when toggle sidebar
        $(document).on('click', $.AdminLTE.options.sidebarToggleSelector, function (e) {
            e.preventDefault();
            setTimeout(function(){
                $('#tg').treegrid('resize');
           }, 300);
        });
    });
    // Format name column, add avatar prepend name
    function formatName(value, row){
        var avatar = '<a style="color:#f39c12; border:black"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span></a>';

        if (row.avatar){
            avatar = '<a><img src=\"{{ asset("storage") }}/' + row.avatar + '\" style="width:16px;height:18px" /></a>';
        }
        return avatar + '&nbsp;&nbsp;' + value;
    }
    // Format name column, add avatar prepend name
    function formatComboTree(node) {
        var avatar = '<a style="color:#f39c12; border:black"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span></a>';

        if (node.avatar){
            avatar = '<a><img src=\"{{ asset("storage") }}/' + node.avatar + '\" style="width:16px;height:18px" /></a>';
        }
        return avatar + '&nbsp;&nbsp;' + node.text;
    }
    // Redirect to edit page
    function edit() {
        var row = $('#tg').treegrid('getSelected');
        if (row){
            url = "{{ route('categories.edit', ['id' => ':id' ]) }}";
            url = url.replace(':id', row.id);

            location.href = url;
        }
    }
    // Destroy category
    function destroy() {
        var row = $('#tg').treegrid('getSelected');
        if (row){
            action = "{{ route('categories.destroy', ['id' => ':id' ]) }}";
            action = action.replace(':id', row.id);

            $('#destroy-form').attr('action', action);

            if (confirm("{{ trans('MoneyManager::category.index.confirm_message') }}")) {
                $('#destroy-form').submit();
            }
        }
    }
</script>
@endsection
