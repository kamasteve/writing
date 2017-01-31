$(document).ready(function(){
    $('#vas_per_page_0').change(function(){
        if($(this).prop('checked') === true){
           $('#topwriter').val($(this).attr('value'));
        }else{
             $('#topwriter').val('');
        }
    });
	$('#o_interval').change(function(){
        if($(this).prop('checked') === true){
           $('#spacing').val($(this).attr('value'));
        }else{
             $('#spacing').val('');
        }
    });
	
	$('#vas_per_order_1').change(function(){
        if($(this).prop('checked') === true){
           $('#vip_support').val($(this).attr('value'));
        }else{
             $('#vip_support').val('');
        }
    });
	
});

$(window).load(function(){
var x;
//$('#urgency').on('change', function () {
 $('#urgency').change(function(){
    if (this.value != '') {
        $('#academic_level').prop('disabled', false);
        //$('#academic_level').find("option").not(":first").remove();
        /*switch (this.value) {
        	case '1':
                x = '<option value="36">High School</option><option value="42">College</option><option value="45">Undergraduate </option><option value="47">Master </option><option value="50">PhD </option>'
                break;
            case '6':
                x = '<option value="36">High School</option><option value="42">College</option><option value="45">Undergraduate </option><option value="47">Master </option><option value="50">PhD </option>'
                break;
            case '12':
                x = '<option value="33">High School</option><option value="40">College</option><option value="42">Undergraduate </option><option value="45">Master </option><option value="48">PhD </option>'
                break;
            case '24':
                x = '<option value="30">High School</option><option value="36">College</option><option value="37">Undergraduate </option><option value="38">Master </option><option value="45">PhD </option>'
                break;
			case '36':
                x = '<option value="27">High School</option><option value="33">College</option><option value="34">Undergraduate </option><option value="35">Master </option><option value="37">PhD </option>'
                break;	
			case '48':
                 x = '<option value="24">High School</option><option value="30">College</option><option value="31">Undergraduate </option><option value="32">Master </option><option value="36">PhD </option>'
                break;
            case '3':
                 x = '<option value="22">High School</option><option value="27">College</option><option value="28">Undergraduate </option><option value="29">Master </option><option value="32">PhD </option>'
                break;
            case '5':
                 x = '<option value="20">High School</option><option value="24">College</option><option value="25">Undergraduate </option><option value="27">Master </option><option value="30">PhD </option>'
                break;	
			case '7':
                 x = '<option value="18">High School</option><option value="22">College</option><option value="23">Undergraduate </option><option value="24">Master </option><option value="27">PhD </option>'
                break;
			case '9':
                 x = '<option value="17">High School</option><option value="20">College</option><option value="21">Undergraduate </option><option value="22">Master </option><option value="24">PhD </option>'
                break;	
            case '10':
                 x = '<option value="18">High School</option><option value="18">College</option><option value="19">Undergraduate </option><option value="20">Master </option><option value="22">PhD </option>'
                break;
			case '14':
                x = '<option value="15">High School</option><option value="16">College</option><option value="17">Undergraduate </option><option value="18">Master </option><option value="20">PhD </option>'
                break;
			case '21':
                 x = '<option value="15">High School</option><option value="15">College</option><option value="14">Undergraduate </option><option value="15">Master </option><option value="17">PhD </option>'
                break;
            case '30':
                 x = '<option value="14">High School</option><option value="14">College</option><option value="14">Undergraduate </option><option value="15">Master </option><option value="16">PhD </option>'
                break;
			case '60':
                 x = '<option value="14">High School</option><option value="14">College</option><option value="14">Undergraduate </option><option value="15">Master </option><option value="16">PhD </option>'
                break;					
        }*/
        //$('#academic_level').append(x)
    } else {
        $('#academic_level').prop('disabled', true);
		$('#academic_level').css("background-color","#D6D6FF");
        $('#academic_level').val("Choose");
    }
});
});//]]>  
