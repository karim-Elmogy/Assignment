@extends('layouts.master')
@section('css')

    @section('title')
        قائمة مقدمين الخدمة
    @stop

    <!-- Internal Data table css -->

    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                مقدمين الخدمة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">

                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover text-center" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">اسم المستخدم</th>
                                <th class="wd-20p border-bottom-0">البريد الالكتروني</th>
                                <th class="wd-15p border-bottom-0">حالة المستخدم</th>
                                <th class="wd-10p border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->email }}</td>
                                    <td>
                                        @if ($service->stauts == 0)
                                            <span class="label text-success d-flex">
                                                <div class="dot-label bg-success ml-1"></div>مفعل
                                            </span>
                                        @else
                                            <span class="label text-danger d-flex">
                                                <div class="dot-label bg-danger ml-1"></div>غير مفعل
                                            </span>
                                        @endif
                                    </td>



                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $service->id }}"
                                                title="تعديل"><i class="las la-pen"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $service->id }}"
                                                title="حذف"><i class="las la-trash"></i>
                                        </button>

                                    </td>
                                </tr>



                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $service->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    تعديل حالة مقدم الخدمة
                                                </h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{route('services.update',$service->id)}}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf

                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $service->id }}">



                                                    <div class="col">
                                                        <label for="exampleInputEmail1">تعديل حالة مقدم الخدمة</label>
                                                        <select class="form-control" id="stauts" name="stauts" >

                                                            <option value=0>تفعيل</option>
                                                            <option value=1>الغاء التفعيل</option>

                                                        </select>
                                                    </div>



                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">الغاء</button>
                                                        <button type="submit"
                                                                class="btn btn-success">تاكيد</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- delete_modal-->
                                <div class="modal fade" id="delete{{ $service->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title">حذف </h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('services.delete',$service->id)}}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                                    {{ $service->name }}
                                                    <br>  <br>
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $service->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">الغاء</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">تاكيد</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->


    </div>

    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>




@endsection
