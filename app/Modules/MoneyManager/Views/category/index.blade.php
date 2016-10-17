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
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <table id="tg" class="easyui-treegrid" title="Editable TreeGrid" style="width:100%;height:250px"
            data-options="
                iconCls: 'icon-ok',
                rownumbers: true,
                animate: true,
                collapsible: true,
                fitColumns: true,
                url: 'money-manager/treegrid-categories',
                method: 'get',
                idField: 'id',
                treeField: 'name',
                showFooter: true
            ">
            <thead>
                <tr>
                    <th data-options="field:'name',width:180,editor:'text'">Task Name</th>
                    <th data-options="field:'persons',width:60,align:'right',editor:'numberbox'">Persons</th>
                    <th data-options="field:'begin',width:80,editor:'datebox'">Begin Date</th>
                    <th data-options="field:'end',width:80,editor:'datebox'">End Date</th>
                    <th data-options="field:'progress',width:120,formatter:formatProgress,editor:'numberbox'">Progress</th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            function formatProgress(value){
                if (value){
                    var s = '<div style="width:100%;border:1px solid #ccc">' +
                            '<div style="width:' + value + '%;background:#cc0000;color:#fff">' + value + '%' + '</div>'
                            '</div>';
                    return s;
                } else {
                    return '';
                }
            }
            var editingId;
            function edit(){
                if (editingId != undefined){
                    $('#tg').treegrid('select', editingId);
                    return;
                }
                var row = $('#tg').treegrid('getSelected');
                if (row){
                    editingId = row.id
                    $('#tg').treegrid('beginEdit', editingId);
                }
            }
            function save(){
                if (editingId != undefined){
                    var t = $('#tg');
                    t.treegrid('endEdit', editingId);
                    editingId = undefined;
                    var persons = 0;
                    var rows = t.treegrid('getChildren');
                    for(var i=0; i<rows.length; i++){
                        var p = parseInt(rows[i].persons);
                        if (!isNaN(p)){
                            persons += p;
                        }
                    }
                    var frow = t.treegrid('getFooterRows')[0];
                    frow.persons = persons;
                    t.treegrid('reloadFooter');
                }
            }
            function cancel(){
                if (editingId != undefined){
                    $('#tg').treegrid('cancelEdit', editingId);
                    editingId = undefined;
                }
            }
        </script>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection

@section('page_script')
<script type="text/javascript">
    function submitDeleteForm(formId) {
        if (confirm("{{ trans('MoneyManager::category.index.confirm_message') }}")) {
            $('#' + formId).submit();
        }
    }
</script>
@endsection
