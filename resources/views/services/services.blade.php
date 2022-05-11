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
							<h4 class="content-title mb-0 my-auto">الخدمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الخدمات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@if(session()->has('add'))
<script>
	window.onload = function() {
		notif({
			msg: "تم اضافة الخدمة بنجاح",
			type: "success"
		})
	}

</script>
@endif
@if(session()->has('update'))
<script>
	window.onload = function() {
		notif({
			msg: "تم تعديل الخدمة بنجاح",
			type: "success"
		})
	}

</script>
@endif
@if(session()->has('delete'))
<script>
	window.onload = function() {
		notif({
			msg: "تم حذف الخدمة بنجاح",
			type: "error"
		})
	}

</script>
@endif
				<!-- row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">قائمة الخدمات</h4>
								</div>
								<br>
								<div class="col-sm-6 col-md-4 col-xl-3">
									<a class="modal-effect btn btn-primary btn-sm" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8"><i class="fas fa-plus"></i> إضافة خدمة جديد</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">إسم الخدمة</th>
												<th class="wd-15p border-bottom-0">الصنف</th>
												<th class="wd-20p border-bottom-0">الوصف</th>
												<th class="wd-10p border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($services as $service)
											<tr>
												<td>
													@if($service->icon)
														<img class="rounded-circle avatar-md mr-2" src="{{URL::asset($service->icon)}}">
													@else
														<img class="rounded-circle avatar-md mr-2" src="{{URL::asset('assets/img/faces/1.jpg')}}">
													@endif
												</td>
												<td>{{ $service->name }}</td>
												<td>{{ $service->catiguries->name }}</td>
												<td>{{ $service->description }}</td>
												<td>
													<a href="#modaldemo7" class="modal-effect btn btn-outline-success btn-sm" data-toggle="modal" data-effect="effect-scale">
														<i class="fas fa-edit"></i>
													</a>
													<a href="#modaldemo6" class="modal-effect btn btn-outline-danger btn-sm" data-toggle="modal" data-effect="effect-scale">
														<i class="fas fa-trash"></i>
													</a>
												</td>
											</tr>
												<!-- edit services -->
												<div class="modal" id="modaldemo7">
													<div class="modal-dialog modal-dialog-centered" role="document">
														<div class="modal-content modal-content-demo">
															<div class="modal-header">
																<h6 class="modal-title">تعديل الصنف</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
															</div>
															<form action="{{ route('services.update') }}" method="POST" enctype="multipart/form-data">
																{{ csrf_field() }}
																<div class="modal-body">
																	<div class="row">
																		<label for="">إسم الصنف</label>
																		<input type="text" name="name" class="form-control" value="{{ $service->name }}">
																		<input type="hidden" name="id" value="{{ $service->id }}" >
																	</div>
																	<div class="row">
																		<label for="">الوصف</label>
																		<textarea name="description" id="" cols="30" class="form-control">
																			{{ $service->description }}
																		</textarea>
																	</div>
																	<div class="row">
																		<label for="">الايقونة</label>
																		<input type="file" class="form-control" name="icon" >
																		<img src="{{ URL::to($service->icon) }}" alt="" width="70px" height="70px">
																	</div>
																</div>
																<div class="modal-footer">
																	<button class="btn ripple btn-primary" type="submit">تعديل</button>
																	<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- delete services -->
												<div class="modal" id="modaldemo6">
													<div class="modal-dialog modal-dialog-centered" role="document">
														<div class="modal-content modal-content-demo">
															<div class="modal-header">
																<h6 class="modal-title">حذف الخدمة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
															</div>
															<form action="{{ route('services.delete') }}" method="POST" enctype="multipart/form-data">
																{{ csrf_field() }}
																<div class="modal-body">
																	
																	<div class="row">
																		<label for="" class="text-danger">هل أنت متأكد من عملية الحذف ؟</label>
																		<input type="hidden" name="id" value="{{ $service->id }}" >
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
										@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
						<!-- add services -->
						<div class="modal" id="modaldemo8">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">إضافة خدمة جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
										{{ csrf_field() }}
										<div class="modal-body">
											<div class="row">
												<label for="">إسم الخدمات</label>
												<input type="text" name="name" class="form-control">
											</div>
											<div class="row">
												<label for="">الصنف</label>
												<select name="catigurie_id" id="" class="form-control">
													<option value="">--حدد الصنف--</option>
													@foreach ($categuries as $categurie)
														<option value="{{ $categurie->id }}">{{ $categurie->name }}</option>
													@endforeach
												</select>
											</div>
											<div class="row">
												<label for="">الوصف</label>
												<textarea name="description" id="" cols="30" class="form-control"></textarea>
											</div>
											<div class="row">
												<label for="">الايقونة</label>
												<input type="file" class="form-control" name="icon" >
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
@endsection