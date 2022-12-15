@extends('layouts.master')
@section('title')
    الطلبات
@stop
@section('css')
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">



@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <table class="table text-md-nowrap" data-page-length='50' id="example1">
                                        <thead>
                                        <tr>
                                            <th class="text-center border-bottom-0">#</th>
                                            @if (auth('service')->check() ||auth('admin')->check())
                                                <th class="text-center border-bottom-0">اسم المستخدم</th>
                                                <th class="text-center border-bottom-0">الايميل</th>
                                            @endif
                                            <th class="text-center border-bottom-0">اسم المنتج</th>
                                            <th class="text-center border-bottom-0">السعر</th>
                                            <th class="text-center border-bottom-0">الصوره</th>
                                            <th class="text-center border-bottom-0">الحالة</th>
                                            <th class="text-center border-bottom-0">العمليات</th>

                                        </tr>


                                        </thead>
                                        <tbody class="text-center">
                                        <?php $i=1; ?>
                                        @foreach($orders as $order)

                                            <tr>
                                                <td>{{$i++}}</td>
                                                @if (auth('service')->check() ||auth('admin')->check())
                                                    <td>{{$order->user->name}}</td>
                                                    <td>{{$order->user->email}}</td>
                                                @endif
                                                <td>{{$order->product->name}}</td>
                                                <td>{{$order->price}}</td>
                                                <td><img src="/product/{{$order->image}}" width="50" height="30"></td>
                                                <td>
                                                    @if($order->status == 'Initiated')
                                                        <label class="badge badge-danger">{{$order->status}}</label>
                                                    @elseif($order->status == 'Completed')
                                                        <label class="badge badge-success">{{$order->status}}</label>
                                                    @elseif($order->status == 'In-Progress')
                                                        <label class="badge badge-warning">{{$order->status}}</label>
                                                    @elseif($order->status == 'Delivered')
                                                        <label class="badge badge-primary">{{$order->status}}</label>
                                                    @else
                                                        <label class="badge badge-danger">{{$order->status}}</label>
                                                    @endif

                                                </td>
                                                <td>

                                                    @if (auth('service')->check())
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#edit{{ $order->id }}"
                                                                title="تعديل"><i class="las la-pen"></i>
                                                        </button>
                                                    @elseif(auth('web')->check())
                                                        @if($order->status == 'Initiated')
                                                        <a href="{{route('order.cancel',$order->id)}}" class="btn btn-outline-danger">الغاء الطلب</a>
                                                        @else
                                                            <label class="badge badge-info">شكرا لكم</label>
                                                        @endif
                                                    @elseif(auth('admin')->check())
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#delete{{ $order->id }}"
                                                                title="حذف"><i
                                                                class="las la-trash"></i>
                                                        </button>
                                                    @endif

                                                </td>
                                            </tr>

                                            <!-- edit_modal_Grade -->
                                            <div class="modal fade" id="edit{{ $order->id }}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                id="exampleModalLabel">
                                                                تعديل الطلب
                                                            </h5>

                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form action="{{route('order.update',$order->id)}}" method="post">
                                                                {{ method_field('patch') }}
                                                                @csrf

                                                                <input id="id" type="hidden" name="id" class="form-control"
                                                                       value="{{ $order->id }}">



                                                                <div class="col">
                                                                    <label for="exampleInputEmail1">تعديل حالة الطلب</label>
                                                                    <select class="form-control" id="status" name="status" >

                                                                        <option value="Completed">Completed</option>
                                                                        <option value="Delivered">Delivered</option>
                                                                        <option value="In-Progress">In-Progress</option>
                                                                        <option value="Progress">Progress</option>

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
                                            <div class="modal fade" id="delete{{ $order->id }}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('orders.destroy', 'test') }}" method="post">
                                                                {{ method_field('Delete') }}
                                                                @csrf
                                                                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                                                الطلب
                                                                {{ $order->product->name }}
                                                                <br>  <br>
                                                                <input id="id" type="hidden" name="id" class="form-control"
                                                                       value="{{ $order->id }}">
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
				</div>
				<!-- row closed -->







			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>



    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection
