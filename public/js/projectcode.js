$(function(){
	setProjectCode();
	
	$('#project_type_id').change(function() {
		setProjectCode();
	});

	$('#customer_id').change(function() {
		setProjectCode();
	});

	$('#approval_date').change(function() {
		setProjectCode();
	});

	$('#suf-code').change(function() {
		setProjectCode();
	});

	function setProjectCode() {
		var type = getProjectTypeCode();
		var cust = getCustomerCode();
		var date = getApprovalDate();
		var code = getProjectCode();
		$('#pre-code').val(type + date + cust);
		$('#code').val(type + date + cust + code);
	}

	function getProjectTypeCode() {
		var val = $('#project_type_id :selected').val();
		var txt = $('#project_type_id').children(':selected').text().trim().substr(0,3);
		return val ? txt : '___';
	}

	function getCustomerCode() {
		var val = $('#customer_id :selected').val();
		var txt = $('#customer_id').children(':selected').text().trim().substr(0,3);
		return val ? txt : '___';
	}
	
	function getApprovalDate() {
		var val = moment($('#approval_date').val()).format('DDMMYY');
		return val ? val : '___';
	}

	function getProjectCode() {
		return $('#suf-code').val().trim()
	}
});