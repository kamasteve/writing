isValidUsername =(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");
    $("#placeOrderForm").validate();
	$("#RegistrationForm_articles").validate();
  });
  
initWritersRegistration = function() {
		
	// form validator load *.js
	jQuery.getScript("../j_s/jquery.validate.js", function() {
		jQuery.getScript("../j_s/additional-methods.js", function() {
			jQuery.getScript("../j_s/jquery.blockUI.js", function() { /* alert('Form validator: blockUI loaded.'); */ });
			jQuery('#placeOrderForm').validate({
			//jQuery('#RegistrationForm_articles').validate({
				submitHandler: function(frm) {
					// alert('OK');
					frm.submit();
				},
				invalidHandler: function(frm, validator) {
					// alert(validator.invalidElements().toSource());
				},
				errorPlacement: function(error, element) {
					var element_name = element.attr("name");
					element_name = element_name.replace(/\[\]/i, "");
					if (jQuery("#error_container_"+element_name).length)
					{
						error.appendTo("#error_container_"+element_name);
					}
					else
					{
						error.insertAfter(element);
					}
				},
				rules: {
					'email': {
						required: true,
						email: true
					},
					'password': {
						required: true,
						minlength: 6
					},
					'password_re': {
						required: true,
						equalTo:  "#password"
					},
					
					'firstname': {
						required: true,
						alphaPlusNumeric: true
					},
					'lastname': {
						required: true,
						alphaPlusNumeric: true
					},
					'state': {
						required: function(element) { return ($("#id_country option:selected").val() == "us"); },
						alphaPlusNumeric: true
					},
					'city': {
						required: true,
						required: true
						//alphaPlusNumeric: true
					},
					'phone_cell_ac': {
						//required: true,
						//digits: true
					},
					'phone_cell_num': {
						required: true,
						//numericPlusAlpha: true
						digits: true,
						minlength: 10
					},
					'employed': {
						required: true
					},
					'employed_txt': {
						required: '#id_employed_txt:visible'
					},
					'citation[]': {
						required: true,
						minlength: 1
					},
					'citation_txt': {
						required: '#id_citation_txt:visible'
					},
					'academic_discipline[]': {
						required: true,
						rangelength: [1,5]
					},
					'discipline_txt': {
						required: '#id_discipline_txt:visible'
					},
					'language': {
						required: true
					},
					'degree': {
						required: true
					},
					
					'brief_cv': {
						required: true
					},
					'detailed_cv': {
						required: true,
						accept: "doc|docx|pdf"
					},
					'sample_title_one': {
						required: true
					},
					'sample_file_one': {
						required: true,
						accept: "jpg|jpeg|png|gif"
					},
					'sample_title_two': {
						required: true
					},
					'sample_file_two': {
						required: true,
						accept: "doc|docx|pdf"
					},
					'sample_title_three': {
						required: true
					},
					'sample_file_three': {
						required: true,
						accept: "doc|docx|pdf"
					},
					
					//Rtf|.xls|xlsx|txt|csv|ppt|pptx|xml|html|mp3, .accdb, .db, .dbf, .mdb, .sql, .aspx, .htm, .asp, .xhtml, .7z, .zip, .zipx
					'payment_method': {
						required: true
					},
					'terms': {
						required: true
					}
				},
				messages: {
					'email': {
						required: 'The E-mail field is required',
						email: 'Please enter a valid email address'
					},
					'password': {
						required: 'The Password field is required.',
						minlength: 'The Password field must contain at least 6 chatacters'
					},
					'password_re': {
						required: 'The "Re-enter password" field is required',
						equalTo: 'The passwords do not match. Please re-enter.'
					},
										
					'username': {
						required: 'The "Username" field is required',
						minlength: 'The "Username" field must contain at least 6 chatacters',
						login: 'Username must contain only letters, numbers, or underscore'
					},
					
					'firstname': {
						required: 'The First name field is required',
						alphaPlusNumeric: 'Only Letters and Digits are allowed.'
					},
					'lastname': {
						required: 'The Last name field is required',
						alphaPlusNumeric: 'Only Letters and Digits are allowed.'
					},
					'state': {
						required: 'State field is required',
						alphaPlusNumeric: 'Only Letters and Digits are allowed.'
					},
					'city': {
						required: 'The City field is required',
						alphaPlusNumeric: 'Only Letters and Digits are allowed.'
					},
					'phone_cell_ac': {
						required: 'The Area code field is required',
						digits: 'The Area code field require digits only'
					},
					'phone_cell_num': {
						required: 'The Cell phone field is required',
						numericPlusAlpha: 'Only Letters and Digits are allowed.'
					},
					'employed': {
						required: 'The Employment field must have a value'
					},
					'employed_txt': {
						required: 'This field is required.'
					},
					'citation[]': {
						required: 'Citation styles are required',
						//minlength: 'Select Citation styles field must have a value'
					},
					'citation_txt': {
						required: 'This field is required.'
					},
					'academic_discipline[]': {
						required: 'The Academic Disciplines are required',
						rangelength: 'You can select no more than 5 academic disciplines'
					},
					'discipline_txt': {
						required: 'Fill other academic disciplines.'
					},
					'language': {
						required: 'The Native language field is required (e.g. English)'
					},
					'degree': {
						required: 'The "Academic Degree" is required'
					},
					
					'brief_cv': {
						required: 'Your Bio is required. You can paste it here'
					},
					'detailed_cv': {
						required: 'The file Your Detailed CV is required',
						accept: 'Only .doc, .docx, .rtf, .pdf or .txt file types allowed for CV'
					},
					'sample_title_ONE': {
						required: 'Kindly, Give your Certificate a title'
					},
					'sample_file_ONE': {
						required: 'University Degree Certificate is required',
						accept: 'Only .jpg, .png or .gif file types allowed'
					},
					'sample_title_TWO': {
						required: 'Sample Essay Title One is required'
					},
					'sample_file_TWO': {
						required: 'The file Sample Essay One is required',
						accept: 'Only .doc, .docx, .rtf, .pdf or .txt file types allowed sample essay'
					},
					'sample_title_THREE': {
						required: 'Sample Essay Title Two is required'
					},
					'sample_file_THREE': {
						required: 'The file Sample Esssay Two is required',
						accept: 'Only .doc, .docx, .rtf, .pdf or .txt file types allowed sample essay'
					},
					'payment_method': {
						required: 'The field Payment method is required'
					},
					'terms': {
						required: 'You must agree to terms & conditions'
					}
				}
			});
			// /form validator config ####RegistrationForm_articles
			
			jQuery('#RegistrationForm_articles').validate({ // #RegistrationForm_articles
				submitHandler: function(frm) {
					// alert('OK');
					frm.submit();
				},
				invalidHandler: function(frm, validator) {
					// alert(validator.invalidElements().toSource());
				},
				errorPlacement: function(error, element) {
					var element_name = element.attr("name");
					element_name = element_name.replace(/\[\]/i, "");
					if (jQuery("#error_container_"+element_name).length)
					{
						error.appendTo("#error_container_"+element_name);
					}
					else
					{
						error.insertAfter(element);
					}
				},
				rules: {
					'email_a': {
						required: true,
						email: true
					},
					'password_a': {
						required: true,
						minlength: 6
					},
					'password_re_a': {
						required: true,
						equalTo:  "#password_a"
					},
					
					'firstname_a': {
						required: true,
						alphaPlusNumeric: true
					},
					'lastname_a': {
						required: true,
						alphaPlusNumeric: true
					},
					'state_a': {
						required: function(element) { return ($("#id_country_a option:selected").val() == "ke"); },
						alphaPlusNumeric: true
					},
					'id_country_label_a':{
					required: true	
					},
					'city_a': {
						required: true,
						alphaPlusNumeric: true
					},
					'phone_cell_ac_a': {
						//required: true,
						//digits: true
					},
					'phone_cell_num_a': {
						required: true,
						//numericPlusAlpha: true
						digits: true,
						minlength: 10
					},
					'employed_a': {
						required: true
					},
					'employed_txt_a': {
						required: '#id_employed_txt_a:visible'
					},
					'citation_a[]': {
						required: true,
						minlength: 1
					},
					'citation_txt_a': {
						required: '#id_citation_txt_a:visible'
					},
					'specializations_a[]': {
						required: true,
						rangelength: [1,5]
					},
					'specializations_txt_a': {
						required: '#id_specializations_txt_a:visible'
					},
					'language_a': {
						required: true
					},
					'degree_a': {
						required: true
					},
					
					'brief_cv_a': {
						required: true
					},
					'detailed_cv_a': {
						required: true,
						accept: "doc|docx|pdf"
					},
					'sample_title_one_a': {
						required: true
					},
					'sample_file_onea': {
						required: true,
						accept: "jpg|jpeg|png|gif"
					},
					'sample_title_two_a': {
						required: true
					},
					'sample_file_two_a': {
						required: true,
						accept: "doc|docx|pdf"
					},
					'sample_title_three_a': {
						required: true
					},
					'sample_file_three_a': {
						required: true,
						accept: "doc|docx|pdf"
					},
					
					'payment_method_a': {
						required: true
					},
					'terms_a': {
						required: true
					}
				},
				messages: {
					'email_a': {
						required: 'The E-mail field is required',
						email: 'Please enter a valid email address'
					},
					'password_a': {
						required: 'The Password field is required.',
						minlength: 'The Password field must contain at least 6 chatacters'
					},
					'password_re_a': {
						required: 'The "Re-enter password" field is required',
						equalTo: 'The passwords do not match. Please re-enter.'
					},
										
					'username_a': {
						required: 'The "Username" field is required',
						minlength: 'The "Username" field must contain at least 6 chatacters',
						login: 'Username must contain only letters, numbers, or underscore'
					},
					
					'first_name_a': {
						required: 'The First name field is required',
						alphaPlusNumeric: 'Only Letters and Digits are allowed.'
					},
					'last_name_a': {
						required: 'The Last name field is required',
						alphaPlusNumeric: 'Only Letters and Digits are allowed.'
					},
					'state_a': {
						required: 'State field is required',
						alphaPlusNumeric: 'Only Letters and Digits are allowed.'
					},
					'city_a': {
						required: 'The City field is required',
						alphaPlusNumeric: 'Only Letters and Digits are allowed.'
					},
					'id_country_label_a': {
						required: 'Please select Country',
						alphaPlusNumeric: 'Only Letters and Digits are allowed.'
					},
					'phone_cell_ac_a': {
						required: 'The Area code field is required',
						digits: 'The Area code field require digits only'
					},
					'phone_cell_num_a': {
						required: 'The Cell phone field is required',
						numericPlusAlpha: 'Only Letters and Digits are allowed.'
					},
					'employed_a': {
						required: 'The Employment field must have a value'
					},
					'employed_txt_a': {
						required: 'This field is required.'
					},
					'citation_a[]': {
						required: 'Citation styles are required',
						//minlength: 'Select Citation styles field must have a value'
					},
					'citation_txt_a': {
						required: 'This field is required.'
					},
					'specializations_a[]': {
						required: 'The Article Specialties are required',
						rangelength: 'You can select no more than 5 academic specialties'
					},
					'specializations_txt_a': {
						required: 'Fill other article specialties.'
					},
					'language_a': {
						required: 'The Native language field is required (e.g. English)'
					},
					'degree_a': {
						required: 'The "Academic Degree" is required'
					},
					
					'brief_cv_a': {
						required: 'Your brief CV is required- You can paste it here'
					},
					'detailed_cv_a': {
						required: 'The file Your Detailed CV is required',
						accept: 'Only .doc, .docx, .rtf, .pdf or .txt file types allowed for CV'
					},
					'sample_title_ONE_a': {
						required: 'Kindly, Give your Certificate a title'
					},
					'sample_file_ONE_a': {
						required: 'University Degree Certificate is required',
						accept: 'Only .jpg, .png or .gif file types allowed'
					},
					'sample_title_TWO_a': {
						required: 'Sample Article Title One is required'
					},
					'sample_file_TWO_a': {
						required: 'The file Sample Article One is required',
						accept: 'Only .doc, .docx, .rtf, .pdf or .txt file types allowed sample essay'
					},
					'sample_title_THREE_a': {
						required: 'Sample Article Title Two is required'
					},
					'sample_file_THREE_a': {
						required: 'The file Sample Article Two is required',
						accept: 'Only .doc, .docx, .rtf, .pdf or .txt file types allowed sample essay'
					},
					'payment_method_a': {
						required: 'The field Payment method is required'
					},
					'terms_a': {
						required: 'You must agree to terms & conditions'
					}
				}
			});
			// /form validator config
		});
	});
	// /form validator load *.js
};

jQuery(document).ready( function() {
	initWritersRegistration();
});
