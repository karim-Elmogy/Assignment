@extends('layouts.master')
@section('title')
    تعديل الملف الشخصي
@stop
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الملف الشخصي</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل الملف الشخصي</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col">
            <div class="card mg-b-20">
                <div class="card-body" >
                    <div class="pl-0">


                        <div class="main-profile-overview" >

                                <div class="profile-user mb-3" style="text-align: center;">
                                    <img  alt="" src="{{URL::asset('assets/img/faces/user.png')}}" width="150" height="150" style="border-radius: 50%">

                                </div>
                                <div class="d-flex justify-content-between mg-b-20">
                                    <div style="text-align: center;margin: 0 auto">
                                        <h5 class="main-profile-name mb-2" >{{Auth::guard('service')->user()->name}}</h5>

                                        @if ($service->stauts == 0)
                                            <span class="label text-success d-flex">

                                                <div class="text-center" style="margin: 0 auto">
                                                    <div class="dot-label bg-success ml-1"></div>
                                                    <label class="badge badge-success"> مفعل</label>
                                                </div>


                                            </span>
                                        @else
                                            <span class="label text-danger d-flex">
                                                <div class="text-center" style="margin: 0 auto">
                                                   <div class="dot-label bg-danger ml-1"></div>
                                                     <label class="badge badge-danger"> غير مفعل</label>
                                                </div>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            <!-- main-profile-bio -->

                            <hr class="mg-y-30">
                            <form role="form" action="{{route('account.update',$service->id)}}"  method="POST">
                                {{ csrf_field() }}
                                {{ method_field('patch') }}
                                <input id="id" type="hidden" name="id" class="form-control"
                                       value="{{ $service->id }}">
                                <div class="form-group">
                                    <label for="name"> الاسم : </label>
                                    <input type="text" class="form-control" value="{{$service->name}}" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="Email">تعديل الايميل : </label>
                                    <input type="email" class="form-control" value="{{$service->email}}" name="email" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">تعديل كلمة المرور : </label>
                                    <input type="password" class="form-control" value="{{$service->password}}" name="password" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">تاكيد كلمة المرور : </label>
                                    <input type="password" id="password-confirm" class="form-control"  name="password_confirmation" required>
                                </div>


                                <button class="btn btn-primary " type="submit">حفظ</button>
                            </form>


                        </div>
                        <!-- main-profile-overview -->
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
@endsection
