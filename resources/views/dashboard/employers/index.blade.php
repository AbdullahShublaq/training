 @extends('layouts.dashboard.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{asset('dashboard_files/assets/plugins/sweetalert/sweetalert.css')}}"/>
        <link href="{{asset('dashboard_files/assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"
              rel="stylesheet"/>
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>كل أصحاب العمل
                        <small class="text-muted">مرحبا بك في وظائف غزة</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    @if(auth()->guard('admin')->user()->hasPermission('create_employers'))
                        <a href="{{route('dashboard.employers.create')}}">
                            <button class="btn btn-primary btn-icon btn-round d-none d-md-inline-block float-right m-l-10"
                                    type="button">
                                <i class="zmdi zmdi-plus"></i>
                            </button>
                        </a>
                    @else
                        <button class="btn btn-primary btn-icon btn-round d-none d-md-inline-block float-right m-l-10 disabled"
                                style="cursor: no-drop"
                                type="button">
                            <i class="zmdi zmdi-plus"></i>
                        </button>
                    @endif
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i class="zmdi zmdi-home"></i>لوحة
                                التحكم</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/employers') }}">أصحاب العمل</a></li>
                        <li class="breadcrumb-item active">الكل</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">
                        <div class="header">
                            <h2><strong>أصحاب العمل </strong><span>({{$employers->total()}})</span></h2>
                        </div>
                        @include('layouts.dashboard._message')
                        <div class="body">
                            <div class="col-12" style="padding-right: 0px">
                                <form action="{{ route('dashboard.employers.index') }}" method="GET">
                                    <div class="row clearfix">
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" name="search" class="form-control"
                                                       placeholder="بحث..." value="{{ request()->search }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <select class="form-control z-index show-tick nominate_beneficiary"
                                                    name="region">
                                                <option value="">- كل المحافظات -</option>
                                                @foreach($regions as $region)
                                                    <option {{ request()->region == $region->id ? 'selected' : '' }} value="{{ $region->id }}">
                                                        {{ $region->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <select class="form-control z-index show-tick nominate_beneficiary"
                                                    name="category">
                                                <option value="">- كل المجالات -</option>
                                                @foreach($categories as $category)
                                                    <option {{ request()->category == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <select class="form-control z-index show-tick nominate_beneficiary"
                                                    name="verified">
                                                <option value="">- التوثيق -</option>
                                                <option value="1">موثق</option>
                                                <option value="0">غير موثق</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-12 button-custom">
                                            <div class="form-group">
                                                <button type="submit" class="form-control btn-primary" style="color: white; border:none ">بحث</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-content m-t-10">
                                <div class="tab-pane table-responsive active">
                                    <table class="table m-b-0 table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الصورة</th>
                                            <th>اسم المستخدم</th>
                                            <th>الاسم</th>
                                            <th>الايميل</th>
                                            <th>المحافظة</th>
                                            <th>المجال</th>
                                            <th>التوثيق</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($employers as $employer)
                                            <tr>
                                                <td>{{ ($employers->currentPage()-1) * $employers->perPage() + $loop->index + 1 }}</td>
                                                <td>
                                                    <span class="list-icon">
                                                        <img class="patients-img"
                                                             src="{{ $employer->information->avatar }}"
                                                             alt=""
                                                             style="width: 50px; height: 50px">
                                                    </span>
                                                </td>
                                                <td><span class="list-name">{{ $employer->username }}</span></td>
                                                <td><span class="list-name">{{ $employer->name }}</span></td>
                                                <td>{{ $employer->email }}</td>
                                                <td>{{ $employer->information->region->name }}</td>
                                                <td>{{ $employer->information->category->name }}</td>
                                                <td>
                                                    @if(auth()->guard('admin')->user()->hasPermission('verify_employers'))
                                                        <form action="{{ route('dashboard.employers.verifyTrigger', $employer) }}"
                                                              method="POST" style="display: inline-block">
                                                            @csrf
                                                            <div class="checkbox">
                                                                <input id="checkbox_{{ $employer->id }}" class="verify_checkbox" type="checkbox" {{ $employer->verified ? 'checked' : '' }}>
                                                                <label for="checkbox_{{ $employer->id }}">{{ $employer->verified ? 'موثق' : 'غير موثق' }}</label>
                                                            </div>
                                                        </form>
                                                    @else
                                                        <div class="checkbox">
                                                            <input id="checkbox" type="checkbox" disabled {{ $employer->verified ? 'checked' : '' }}>
                                                            <label for="checkbox">{{ $employer->verified ? 'موثق' : 'غير موثق' }}</label>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(auth()->guard('admin')->user()->hasPermission('verify_employers'))
                                                        <a href="{{route('dashboard.employers.showVerifyForm', $employer)}}">
                                                            <button class="btn btn-icon btn-neutral btn-icon-mini"
                                                                    title="Verify">
                                                                <i class="zmdi zmdi-badge-check"></i>
                                                            </button>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
                                                                style="cursor: no-drop"
                                                                title="Edit">
                                                            <i class="zmdi zmdi-badge-check"></i>
                                                        </button>
                                                    @endif

                                                    @if(auth()->guard('admin')->user()->hasPermission('show_employers'))
                                                        <a href="{{route('dashboard.employers.show', $employer)}}">
                                                            <button class="btn btn-icon btn-neutral btn-icon-mini"
                                                                    title="Show">
                                                                <i class="zmdi zmdi-eye"></i>
                                                            </button>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
                                                                style="cursor: no-drop"
                                                                title="Edit">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </button>
                                                    @endif

                                                    @if(auth()->guard('admin')->user()->hasPermission('update_employers'))
                                                        <a href="{{route('dashboard.employers.edit', $employer)}}">
                                                            <button class="btn btn-icon btn-neutral btn-icon-mini"
                                                                    title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
                                                                style="cursor: no-drop"
                                                                title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    @endif

                                                    @if(auth()->guard('admin')->user()->hasPermission('delete_employers'))
                                                        <form action="{{ route('dashboard.employers.destroy', $employer) }}"
                                                              method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                    class="btn btn-icon btn-neutral btn-icon-mini remove_employer"
                                                                    title="Delete" value="{{$employer->id}}">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
                                                                style="cursor: no-drop"
                                                                title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">لا يوجد بيانات لعرضها...</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{$employers->appends(request()->query())->links()}}
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{  asset('dashboard_files/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{asset('dashboard_files/assets/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
        <script src="{{asset('dashboard_files/rtl/assets/js/jquery.blockUI.min.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $(".remove_employer").click(function (e) {
                    var that = $(this);
                    e.preventDefault();

                    swal({
                        title: "هل انت متأكد?",
                        text: "لن يمكنك استرجاعه بعد الحذف!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "نعم, قم بالحذف!",
                        cancelButtonText: "الغاء",
                        closeOnConfirm: false
                    }, function () {
                        that.closest('form').submit();
                    });
                });

                $('body').on('change', '.verify_checkbox', function(e) {
                    e.preventDefault();

                    $.blockUI({ message: `<b style="padding:10px 0px"><img src='{{asset('dashboard_files/busy.gif')}}' /> Just a moment...</b>` });

                    var that = $(this);
                    that.closest('form').submit();
                });
            });
        </script>
    @endpush

@endsection