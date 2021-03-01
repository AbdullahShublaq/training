@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{asset('dashboard_files/rtl/assets/css/bootstrap-fileinput.css')}}">
        <link href="{{asset('dashboard_files/assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"
              rel="stylesheet"/>
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>تعديل أصحاب العمل
                        <small>مرحبا بك في وظائف غزة</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                لوحة التحكم</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">أصحاب العمل</a></li>
                        <li class="breadcrumb-item active">تعديل</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>تعديل</strong> أصحاب العمل</h2>
                        </div>

                        <div class="body">
                            <form action="{{route('dashboard.employers.update', $employer)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>البيانات الرئيسية <span style="color: red">*</span></h2>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="الإسم" value="{{ $employer->name }}">
                                            @error('name')
                                                <span style="color: red; margin-right: 10px">{{ $errors->first('name') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control"
                                                   placeholder="الإيميل" value="{{ $employer->email }}">
                                            @error('email')
                                            <span style="color: red;margin-right: 10px">{{ $errors->first('email') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control"
                                                   placeholder="كلمة المرور">
                                            @error('password')
                                            <span style="color: red; margin-right: 10px">{{ $errors->first('password') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   placeholder="تأكيد كلمة المرور">
                                        </div>
                                    </div>
                                </div>

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>بيانات الحساب <span style="color: red">*</span></h2>
                                </div>

                                <div class="form-group last">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail"
                                             style="width: 200px; height: 150px;">
                                            <img src="{{ $employer->information->avatar }}"
                                                 alt=""/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                                <span class="btn btn-dark btn-file">
                                                    <span class="fileinput-new"> اختيار صورة </span>
                                                    <span class="fileinput-exists"> تغيير </span>
                                                    <input type="file" name="avatar"
                                                           value="{{ $employer->avatar }}">
                                                </span>
                                            <a href="" class="btn btn-danger fileinput-exists"
                                               data-dismiss="fileinput">
                                                حذف </a>
                                        </div>
                                        @error('avatar')
                                        <span style="color: red; margin-right: 10px">{{ $errors->first('avatar') }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix" style="margin-bottom: 15px">
                                    <div class="col-sm-6">
                                        <select class="form-control z-index show-tick nominate_beneficiary"
                                                data-live-search="true"
                                                name="region" required>
                                            <option selected disabled>- اختيار محافطة -</option>
                                            @foreach($regions as $region)
                                                <option {{ $employer->information->region_id === $region->id ? 'selected' : '' }} value="{{ $region->id }}">
                                                    {{ $region->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('region')
                                        <span style="color: red; margin-right: 10px">{{ $errors->first('region') }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control z-index show-tick nominate_beneficiary"
                                                data-live-search="true"
                                                name="category" required>
                                            <option selected disabled>- اختيار مجال -</option>
                                            @foreach($categories as $category)
                                                <option {{ $employer->information->category_id === $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <span style="color: red; margin-right: 10px">{{ $errors->first('category') }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="phone" class="form-control"
                                                   placeholder="الهاتف / الجوال" value="{{ $employer->information->phone }}">
                                            @error('phone')
                                            <span style="color: red; margin-right: 10px">{{ $errors->first('phone') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="type" class="form-control"
                                                   placeholder="نوع الشركة / المؤسسة" value="{{ $employer->information->type }}">
                                            @error('type')
                                            <span style="color: red;margin-right: 10px">{{ $errors->first('type') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="number" name="year" class="form-control"
                                                   placeholder="تأسست عام" value="{{ $employer->information->year }}">
                                            @error('phone')
                                            <span style="color: red; margin-right: 10px">{{ $errors->first('year') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <input type="text" name="address" class="form-control"
                                                   placeholder="العنوان" value="{{ $employer->information->address }}">
                                            @error('address')
                                            <span style="color: red;margin-right: 10px">{{ $errors->first('address') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="bio" rows="4" class="form-control no-resize"
                                                      placeholder="من نحن...">{{ $employer->information->bio }}</textarea>
                                            @error('bio')
                                            <span style="color: red;margin-right: 10px">{{ $errors->first('bio') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>بيانات مواقع التواصل</h2>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="web" class="form-control"
                                                   placeholder="website" value="{{ @$employer->socials->web }}">
                                            @error('web')
                                            <span style="color: red;margin-right: 10px">{{ $errors->first('web') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="linkedin" class="form-control"
                                                   placeholder="linkedin" value="{{ @$employer->socials->linkedin }}">
                                            @error('linkedin')
                                            <span style="color: red;margin-right: 10px">{{ $errors->first('linkedin') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="facebook" class="form-control"
                                                   placeholder="facebook" value="{{ @$employer->socials->facebook }}">
                                            @error('facebook')
                                            <span style="color: red; margin-right: 10px">{{ $errors->first('facebook') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="twitter" class="form-control"
                                                   placeholder="twitter" value="{{ @$employer->socials->twitter }}">
                                            @error('twitter')
                                            <span style="color: red;margin-right: 10px">{{ $errors->first('twitter') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="instagram" class="form-control"
                                                   placeholder="instagram" value="{{ @$employer->socials->instagram }}">
                                            @error('instagram')
                                            <span style="color: red; margin-right: 10px">{{ $errors->first('instagram') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="whatsapp" class="form-control"
                                                   placeholder="whatsapp" value="{{ @$employer->socials->whatsapp }}">
                                            @error('whatsapp')
                                            <span style="color: red;margin-right: 10px">{{ $errors->first('whatsapp') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <br>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-round">تعديل</button>
                                        <button type="reset" class="btn btn-default btn-round btn-simple">إلغاء
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{asset('dashboard_files/rtl/assets/js/bootstrap-fileinput.js')}}"></script>
        <script src="{{asset('dashboard_files/assets/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
    @endpush

@endsection