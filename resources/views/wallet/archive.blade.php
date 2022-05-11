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
							<h4 class="content-title mb-0 my-auto">المحفظات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أرشيف المحفظات</span>
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
								<div class="card-header pb-0">
									<div class="d-flex justify-content-between">
										<h4 class="card-title mg-b-0">المحفظة الإلكترونية</h4>
									
									</div>
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-md-nowrap" id="example1">
											<thead>
												<tr>
													<th class="wd-5p border-bottom-0">#</th>
													<th class="wd-20p border-bottom-0">إسم المستخدم</th>
													<th class="wd-10p border-bottom-0">النوع</th>
													<th class="wd-10p border-bottom-0">الرصيد</th>
													<th class="wd-20p border-bottom-0">البنك</th>
													<th class="wd-25p border-bottom-0">رقم حساب البنك</th>
													<th class="wd-15p border-bottom-0">العمليات</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($wallets as $wallet)
													<tr>
														<td>{{++$i}}</td>
														<td>{{$wallet->user->name}}</td>
														@if ($wallet->user->type == 1)
															<td>مستشار</td>
														@else
															<td>عميل</td>
														@endif
														<td>{{$wallet->amount}}</td>
														<td>{{$wallet->bank_account}}</td>
														<td>{{$wallet->bank_account_no}}</td>
														<td>
													
															<a href="#modaldemo8" data-wallet_id="{{ $wallet->id }}" class="modal-effect btn btn-primary btn-sm" data-effect="effect-scale" data-toggle="modal">
																إستعادة
															</a>
														</td>
													</tr>
														<!-- restore wallet -->
														<div class="modal" id="modaldemo8">
															<div class="modal-dialog modal-dialog-centered" role="document">
																<div class="modal-content modal-content-demo">
																	<div class="modal-header">
																		<h6 class="modal-title">إستعادة المحفظة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
																	</div>
																	<form action="{{ route('wallet.restore') }}" method="POST">
																		{{ csrf_field() }}
																		<div class="modal-body">
																			<h6 class="text-primary">هل أنت متأكد من عملية الإستعادة ؟</h6>
																			<input type="hidden" name="id" value="" id="wallet_id">
																		</div>
																		<div class="modal-footer">
																			<button class="btn ripple btn-primary" type="submit">إستعادة</button>
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
	$('#modaldemo8').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var wallet_id = button.data('wallet_id')
		var modal = $(this)
		modal.find('.modal-body #wallet_id').val(wallet_id);
	})

</script>
@endsection