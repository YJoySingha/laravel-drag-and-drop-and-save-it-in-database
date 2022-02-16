
<!DOCTYPE html>
<html>
<head>
@include('common.head')
</head>
<body class="form-v8">
<div class="page-content">
<div class="form-v8-content">

	<div class="form-left">	
	<img src="images/form-v8.jpg" alt="form">
	</div>
	<div class="form-right">

	<div class="tab">
		<div class="tab-inner">
		<button class="tablinks" onclick="openCity(event, 'sign-up')" id="defaultOpen">Coalition Drop Down</button>
		</div>
	</div>

	<div class="form-detail">
		<div class="tabcontent" id="sign-up">
			<div class="form-row">

				<select class="form-select" id="selectMenuByCategory">
					@if(empty($taskPriorityDataByCategory))
						<option> create categories </option>
					@else
						<option> select categories </option>
						@foreach ($taskPriorityDataByCategory as $categoryList)
							<option value="{{ $categoryList->tp_category }}" >{{ $categoryList->tp_category }}</option>
						@endforeach
					@endif
				</select>
			
			</div>
			<div class="form-row" style="margin-top: 20px;">

				<select class="form-select" id="showMenuByCategory">

				</select>
			
			</div>
			<div class="row" style="margin-top: 65%;">
				<div class="col-12">
					<a class="large" href="/register" style="color:white;">Sign Up</a>
					<a class="large" href="/login" style="color:white;float: right;">Already have an account?</a>
				</div>
			</div>
			
		</div>
	</div>

</div>
</div>
</div>
@include('common.footer')
</body>
</html>

<script>

	$(document).on('click','#selectMenuByCategory',function(){

		var getCategory = $(this).val();

		//alert(getCategory);

      $.ajax({

		type:"POST",

        url :"/getCategoryByName",

        data:{'categoryName':getCategory,_token: '{{csrf_token()}}' },

		dataType: 'JSON',


        success:function(data){

			//debugger;

			//console.log(data[0].tp_name);

			var selectOption = "";

			$.each(data, function(index, value) {

			//debugger;
			//console.log(value.tp_name);

            selectOption += '<option >' + value.tp_name + '</option>';

        	});

			$("#showMenuByCategory").html(selectOption);  

        }
      });
   });


</script>


<style>
select.form-select{
	width: 100%;
    height: 50px;
    color: #3d5983;
    font-size: 18px;
}
.large{
	font-size: 18px;
}
</style>