@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المستخدمين</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
	<!-- include messages -->
	@include('notifications.notify')
	<!-- include exceptions -->
	@include('errors.exceptions')
		<!-- row -->
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
				<div class="card">
					<div class="card-header pb-0">
						<div class="d-flex justify-content-between">
							<h4 class="card-title mg-b-0">قائمة المستشاريين</h4>
							<i class="mdi mdi-dots-horizontal text-gray"></i>
						</div>
						<div class="col-sm-6 col-md-4 col-xl-3">
							<a class="modal-effect btn btn-primary btn-sm" data-effect="effect-fall" data-toggle="modal" href="#modaldemo8"><i class="fas fa-plus"></i> إضافة مستشار جديد</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table text-md-nowrap border-top consolelist-table">
							<table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="example1">
								<thead>
									<tr>
										<th class="wd-lg-20p"><span></span></th>
										<th class="wd-lg-8p"><span>المستخدم</span></th>
										<th class="wd-lg-20p"><span>إسم المستشار</span></th>
										<th class="wd-lg-20p"><span>البريد اﻹلكتروني</span></th>
										<th class="wd-lg-20p"><span>رقم حساب البنك</span></th>
										<th class="wd-lg-20p"><span>رقم الهاتف</span></th>
										<th class="wd-lg-20p"><span>الدولة</span></th>
										<th class="wd-lg-20p"><span>النوع</span></th>
										<th class="wd-lg-20p">العمليات</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($users as $console)
										<tr>
											<td>
												@if($console->photo)
													<img class="rounded-circle avatar-md mr-2" src="{{$console->photo}}">
												@else
													<img class="rounded-circle avatar-md mr-2" src="{{URL::asset('assets/img/faces/1.jpg')}}">
												@endif
											</td>
											<td>{{$console->name}}</td>
											<td>
												{{$console->consolename}}
											</td>
											<td class="text-center text-primary">
												{{$console->email}}
											</td>
											<td>
												@if ($console->isActive == '1')
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
												{{$console->phone}}
											</td>
											<td>
												{{$console->country}}
											</td>
											<td>
												@if($console->type == 0)
													admin
												@elseif($console->type == 1)
													مستشار
												@elseif($console->type == 2)
													مستخدم
												@endif
											</td>
											<td>
												<a href="" class="btn btn-sm btn-primary">
													<i class="las la-search"></i>
												</a>
												<a href="" data-target="#modaldemo6{{ $console->id }}" data-toggle="modal" data-effect="effect-scale"  class="modal-effect btn btn-sm btn-info">
													<i class="las la-pen"></i>
												</a>
												<a href="" data-console-id="{{$console->id}}" data-target="#modaldemo5" data-toggle="modal" data-effect="effect-scale"  class="modal-effect btn btn-sm btn-danger">
													<i class="las la-trash"></i>
												</a>
											</td>
										</tr>
										{{-- delete console modal --}}
										<div class="modal" id="modaldemo5">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content modal-content-demo">
													<div class="modal-header">
														<h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
													</div>
													<form action="" method="POST">
														@csrf
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6">
																	<label for="" class="text-danger">هل أنت متأكد من عملية الحذف ؟</label>
																	<input type="hidden" id="console_id" class="form-control" name="id" value="">
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button class="btn ripple btn-danger" type="submit">حذف</button>
															<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										{{-- edit console modal --}}
										<div class="modal" id="modaldemo6{{ $console->id }}">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content modal-content-demo">
													<div class="modal-header">
														<h6 class="modal-title">تعديل المستشار</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
													</div>
													<form action="" method="POST" enctype="multipart/form-data">
														{{ csrf_field() }}
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6">
																	<label for="">إسم المستشار</label>
																	<input type="text" class="form-control" name="name" value="{{ $console->name }}">
																</div>
																<div class="col-md-6">
																	<label for="">البريد اﻹلكتروني</label>
																	<input type="text" name="email" id="" class="form-control" value="{{ $console->email }}">
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<label for="">كلمة المرور</label>
																	<input type="password" class="form-control" name="password" id="">
																</div>
																<div class="col-md-6">
																	<label for="">تاكيد كلمة المرور</label>
																	<input type="password" name="password_confirmation" id="password-confirm" class="form-control">
																</div>
															</div>
													
															<div class="row">
																<div class="col-md-6">
																	<label for="">الجنس</label>
																	<select name="gendor" class="form-control" id="">
																		<option value="1">ذكر</option>
																		<option value="0" {{ $console->gendor == 0 ? 'selected' :'' }}>أنثى</option>
																	</select>
																</div>
																<div class="col">
																	<label for="">رقم الهاتف</label>
																	<input type="text" class="form-control" name="phone"  value="{{ $console->phone }}">
																</div>
															</div>
															<div class="row">
																<div class="col">
																	<label for="">حساب البنك</label>
																	<select name="bank_name" class="form-control" id="">
																		<option value="" selected disabled>--حدد حساب البنك--</option>
																		<option value="1">بنك الخرطوم</option>
																	</select>
																</div>
																<div class="col">
																	<label for="">رقم حساب البنك</label>
																	<input type="text" class="form-control" name="bank_no" value="{{ $console->bank_no }}">
																</div>
															</div>
															<div class="row">
																<div class="col">
																	<label for="">البلد</label>
																	<input type="text" name="country" class="form-control" value="{{ $console->country }}">
																</div>
																<div class="col">
																	<label for="">الاستشارات</label>
																	<select name="categories" class="form-control" id="">
																		<option value="" selected disabled>--حدد الإستشارة--</option>
																		@foreach ($categories as $category)
																			<option value="{{ $category->id }}" {{$console->profile->category == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
																		@endforeach
																	</select>
																</div>
															</div>
															
															<div class="row">
																<div class="col">
																	<label for="">الخدمات</label>
																	<select name="services[]" class="form-control" id="" multiple>
																		
																	</select>
																</div>
															
															</div>
															<div class="row">
																<label for="">المرفقات</label>&nbsp;
																<span class="text-danger">*ارفق الشهادة الجامعية وشهادات الخبرة والصورة الشخصية</span>
																<input type="file" class="form-control" name="photo[]" multiple>
															</div>
														</div>
														<div class="modal-footer">
															<button class="btn ripple btn-primary" type="submit">حفظ البيانات</button>
															<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div><!-- COL END -->

			{{-- add console modal --}}
			<div class="modal" id="modaldemo8">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">إضافة مستشار جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<form action="{{ route("console.store") }}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<label for="">إسم المستشار</label>
										<input type="text" class="form-control" name="name" id="">
									</div>
									<div class="col-md-6">
										<label for="">البريد اﻹلكتروني</label>
										<input type="text" name="email" id="" class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label for="">كلمة المرور</label>
										<input type="password" class="form-control" name="password" id="">
									</div>
									<div class="col-md-6">
										<label for="">تاكيد كلمة المرور</label>
										<input type="password" name="password_confirmation" id="password-confirm" class="form-control">
									</div>
								</div>
						
								<div class="row">
									<div class="col-md-6">
										<label for="">الجنس</label>
										<select name="gendor" class="form-control" id="">
											<option value="" selected disabled>--حدد الجنس--</option>
											<option value="1">ذكر</option>
											<option value="0">أنثى</option>
										</select>
									</div>
									<div class="col">
										<label for="">رقم الهاتف</label>
										<input type="text" class="form-control" name="phone" id="">
									</div>
								</div>
								<div class="row">
									<div class="col">
										<label for="">حساب البنك</label>
										<select name="bank_name" class="form-control" id="">
											<option value="" selected disabled>--حدد حساب البنك--</option>
											<option value="1">بنك الخرطوم</option>
										</select>
									</div>
									<div class="col">
										<label for="">رقم حساب البنك</label>
										<input type="text" class="form-control" name="bank_no" id="">
									</div>
								</div>
								<div class="row">
									<div class="col">
										<label for="">البلد</label>
										<input type="text" name="country" class="form-control" id="">
									</div>
									<div class="col">
										<label for="">الاستشارات</label>
										<select name="categories" class="form-control" id="">
											<option value="" selected disabled>--حدد الإستشارة--</option>
											@foreach ($categories as $category)
												<option value="{{ $category->id }}">{{ $category->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								
								<div class="row">
									<div class="col">
										<label for="">الخدمات</label>
										<select name="services[]" class="form-control" id="" multiple>

										</select>
									</div>
								
								</div>
								<div class="row">
									<label for="">المرفقات</label>&nbsp;
									<span class="text-danger">*ارفق الشهادة الجامعية وشهادات الخبرة والصورة الشخصية</span>
									<input type="file" class="form-control" name="photos[]" multiple>
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn ripple btn-primary" type="submit">حفظ البيانات</button>
								<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
							</div>
						</form>
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

{{-- start ajax code --}}
<script>
	$(document).ready(function(){
		$('select[name="categories"]').on('change',function(){
			var class_id = $(this).val();
			if(class_id)
			{
				$.ajax({
					url: "{{ URL::to('getServices') }}/" + class_id,
					type: "GET",
					dataType: "json",
					success:function(data)
					{
						$('select[name="services[]"]').empty();
						$.each(data, function(key, value){
							$('select[name="services[]"]').append('<option value="' + key + '">' + value + '</option>');
						});
					
					},
				});
			}else{
				console.log('Ajax Don`t Work !!!');
			}
		});
	});
</script>
@endsection