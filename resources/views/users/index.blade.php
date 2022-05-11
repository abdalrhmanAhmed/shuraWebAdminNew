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
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
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
@if(session()->has('addUser'))
<script>
	window.onload = function() {
		notif({
			msg: "تم اضافة المستخدم بنجاح",
			type: "success"
		})
	}

</script>
@endif
@if(session()->has('error_password'))
<script>
	window.onload = function() {
		notif({
			msg: "كلمة المرور غير متطابقة",
			type: "error"
		})
	}

</script>
@endif
@if(session()->has('delete'))
<script>
	window.onload = function() {
		notif({
			msg: "تم حذف المستحدم بنجاح",
			type: "success"
		})
	}

</script>
@endif
@if(session()->has('updateUser'))
<script>
	window.onload = function() {
		notif({
			msg: "تم تعديل المستحدم بنجاح",
			type: "success"
		})
	}

</script>
@endif
				<!-- row -->
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">قائمة المستخدمين</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<div class="col-sm-6 col-md-4 col-xl-3">
									<a class="modal-effect btn btn-primary btn-sm" data-effect="effect-fall" data-toggle="modal" href="#modaldemo8"><i class="fas fa-plus"></i> إضافة مستخدم</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table text-md-nowrap border-top userlist-table">
									<table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="example1">
										<thead>
											<tr>
												<th class="wd-lg-20p"><span></span></th>
												<th class="wd-lg-8p"><span>المستخدم</span></th>
												<th class="wd-lg-20p"><span>إسم المستخدم</span></th>
												<th class="wd-lg-20p"><span>البريد اﻹلكتروني</span></th>
												<th class="wd-lg-20p"><span>الحالة</span></th>
												<th class="wd-lg-20p"><span>رقم الهاتف</span></th>
												<th class="wd-lg-20p"><span>الدولة</span></th>
												<th class="wd-lg-20p"><span>النوع</span></th>
												<th class="wd-lg-20p">Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($users as $user)
												<tr>
													<td>
														@if($user->photo)
															<img class="rounded-circle avatar-md mr-2" src="{{$user->photo}}">
														@else
															<img class="rounded-circle avatar-md mr-2" src="{{URL::asset('assets/img/faces/1.jpg')}}">
														@endif
													</td>
													<td>{{$user->name}}</td>
													<td>
														{{$user->username}}
													</td>
													<td class="text-center text-primary">
														{{$user->email}}
													</td>
													<td>
														@if ($user->isActive == '1')
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
														{{$user->phone}}
													</td>
													<td>
														{{$user->country}}
													</td>
													<td>
														@if($user->type == 0)
															admin
														@elseif($user->type == 1)
															مستشار
														@elseif($user->type == 2)
															مستخدم
														@endif
													</td>
													<td>
														<a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-primary">
															<i class="las la-search"></i>
														</a>
														<a href="" data-user-id="{{$user->id}}" data-user_name="{{ $user->name }}" 
															data-user_username="{{ $user->username }}" data-user_email="{{ $user->email }}"  
															data-user_gendor="{{ $user->gendor }}" data-user_phone="{{ $user->phone }}" 
															data-user_type="{{ $user->type }}" data-user_isActive="{{ $user->isActive }}" 
															data-user_country="{{ $user->country }}" data-user_password="{{ $user->password }}" 
															data-target="#modaldemo6" data-toggle="modal" data-effect="effect-scale"  class="modal-effect btn btn-sm btn-info">
															<i class="las la-pen"></i>
														</a>
														<a href="" data-user-id="{{$user->id}}" data-target="#modaldemo5" data-toggle="modal" data-effect="effect-scale"  class="modal-effect btn btn-sm btn-danger">
															<i class="las la-trash"></i>
														</a>
													</td>
												</tr>
												{{-- delete User modal --}}
												<div class="modal" id="modaldemo5">
													<div class="modal-dialog modal-dialog-centered" role="document">
														<div class="modal-content modal-content-demo">
															<div class="modal-header">
																<h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
															</div>
															<form action="{{ route('user.destroy') }}" method="POST">
																@csrf
																<div class="modal-body">
																	<div class="row">
																		<div class="col-md-6">
																			<label for="" class="text-danger">هل أنت متأكد من عملية الحذف ؟</label>
																			<input type="hidden" id="user_id" class="form-control" name="id" value="">
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
												{{-- edit user modal --}}
												<div class="modal" id="modaldemo6">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content modal-content-demo">
															<div class="modal-header">
																<h6 class="modal-title">تعديل مستخدم جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
															</div>
															<form action="{{ route("user.update") }}" method="POST" enctype="multipart/form-data">
																{{ csrf_field() }}
																<div class="modal-body">
																	<div class="row">
																		<div class="col-md-6">
																			<label for="">إسم المستخدم</label>
																			<input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
																			<input type="hidden" id="user_id" class="form-control" name="id" value="">
																		</div>
																		<div class="col-md-6">
																			<label for="">البريد اﻹلكتروني</label>
																			<input type="text" name="email" id="email" class="form-control">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-6">
																			<label for="">كلمة المرور</label>
																			<input type="password" class="form-control" name="password" id="password">
																		</div>
																		<div class="col-md-6">
																			<label for="">تاكيد كلمة المرور</label>
																			<input type="password" name="password2" id="password" class="form-control">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-6">
																			<label for="">الحالة</label>
																			<select name="isActive" class="form-control" id="isActive">
																				<option value="" ></option>
																				<option value="1">مفعل</option>
																				<option value="0">غير مفعل</option>
																			</select>
																		</div>
																		<div class="col-md-6">
																			<label for="">الإسم</label>
																			<input type="text" class="form-control" name="username" id="username">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-6">
																			<label for="">الجنس</label>
																			<select name="gendor" class="form-control" id="gendor">
																				<option value="" id="gendor" selected disabled></option>
																				<option value="1">ذكر</option>
																				<option value="0">أنثى</option>
																			</select>
																		</div>
																		<div class="col-md-6">
																			<label for="">النوع</label>
																			<select name="type" class="form-control" id="type">
																				<option value="" id="type" selected disabled></option>
																				<option value="0">admin</option>
																				<option value="1">مستشار</option>
																				<option value="2">مستخدم</option>
																			</select>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-6">
																			<label for="">رقم الهاتف</label>
																			<input type="text" class="form-control" name="phone" id="phone">
																		</div>
																		<div class="col-md-6">
																			<label for="">البلد</label>
																			<input type="text" name="country" class="form-control" id="country">
																		</div>
																	</div>
																	<div class="row">
																		<label for="">الصورة</label>
																		<input type="file" class="form-control" name="photo" accept="images/*" id="">
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

					{{-- add user modal --}}
					<div class="modal" id="modaldemo8">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">إضافة مستخدم جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<form action="{{ route("user.store") }}" method="POST" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="modal-body">
										<div class="row">
											<div class="col-md-6">
												<label for="">إسم المستخدم</label>
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
												<input type="password" name="password2" id="" class="form-control">
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label for="">الحالة</label>
												<select name="isActive" class="form-control" id="">
													<option value="" selected disabled>--حدد الحالة--</option>
													<option value="1">مفعل</option>
													<option value="0">غير مفعل</option>
												</select>
											</div>
											<div class="col-md-6">
												<label for="">الإسم</label>
												<input type="text" class="form-control" name="username" id="">
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
											<div class="col-md-6">
												<label for="">النوع</label>
												<select name="type" class="form-control" id="">
													<option value="" selected disabled>--حدد النوع--</option>
													<option value="0">admin</option>
													<option value="1">مستشار</option>
													<option value="2">مستخدم</option>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label for="">رقم الهاتف</label>
												<input type="text" class="form-control" name="phone" id="">
											</div>
											<div class="col-md-6">
												<label for="">البلد</label>
												<input type="text" name="country" class="form-control" id="">
											</div>
										</div>
										<div class="row">
											<label for="">الصورة</label>
											<input type="file" class="form-control" name="photo" accept="images/*" id="">
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
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script>
	$('#modaldemo5').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var user_id = button.data('user-id')
		var modal = $(this)
		modal.find('.modal-body #user_id').val(user_id);
	})
</script>
<script>
	$('#modaldemo6').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var user_id = button.data('user-id')
		var name = button.data('user_name')
		var username = button.data('user_username')
		var	email = button.data('user_email')
		var	password = button.data('user_password')
		var	gendor = button.data('user_gendor')
		var	type = button.data('user_type')
		var	isActive = button.data('user_isActive')
		var	country = button.data('user_country')
		var	phone = button.data('user_phone')
		if(isActive == 1){
			var active = "مفعل";
		}else{
			var active = "غير مفعل";
		}
		var modal = $(this)
		modal.find('.modal-body #user_id').val(user_id);
		modal.find('.modal-body #name').val(name);
		modal.find('.modal-body #username').val(username);
		modal.find('.modal-body #email').val(email);
		modal.find('.modal-body #password').val(password);
		modal.find('.modal-body #gendor').val(gendor);
		modal.find('.modal-body #phone').val(phone);
		modal.find('.modal-body #type').val(type);
		modal.find('.modal-body #isActive').val(active);
		modal.find('.modal-body #country').val(country);
	})
</script>
@endsection