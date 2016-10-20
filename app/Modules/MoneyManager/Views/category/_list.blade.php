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

    // Format name column, add avatar prepend name
    function formatComboTree(node) {
        var avatar = '<a style="color:#f39c12; border:black"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span></a>';

        if (node.avatar){
            avatar = '<a><img src=\"{{ asset("storage") }}/' + node.avatar + '\" style="width:16px;height:18px" /></a>';
        }
        return avatar + '&nbsp;&nbsp;' + node.text;
    }
</script>
