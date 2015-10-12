@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-bootstrap/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-fixedheader/dataTables.fixedHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables-responsive/dataTables.responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/formvalidation/formValidation.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/select2/select2.css') }}">
@stop

@section('content')

    <div class="page animsition">
        <div class="page-header">
            <h4 class="page-title">{{ $title or 'Judul' }}</h4>
            <div class="page-header-actions">
                <form autocomplete="off" id="new_form" method="post" action="{{ url('/siswa/asrama') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <div class="form-group form-material floating row">
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="asrama" />
                            <label class="floating-label">Asrama<span class="required">*</span></label>
                        </div>
                        <div class="col-sm-4">
                            <select name="teacher_id" id="" class="form-control" data-plugin="select2" data-placeholder="Guru">
                                @if($teachers)
                                    <option value="">Guru</option>
                                    @foreach($teachers as $tch)
                                        <option value="{{ $tch->id }}">{{ $tch->nama }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="page-content">

            @if($asrama)
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"></h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover dataTable table-striped width-full" id="tableClassrooms">
                            <thead>
                            <tr>
                                <th>Asrama</th>
                                <th>Wali Asrama</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($asrama as $v)
                                <tr>
                                    <td>{{ $v->asrama }}</td>
                                    <td>{{ $v->nama }}</td>
                                    <td>{{ $v->id }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('/vendor/formvalidation/formValidation.min.js') }}"></script>
    <script src="{{ asset('/vendor/formvalidation/framework/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-fixedheader/dataTables.fixedHeader.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-bootstrap/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('/vendor/datatables-tabletools/dataTables.tableTools.js') }}"></script>
    <script src="{{ asset('/js/components/datatables.js') }}"></script>
    <script src="{{ asset('/vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('/js/components/toastr.js') }}"></script>
    <script src="{{ asset('/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/js/components/select2.js') }}"></script>

    <script>
        $(function(){

            var notif = "{{ Session::has('info') or '' }}";
            console.log(notif);
            if(notif != ''){
                toastr.success("{{ Session::get('info') }}", 'Info',{
                    positionClass : 'toast-top-full-width',
                });
            };

            var defaults = $.components.getDefaults("dataTable");

            var options = $.extend(true, {}, defaults, {
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [-1]
                }],
                "iDisplayLength": 5,
                "aLengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
                "oTableTools": {
                    "sSwfPath": "{{ asset('/vendor/datatables-tabletools/swf/copy_csv_xls_pdf.swf') }}"
                }
            });

            $('#tableClassrooms').dataTable(options);
        });

    </script>
@endsection