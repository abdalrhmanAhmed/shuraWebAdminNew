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
							<h4 class="content-title mb-0 my-auto">التغزية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة التغزيات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
	@if(session()->has('success'))
		<script>
			window.onload = function() {
				notif({
					msg: "تم حفظ البيانات بنجاح",
					type: "success"
				})
			}

		</script>
	@endif

	@if(session()->has('update'))
		<script>
			window.onload = function() {
				notif({
					msg: "تم تعديل البيانات بنجاح",
					type: "success"
				})
			}

		</script>
	@endif

	@if(session()->has('delete'))
		<script>
			window.onload = function() {
				notif({
					msg: "تم حذف البيانات بنجاح",
					type: "success"
				})
			}

		</script>
	@endif

	@if ($errors->any())
		<div class="alert alert-danger">
			<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			@foreach ($errors as $error)
				{{$error}}
			@endforeach
		</div>
	@endif
				<!-- row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إضافة تغزية جديدة</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">sdgAmount</th>
												<th class="wd-20p border-bottom-0">point_amount</th>
												<th class="wd-15p border-bottom-0">المحفظة</th>
												<th class="wd-10p border-bottom-0">النوع</th>
												<th class="wd-25p border-bottom-0">إسم المدخل</th>
												<th class="wd-25p border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($feeds as $feed)
												<tr>
													<td>{{$loop->index+1}}</td>
													<td>{{$feed->sdgAmount}}</td>
													<td>{{$feed->point_amount}}</td>
													<td>{{$feed->wallets->user->name}}</td>
													<td>{{$feed->type}}</td>
													<td>{{$feed->entary_name}}</td>
													<td>
														<a class="modal-effect btn btn-success btn-sm" data-effect="effect-scale" data-toggle="modal" href="#edit{{ $feed->id }}"><i class="fas fa-edit"></i></a>
														<a class="modal-effect btn btn-danger btn-sm" data-effect="effect-scale" data-toggle="modal" href="#delete{{ $feed->id }}"><i class="fas fa-trash"></i></a>
													</td>
												</tr>
												<!-- edit modal -->
												<div class="modal" id="edit{{ $feed->id }}">
													<div class="modal-dialog modal-dialog-centered" role="document">
														<div class="modal-content modal-content-demo">
															<div class="modal-header">
																<h6 class="modal-title">تعديل التغزية</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
															</div>
															<form action="{{ route('update_wallet', $feed->id) }}" method="POST">
																@csrf
																<div class="modal-body">
																	<div class="row">
																		<div class="col">
																			<label for="">sdgAmount</label>
																			<input type="text" name="sdgAmount" class="form-control" value="{{ $feed->sdgAmount }}">
																		</div>
																		<div class="col">
																			<label for="">point_amount</label>
																			<input type="text" name="point_amount" class="form-control" value="{{ $feed->point_amount }}">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col">
																			<label for="">المحفظة</label>
																			<select name="wallet_id" class="form-control" id="">
																				@foreach ($wallets as $wallet)
																					<option value="{{ $wallet->id }}" {{ $feed->wallet_id == $wallet->id ? 'selected' : '' }}>{{ $wallet->user->name }}</option>
																				@endforeach
																			</select>
																		</div>
																		<div class="col">
																			<label for="">النوع</label>
																			<select name="type" class="form-control" id="">
																				<option value="" selected disabled>--حدد النوع--</option>
																				<option value="1">dasd</option>
																				<option value="2">asds</option>
																			</select>
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<button class="btn ripple btn-success" type="submit">تعديل</button>
																	<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- End Modal effects-->

												<!-- delete modal -->
												<div class="modal" id="delete{{ $feed->id }}">
													<div class="modal-dialog modal-dialog-centered" role="document">
														<div class="modal-content modal-content-demo">
															<div class="modal-header">
																<h6 class="modal-title">حذف التغزية</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
															</div>
															<form action="{{ route('delete_wallet', $feed->id) }}" method="POST">
																@csrf
																<div class="modal-body">
																	<h5>هل أنت متأكد من عملية الحذف ؟</h5>
																</div>
																<div class="modal-footer">
																	<button class="btn ripple btn-danger" type="submit">حذف</button>
																	<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- End Modal effects-->
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- Add modal -->
					<div class="modal" id="modaldemo8">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">إضافة تغزية جديدة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<form action="{{ route('store_wallet') }}" method="POST">
									@csrf
									<div class="modal-body">
										<div class="row">
											<div class="col">
												<label for="">sdgAmount</label>
												<input type="text" name="sdgAmount" class="form-control" id="">
											</div>
											<div class="col">
												<label for="">point_amount</label>
												<input type="text" name="point_amount" class="form-control" id="">
											</div>
										</div>
										<div class="row">
											<div class="col">
												<label for="">المحفظة</label>
												<select name="wallet_id" class="form-control" id="">
													<option value="" selected disabled>--حدد المحفظة--</option>
													@foreach ($wallets as $wallet)
														<option value="{{ $wallet->id }}">{{ $wallet->user->name }}</option>
													@endforeach
												</select>
											</div>
											<div class="col">
												<label for="">النوع</label>
												<select name="type" class="form-control" id="">
													<option value="" selected disabled>--حدد النوع--</option>
													<option value="1">dasd</option>
													<option value="2">asds</option>
												</select>
											</div>
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
					<!-- End Modal effects-->
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