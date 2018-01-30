@extends('layouts.app')
@push('stylesheets')

@endpush

@section('content')
    <section class="content-header">
        <h1>
            Links
            <small>{{ $page_description or null }}</small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Links</li>
        </ol>

    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Upload CSV file to process</h3>
                    </div>
                    <div class="box-body">
                        <div class="alert alert-danger print-error-msg" style="display: none">
                            <ul></ul>
                        </div>
                        <form action="{{route('uploadcsv')}}"  enctype="multipart/form-data" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <i class="glyphicon glyphicon-file"></i>
                                            <span class="fileinput-filename"></span>
                                        </div>
                                        <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new">Select file</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="csvfile" id="csvfile"></span>
                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" id="uploadbtn">Upload</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List of Link</h3>
                    </div>
                    <div class="box-body">
                        <table id="link-table" class="table table-bordered table-striped">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-script')
    <script type="text/javascript">
    $(function () {
        table=$('#link-table').DataTable({
            processing:false,
            serverSide:false,
            order: [3,"desc"],
            ajax: '{!! route('linksAjax') !!}',

            columns:[
                {data:'id',name:'Id',title:'id'},
                {data:'issue_article',name:'issue_article',title:'Issue_Article'},
                {data:'url',name:'url',title:'URL'},
                {data:'interest',name:'interest','title':'Interest'},
                {data:'created_at',name:'Created At','title':'Created At'},
                {data:'updated_at',name:'Updated At','title':'Updated At'},

            ]
        });
        $("body").on("click","#uploadbtn",function(e){
            $(this).parents('form').ajaxForm(options);
        });
        var options={

            complete: function(response) {
                console.log('aaa');
                if($.isEmptyObject(response.responseJSON.error)) {
                    $("input[name='description']").val('');
                    $("input[name='csvfile']").val('');
                    $(".print-error-msg").hide();

                    table.ajax.reload();
                } else {
                    alert(response.responseJSON.error);
                }
            }
        };
    })
</script>
@stop
