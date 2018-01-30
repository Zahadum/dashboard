@extends('layouts.app')
@push('stylesheets')

@endpush

@section('content')
    <section class="content-header">
        <h1>
            Clicks
            <small>{{ $page_description or null }}</small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Clicks</li>
        </ol>

    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List of Click</h3>
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
                ajax: '{!! route('clicksAjax') !!}',

                dom:
                "<'row'<'col-sm-8'l><'col-sm-4'Bf>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [

                    {
                        text: 'Download',
                        className: 'btn btn-success buttons-download',
                        action: function ( e, dt, node, config ) {
                            var url = '{{ route("getxls") }}';
                            window.open(url);
                        }
                    }

                ],
                columns:[
                    {data:'id',name:'Id',title:'id'},
                    {data:'andar_account_number',name:'andar_account_number',title:'Andar Acc #'},
                    {data:'link.issue_article',name:'link.issue_article',title:'Issue_Article'},
                    {data:'ip_address',name:'ip_address','title':'IP Address'},
                    {data:'created_at',name:'Created At','title':'Created At'},
                    {data:'updated_at',name:'Updated At','title':'Updated At'},

                ]
            });

        })
    </script>
@stop
