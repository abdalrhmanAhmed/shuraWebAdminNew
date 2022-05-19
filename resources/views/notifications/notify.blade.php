<!-- add message -->
@if(session()->has('success'))
<script>
	window.onload = function() {
		notif({
			msg: "تم الحفظ بنجاح",
			type: "success"
		})
	}

</script>
@endif
<!-- update message -->
@if(session()->has('update'))
<script>
	window.onload = function() {
		notif({
			msg: "تم التعديل بنجاح",
			type: "success"
		})
	}

</script>
@endif
<!-- delete message -->
@if(session()->has('delete'))
<script>
	window.onload = function() {
		notif({
			msg: "تم الحذف بنجاح",
			type: "success"
		})
	}

</script>
@endif