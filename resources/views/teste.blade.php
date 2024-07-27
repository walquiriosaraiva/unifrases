<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Paginação AJAX</title>
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</head>
<body>
<h1>Idiomas</h1>

<table class="table">
    <tr>
        <th style="width: 20%">Id</th>
        <th>Descrição</th>
    </tr>
    @foreach($idiomas as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->texto}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="2" valign="center" align="center">
            {{ $idiomas->links() }}
        </td>
    </tr>
</table>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function getTable(url)
    {

        if (url == ''){
            url = "{{route('teste.post')}}";
        }

        $.get(url, null, function(data)
        {
            alert(data);
            $('#table').html(data);
            linkAjax();
        },'html');
        $.post(url, null, function(data)
        {
            $('#table').html(data);
            linkAjax();
        },'html');
    }
    function linkAjax()
    {
        $items = $('#table table').find('[href]');
        $.each($items, function(index, element){
            var href = $(element).attr('href');
            $(element).attr('href', 'javascript:getTable("' + href + '")');
        });
    }
    $(document).ready(function(){
        getTable('');
    });
</script>
</body>
</html>