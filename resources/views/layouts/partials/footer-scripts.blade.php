<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{asset('assets/js/pages/widgets.js')}}"></script>
		<!--end::Page Scripts-->
		<script>
		$('.edit_staff').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('stafffetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#staff_name').val(obj.name);
		 // $('#image').val(obj.image);
          $('#emp_id').val(obj.employee_id);
          $('#designation').val(obj.designation_id);
          $('#dob').val(obj.dob);
          $('#blood_group').val(obj.blood_group);
          $('#phone_number').val(obj.phone);
		  $('#email').val(obj.email);
          $('#j_date').val(obj.joining_date);
          $('#mode').val(obj.salary_mode);
		  $('#p_salary').val(obj.p_salary);
          $('#a_salary').val(obj.ap_salary);
		  $('#uan').val(obj.ua_number);
          $('#staff_id').val(obj.id);
         
					},
					});	
		}
		$('#editstaff_modal').modal('show');
	});
	
		$('.edit_expense').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('expensefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          $('#name').val(obj.staff_id);
		 // $('#image').val(obj.image);
          $('#type').val(obj.type_id);
          $('#amount').val(obj.amount);
		  $('#remark').val(obj.remarks);

          $('#date').val(obj.added_date);
        
          $('#expense_id').val(obj.id);
         
					},
					});	
		}
		$('#editexpense_modal').modal('show');
	});
	$('#attendance').on('click', '.edit_attendance', function () {
		var id=$(this).data('id');
	// alert(id);

	if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('attendancefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          //$('#image').val(obj.name);
		

		  $('#attend_id').val(obj.id);
          $('#edit_status').val(obj.status);
		  $('#day_type').val(obj.day_type);
		 
         
					},
					});	
		}
		$('#editattendance_modal').modal('show');
	});

	$(document).on('click', '.edit_exptype', function () {
    var id = $(this).data('id');
   
  if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('expensetypefetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
          //$('#image').val(obj.name);
		  $('#typid').val(obj.id); 
          $('#types').val(obj.type);
		  
         
					},
					});	
		}
		$('#editexpense_modal').modal('show');
	});
	</script>
	</body>
	<!--end::Body-->

</html>