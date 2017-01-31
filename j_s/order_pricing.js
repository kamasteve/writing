function doOrderFormCalculation() {
    var orderForm = document.placeOrderForm;
    var orderCostPerPage = 0;
    var orderTotalCost = 0;
	var discount = 0;
	var doc_type_cost =0;
	var doc_type_pricing =0;
    var single = orderForm.o_interval.checked;
    var number = orderForm.numpages;
    var discount = orderForm.discount_percent_h.value;
    var wthdy = '';
    var wthdyx = '';
    var oc = doNewCalculation(orderForm.urgency.value,orderForm.academic_level.value,orderForm.doctype_x.value,orderForm.order_category.value);
    //orderCostPerPage = (oc - (oc) * discount / 100) + doVasPP(document.getElementsByName('vas_id[]'));
    orderCostPerPage=doNewCalculation(orderForm.urgency.value,orderForm.academic_level.value,orderForm.doctype_x.value,orderForm.order_category.value)*(1-(discount/100))+ doVasPP(document.getElementsByName('vas_id[]'));
    if (single == true) {
        orderCostPerPage = orderCostPerPage * 2;
        oc = oc * 2;
        number.options[0].value = '1';
        number.options[0].text = '1 page/approx 550 words';
	    document.getElementById("num_pg_ord").innerHTML = 'approx 550 words per page';
        for (i = 1; i < number.length; i++) {
			
        number.options[i].text = (i + 1) + ' pages/approx ' + (2 * (i + 1) * 275) + ' words';
		
        }
    } else {
        number.options[0].value = '1';
        number.options[0].text = '1 page/approx 275 words';
	    document.getElementById("num_pg_ord").innerHTML = 'approx 275 words per page';
        for (i = 1; i < number.length; i++) {

            number.options[i].text = (i + 1) + ' pages/approx ' + ((i + 1) * 275) + ' words';

        }
    }
    number.options[number.selectedIndex].selected = true;
    wthdy = Math.round(orderCostPerPage * doCurrencyRate(orderForm.curr) * Math.pow(10, 2)) / Math.pow(10, 2);
    document.getElementById("cost_per_page").innerHTML = wthdy;
    orderForm.MTIuOTUYGREXGHNMKJGT23467GGFDSSSbbbbbIOK.value = encode64(wthdy);
    wthdyx = Math.round((orderCostPerPage * doCurrencyRate(orderForm.curr) * number.options[number.selectedIndex].value + doVasPO(document.getElementsByName('vas_id[]'))) * Math.pow(10, 2)) / Math.pow(10, 2);
    document.getElementById("total").innerHTML = wthdyx;

	$("#totals").val(wthdyx);
    orderForm.MMNBGFREWQASCXZSOPJHGVNMTIuOTU.value = encode64(wthdyx);

    if (discount > 0) {
	orderForm.discount_h.value = discount;
	document.getElementById('lblCustomerSavings').style.display = 'block';
	document.getElementById('lblCustomerSavingstext').style.display = 'none';
	orderForm.lblCustomerSavings.value = 'Your savings are - ' + discount + '% (' + Math.round(((oc - orderCostPerPage + doVasPP(document.getElementsByName('vas_id[]'))) * number.options[number.selectedIndex].value) * Math.pow(10, 2)) / Math.pow(10, 2) + ' ' + orderForm.curr.options[orderForm.curr.selectedIndex].text+ ')';
	
	orderForm.discount_h.value = Math.round(((oc - orderCostPerPage + doVasPP(document.getElementsByName('vas_id[]'))) * number.options[number.selectedIndex].value) * Math.pow(10, 2)) / Math.pow(10, 2);
	
	var the_discount_amnt =Math.round(((oc - orderCostPerPage + doVasPP(document.getElementsByName('vas_id[]'))) * number.options[number.selectedIndex].value) * Math.pow(10, 2)) / Math.pow(10, 2);
	
document.getElementById('lblCustomerSavings').innerHTML = 'Save - ' + discount + '% ( or ' + Math.round(((oc - orderCostPerPage + doVasPP(document.getElementsByName('vas_id[]'))) * number.options[number.selectedIndex].value) * Math.pow(10, 2)) / Math.pow(10, 2) + ' ' + orderForm.curr.options[orderForm.curr.selectedIndex].text+ ') <br> Total to pay is $ ' + wthdyx + ' from $ ' + Math.round((wthdyx + the_discount_amnt)* Math.pow(10, 2))/ Math.pow(10, 2);
	
    } else {
        document.getElementById('lblCustomerSavings').innerHTML = '';
        document.getElementById('lblCustomerSavingstext').style.display = 'block';
        document.getElementById('lblCustomerSavings').style.display = 'none';
    }
}
function doNewCalculation(urgency,level,docType,orderCat){
//	if(docType == 1 || docType == 2 || docType == 3 || docType == 4 || docType == 5 || docType == 6 || docType == 7 || docType == 21 || docType == 22 || docType == 23 || docType == 24 || docType == 27 || docType == 29 || docType == 31 || docType == 32 || docType == 33 || docType == 34 || docType == 35 )
	if(docType==8 || docType==12 || docType==13 || docType==14 || docType==15 || docType==16 || docType==17 || docType==18 || docType==19 || docType==36 || docType==30 || docType==28 || docType==9 || docType==10){
		if(orderCat==60 || orderCat==59 || orderCat==53 || orderCat==51 || orderCat==111 || orderCat==112 || orderCat==110 || orderCat==80 || orderCat==72 || orderCat==12 || orderCat==75 || orderCat==77 || orderCat==17 || orderCat==67){ // Technical
			if(level==1){								// High School
				if(urgency==6)			// 6 hours
					return 40.6;
				else if(urgency==12)	// 12 hours
					return 36.24;
				else if(urgency==24)	// 24 hours
					return 34.88;
				else if(urgency==36)	// 36 hours
					return 32.52;
				else if(urgency==48)	// 48 hours
					return 30.16;
				else if(urgency==3)		// 3 days
					return 29.8;
				else if(urgency==5)		// 5 days
					return 28.52;
				else if(urgency==7)		// 7 days
					return 25.16;
				else if(urgency==9)		// 9 days
					return 21.8;
				else if(urgency==10)	// 10 days
					return 19.44;
				else if(urgency==14)	// 14 days
					return 18.44;
				else if(urgency==21)	// 21 days
					return 17.26;
				else if(urgency==30)	// 30 days
					return 15.08;
				else if(urgency==60)	// 2 months
					return 13.12;			
			}else if(level==2){							// College
				if(urgency==6)			// 6 hours
					return 42.88;
				else if(urgency==12)	// 12 hours
					return 38.44;
				else if(urgency==24)	// 24 hours
					return 36.22;
				else if(urgency==36)	// 36 hours
					return 34.12;
				else if(urgency==48)	// 48 hours
					return 33.54;
				else if(urgency==3)		// 3 days
					return 32.11;
				else if(urgency==5)		// 5 days
					return 31;
				else if(urgency==7)		// 7 days
					return 27.64;
				else if(urgency==9)		// 9 days
					return 24.28;
				else if(urgency==10)	// 10 days
					return 22.92;
				else if(urgency==14)	// 14 days
					return 20.92;
				else if(urgency==21)	// 21 days
					return 18.22;
				else if(urgency==30)	// 30 days
					return 17.56;
				else if(urgency==60)	// 2 months
					return 15.64;		
			}
			else if(level==3){							// Undergraduate
				if(urgency==6)			// 6 hours
					return 44.32;
				else if(urgency==12)	// 12 hours
					return 40.96;
				else if(urgency==24)	// 24 hours
					return 38.6;
				else if(urgency==36)	// 36 hours
					return 36.24;
				else if(urgency==48)	// 48 hours
					return 35.88;
				else if(urgency==3)		// 3 days
					return 34.52;
				else if(urgency==5)		// 5 days
					return 33.24;
				else if(urgency==7)		// 7 days
					return 29.88;
				else if(urgency==9)		// 9 days
					return 26.52;
				else if(urgency==10)	// 10 days
					return 24.16;
				else if(urgency==14)	// 14 days
					return 23.16;
				else if(urgency==21)	// 21 days
					return 21.98;
				else if(urgency==30)	// 30 days
					return 19.8;
				else if(urgency==60)	// 2 months
					return 17.34;	
			}
			else if(level==4){								// Master
				if(urgency==6)			// 6 hours
					return 46.56;
				else if(urgency==12)	// 12 hours
					return 43.2;
				else if(urgency==24)	// 24 hours
					return 39.84;
				else if(urgency==36)	// 36 hours
					return 38.48;
				else if(urgency==48)	// 48 hours
					return 37.12;
				else if(urgency==3)		// 3 days
					return 36.76;
				else if(urgency==5)		// 5 days
					return 35.48;
				else if(urgency==7)		// 7 days
					return 32.12;
				else if(urgency==9)		// 9 days
					return 28.76;
				else if(urgency==10)	// 10 days
					return 27.4;
				else if(urgency==14)	// 14 days
					return 25.4;
				else if(urgency==21)	// 21 days
					return 23.84;
				else if(urgency==30)	// 30 days
					return 22.04;
				else if(urgency==60)	// 2 months
					return 20.82;	
			} else if(level==5){							// PhD
				if(urgency==6)			// 6 hours
					return 48.32;
				else if(urgency==12)	// 12 hours
					return 46.56;
				else if(urgency==24)	// 24 hours
					return 43.2;
				else if(urgency==36)	// 36 hours
					return 41.84;
				else if(urgency==48)	// 48 hours
					return 40.48;
				else if(urgency==3)		// 3 days
					return 39.12;
				else if(urgency==5)		// 5 days
					return 38.84;
				else if(urgency==7)		// 7 days
					return 35.48;
				else if(urgency==9)		// 9 days
					return 32.12;
				else if(urgency==10)	// 10 days
					return 30.76;
				else if(urgency==14)	// 14 days
					return 28.76;
				else if(urgency==21)	// 21 days
					return 27.11;
				else if(urgency==30)	// 30 days
					return 25.42;
				else if(urgency==60)	// 2 months
					return 22.04;	
			}					
		}
		else{	// Non Technical
			if(level==1){								// High School
				if(urgency==6)			// 6 hours
					return 37.6;
				else if(urgency==12)	// 12 hours
					return 35.6;
				else if(urgency==24)	// 24 hours
					return 32.24;
				else if(urgency==36)	// 36 hours
					return 31.88;
				else if(urgency==48)	// 48 hours
					return 28.52;
				else if(urgency==3)		// 3 days
					return 25.16;
				else if(urgency==5)		// 5 days
					return 21.8;
				else if(urgency==7)		// 7 days
					return 19.44;
				else if(urgency==9)		// 9 days
					return 18.44;
				else if(urgency==10)	// 10 days
					return 17.26;
				else if(urgency==14)	// 14 days
					return 15.08;
				else if(urgency==21)	// 21 days
					return 13.12;
				else if(urgency==30)	// 30 days
					return 12.72;
				else if(urgency==60)	// 2 months
					return 11.72;			
			}else if(level==2){							// College
				if(urgency==6)			// 6 hours
					return 40.08;
				else if(urgency==12)	// 12 hours
					return 37.08;
				else if(urgency==24)	// 24 hours
					return 35.72;
				else if(urgency==36)	// 36 hours
					return 34.36;
				else if(urgency==48)	// 48 hours
					return 31;
				else if(urgency==3)		// 3 days
					return 27.64;
				else if(urgency==5)		// 5 days
					return 24.28;
				else if(urgency==7)		// 7 days
					return 22.92;
				else if(urgency==9)		// 9 days
					return 20.92;
				else if(urgency==10)	// 10 days
					return 18.22;
				else if(urgency==14)	// 14 days
					return 17.56;
				else if(urgency==21)	// 21 days
					return 15.64;
				else if(urgency==30)	// 30 days
					return 14.88;
				else if(urgency==60)	// 2 months
					return 14.2;		
			}
			else if(level==3){							// Undergraduate
				if(urgency==6)			// 6 hours
					return 42.32;
				else if(urgency==12)	// 12 hours
					return 39.32;
				else if(urgency==24)	// 24 hours
					return 37.96;
				else if(urgency==36)	// 36 hours
					return 36.6;
				else if(urgency==48)	// 48 hours
					return 33.24;
				else if(urgency==3)		// 3 days
					return 29.88;
				else if(urgency==5)		// 5 days
					return 26.52;
				else if(urgency==7)		// 7 days
					return 24.16;
				else if(urgency==9)		// 9 days
					return 23.16;
				else if(urgency==10)	// 10 days
					return 21.98;
				else if(urgency==14)	// 14 days
					return 19.8;
				else if(urgency==21)	// 21 days
					return 17.34;
				else if(urgency==30)	// 30 days
					return 16.99;
				else if(urgency==60)	// 2 months
					return 16.44;	
			}
			else if(level==4){								// Master
				if(urgency==6)			// 6 hours
					return 44.56;
				else if(urgency==12)	// 12 hours
					return 42.56;
				else if(urgency==24)	// 24 hours
					return 40.2;
				else if(urgency==36)	// 36 hours
					return 38.84;
				else if(urgency==48)	// 48 hours
					return 35.48;
				else if(urgency==3)		// 3 days
					return 32.12;
				else if(urgency==5)		// 5 days
					return 28.76;
				else if(urgency==7)		// 7 days
					return 27.4;
				else if(urgency==9)		// 9 days
					return 25.4;
				else if(urgency==10)	// 10 days
					return 23.84;
				else if(urgency==14)	// 14 days
					return 22.04;
				else if(urgency==21)	// 21 days
					return 20.82;
				else if(urgency==30)	// 30 days
					return 19.68;
				else if(urgency==60)	// 2 months
					return 18.68;	
			} else if(level==5){							// PhD
				if(urgency==6)			// 6 hours
					return 46.32;
				else if(urgency==12)	// 12 hours
					return 45.32;
				else if(urgency==24)	// 24 hours
					return 43.56;
				else if(urgency==36)	// 36 hours
					return 42.2;
				else if(urgency==48)	// 48 hours
					return 38.84;
				else if(urgency==3)		// 3 days
					return 35.48;
				else if(urgency==5)		// 5 days
					return 32.12;
				else if(urgency==7)		// 7 days
					return 30.76;
				else if(urgency==9)		// 9 days
					return 28.76;
				else if(urgency==10)	// 10 days
					return 27.11;
				else if(urgency==14)	// 14 days
					return 25.42;
				else if(urgency==21)	// 21 days
					return 22.04;
				else if(urgency==30)	// 30 days
					return 21.33;
				else if(urgency==60)	// 2 months
					return 20.82;	
			}					
		}
	}
	else if(docType==25 || docType==26){
		if(level==1){								// High School
			if(urgency==6)			// 6 hours
				return 12.22;
			else if(urgency==12)	// 12 hours
				return 11.6;
			else if(urgency==24)	// 24 hours
				return 10.24;
			else if(urgency==36)	// 36 hours
				return 9.88;
			else if(urgency==48)	// 48 hours
				return 8.52;
			else if(urgency==3)		// 3 days
				return 7.16;
			else if(urgency==5)		// 5 days
				return 6.8;
			else if(urgency==7)		// 7 days
				return 6.8;
			else if(urgency==9)		// 9 days
				return 6.8;
			else if(urgency==10)	// 10 days
				return 6.8;
			else if(urgency==14)	// 14 days
				return 6.8;
			else if(urgency==21)	// 21 days
				return 6.8;
			else if(urgency==30)	// 30 days
				return 6.8;
			else if(urgency==60)	// 2 months
				return 6.8;			
		}else if(level==2){							// College
			if(urgency==6)			// 6 hours
				return 13.44;
			else if(urgency==12)	// 12 hours
				return 12.08;
			else if(urgency==24)	// 24 hours
				return 11.72;
			else if(urgency==36)	// 36 hours
				return 10.36;
			else if(urgency==48)	// 48 hours
				return 9.12;
			else if(urgency==3)		// 3 days
				return 8.64;
			else if(urgency==5)		// 5 days
				return 7.28;
			else if(urgency==7)		// 7 days
				return 7.28;
			else if(urgency==9)		// 9 days
				return 7.28;
			else if(urgency==10)	// 10 days
				return 7.28;
			else if(urgency==14)	// 14 days
				return 7.28;
			else if(urgency==21)	// 21 days
				return 7.28;
			else if(urgency==30)	// 30 days
				return 7.28;
			else if(urgency==60)	// 2 months
				return 7.28;		
		}
		else if(level==3){							// Undergraduate
			if(urgency==6)			// 6 hours
				return 15.58;
			else if(urgency==12)	// 12 hours
				return 14.32;
			else if(urgency==24)	// 24 hours
				return 13.96;
			else if(urgency==36)	// 36 hours
				return 11.6;
			else if(urgency==48)	// 48 hours
				return 10.24;
			else if(urgency==3)		// 3 days
				return 9.88;
			else if(urgency==5)		// 5 days
				return 8.52;
			else if(urgency==7)		// 7 days
				return 8.52;
			else if(urgency==9)		// 9 days
				return 8.52;
			else if(urgency==10)	// 10 days
				return 8.52;
			else if(urgency==14)	// 14 days
				return 8.52;
			else if(urgency==21)	// 21 days
				return 8.52;
			else if(urgency==30)	// 30 days
				return 8.52;
			else if(urgency==60)	// 2 months
				return 8.52;	
		}
		else if(level==4){								// Master
			if(urgency==6)			// 6 hours
				return 17.99;
			else if(urgency==12)	// 12 hours
				return 16.56;
			else if(urgency==24)	// 24 hours
				return 15.2;
			else if(urgency==36)	// 36 hours
				return 14.84;
			else if(urgency==48)	// 48 hours
				return 13.48;
			else if(urgency==3)		// 3 days
				return 12.12;
			else if(urgency==5)		// 5 days
				return 11.76;
			else if(urgency==7)		// 7 days
				return 11.76;
			else if(urgency==9)		// 9 days
				return 11.76;
			else if(urgency==10)	// 10 days
				return 11.76;
			else if(urgency==14)	// 14 days
				return 11.76;
			else if(urgency==21)	// 21 days
				return 11.76;
			else if(urgency==30)	// 30 days
				return 11.76;
			else if(urgency==60)	// 2 months
				return 11.76;	
		} else if(level==5){							// PhD
			if(urgency==6)			// 6 hours
				return 20.44;
			else if(urgency==12)	// 12 hours
				return 19.32;
			else if(urgency==24)	// 24 hours
				return 18.56;
			else if(urgency==36)	// 36 hours
				return 17.2;
			else if(urgency==48)	// 48 hours
				return 16.84;
			else if(urgency==3)		// 3 days
				return 15.48;
			else if(urgency==5)		// 5 days
				return 16.12;
			else if(urgency==7)		// 7 days
				return 16.12;
			else if(urgency==9)		// 9 days
				return 16.12;
			else if(urgency==10)	// 10 days
				return 16.12;
			else if(urgency==14)	// 14 days
				return 16.12;
			else if(urgency==21)	// 21 days
				return 16.12;
			else if(urgency==30)	// 30 days
				return 16.12;
			else if(urgency==60)	// 2 months
				return 16.12;	
		}		
	}
	else{
		if(orderCat==60 || orderCat==59 || orderCat==53 || orderCat==51 || orderCat==111 || orderCat==112 || orderCat==110 || orderCat==80 || orderCat==72 || orderCat==12 || orderCat==75 || orderCat==77 || orderCat==17 || orderCat==67){ // Technical
			if(level==1){								// High School
				if(urgency==6)			// 6 hours
					return 38.6;
				else if(urgency==12)	// 12 hours
					return 35.24;
				else if(urgency==24)	// 24 hours
					return 31.88;
				else if(urgency==36)	// 36 hours
					return 28.52;
				else if(urgency==48)	// 48 hours
					return 25.16;
				else if(urgency==3)		// 3 days
					return 21.8;
				else if(urgency==5)		// 5 days
					return 19.44;
				else if(urgency==7)		// 7 days
					return 18.44;
				else if(urgency==9)		// 9 days
					return 17.26;
				else if(urgency==10)	// 10 days
					return 15.08;
				else if(urgency==14)	// 14 days
					return 13.12;
				else if(urgency==21)	// 21 days
					return 11.72;
				else if(urgency==30)	// 30 days
					return 10.14;
				else if(urgency==60)	// 2 months
					return 10.14;			
			}else if(level==2){							// College
				if(urgency==6)			// 6 hours
					return 41.08;
				else if(urgency==12)	// 12 hours
					return 37.72;
				else if(urgency==24)	// 24 hours
					return 34.36;
				else if(urgency==36)	// 36 hours
					return 31;
				else if(urgency==48)	// 48 hours
					return 27.64;
				else if(urgency==3)		// 3 days
					return 24.28;
				else if(urgency==5)		// 5 days
					return 22.92;
				else if(urgency==7)		// 7 days
					return 20.92;
				else if(urgency==9)		// 9 days
					return 18.22;
				else if(urgency==10)	// 10 days
					return 17.56;
				else if(urgency==14)	// 14 days
					return 15.64;
				else if(urgency==21)	// 21 days
					return 14.2;
				else if(urgency==30)	// 30 days
					return 12.48;
				else if(urgency==60)	// 2 months
					return 12.48;		
			}
			else if(level==3){							// Undergraduate
				if(urgency==6)			// 6 hours
					return 43.32;
				else if(urgency==12)	// 12 hours
					return 39.96;
				else if(urgency==24)	// 24 hours
					return 36.6;
				else if(urgency==36)	// 36 hours
					return 33.24;
				else if(urgency==48)	// 48 hours
					return 29.88;
				else if(urgency==3)		// 3 days
					return 26.52;
				else if(urgency==5)		// 5 days
					return 24.16;
				else if(urgency==7)		// 7 days
					return 23.16;
				else if(urgency==9)		// 9 days
					return 21.98;
				else if(urgency==10)	// 10 days
					return 19.8;
				else if(urgency==14)	// 14 days
					return 17.34;
				else if(urgency==21)	// 21 days
					return 16.44;
				else if(urgency==30)	// 30 days
					return 13.82;
				else if(urgency==60)	// 2 months
					return 13.82;	
			}
			else if(level==4){								// Master
				if(urgency==6)			// 6 hours
					return 45.56;
				else if(urgency==12)	// 12 hours
					return 42.2;
				else if(urgency==24)	// 24 hours
					return 38.84;
				else if(urgency==36)	// 36 hours
					return 35.48;
				else if(urgency==48)	// 48 hours
					return 32.12;
				else if(urgency==3)		// 3 days
					return 28.76;
				else if(urgency==5)		// 5 days
					return 27.4;
				else if(urgency==7)		// 7 days
					return 25.4;
				else if(urgency==9)		// 9 days
					return 23.84;
				else if(urgency==10)	// 10 days
					return 22.04;
				else if(urgency==14)	// 14 days
					return 20.82;
				else if(urgency==21)	// 21 days
					return 18.68;
				else if(urgency==30)	// 30 days
					return 14.01;
				else if(urgency==60)	// 2 months
					return 14.01;	
			} else if(level==5){							// PhD
				if(urgency==6)			// 6 hours
					return 47.32;
				else if(urgency==12)	// 12 hours
					return 45.56;
				else if(urgency==24)	// 24 hours
					return 42.2;
				else if(urgency==36)	// 36 hours
					return 38.84;
				else if(urgency==48)	// 48 hours
					return 35.48;
				else if(urgency==3)		// 3 days
					return 32.12;
				else if(urgency==5)		// 5 days
					return 30.76;
				else if(urgency==7)		// 7 days
					return 28.76;
				else if(urgency==9)		// 9 days
					return 27.11;
				else if(urgency==10)	// 10 days
					return 25.42;
				else if(urgency==14)	// 14 days
					return 22.04;
				else if(urgency==21)	// 21 days
					return 20.82;
				else if(urgency==30)	// 30 days
					return 15.54;
				else if(urgency==60)	// 2 months
					return 15.54;	
			}		
		}
		else{	// Non Technical
			if(level==1){								// High School
				if(urgency==6)			// 6 hours
					return 31.88;
				else if(urgency==12)	// 12 hours
					return 28.52;
				else if(urgency==24)	// 24 hours
					return 25.16;
				else if(urgency==36)	// 36 hours
					return 21.8;
				else if(urgency==48)	// 48 hours
					return 19.44;
				else if(urgency==3)		// 3 days
					return 18.44;
				else if(urgency==5)		// 5 days
					return 17.26;
				else if(urgency==7)		// 7 days
					return 15.08;
				else if(urgency==9)		// 9 days
					return 13.12;
				else if(urgency==10)	// 10 days
					return 11.72;
				else if(urgency==14)	// 14 days
					return 11.01;
				else if(urgency==21)	// 21 days
					return 10.14;
				else if(urgency==30)	// 30 days
					return 10.14;
				else if(urgency==60)	// 2 months
					return 9.2;			
			}else if(level==2){							// College
				if(urgency==6)			// 6 hours
					return 34.36;
				else if(urgency==12)	// 12 hours
					return 31;
				else if(urgency==24)	// 24 hours
					return 27.64;
				else if(urgency==36)	// 36 hours
					return 24.28;
				else if(urgency==48)	// 48 hours
					return 22.92;
				else if(urgency==3)		// 3 days
					return 20.92;
				else if(urgency==5)		// 5 days
					return 18.22;
				else if(urgency==7)		// 7 days
					return 17.56;
				else if(urgency==9)		// 9 days
					return 15.64;
				else if(urgency==10)	// 10 days
					return 14.2;
				else if(urgency==14)	// 14 days
					return 13.88;
				else if(urgency==21)	// 21 days
					return 12.48;
				else if(urgency==30)	// 30 days
					return 12.48;
				else if(urgency==60)	// 2 months
					return 10.84;		
			}
			else if(level==3){							// Undergraduate
				if(urgency==6)			// 6 hours
					return 36.6;
				else if(urgency==12)	// 12 hours
					return 33.24;
				else if(urgency==24)	// 24 hours
					return 29.88;
				else if(urgency==36)	// 36 hours
					return 26.52;
				else if(urgency==48)	// 48 hours
					return 24.16;
				else if(urgency==3)		// 3 days
					return 23.16;
				else if(urgency==5)		// 5 days
					return 21.98;
				else if(urgency==7)		// 7 days
					return 19.8;
				else if(urgency==9)		// 9 days
					return 17.34;
				else if(urgency==10)	// 10 days
					return 16.44;
				else if(urgency==14)	// 14 days
					return 14.99;
				else if(urgency==21)	// 21 days
					return 13.82;
				else if(urgency==30)	// 30 days
					return 13.82;
				else if(urgency==60)	// 2 months
					return 13.08;	
			}
			else if(level==4){								// Master
				if(urgency==6)			// 6 hours
					return 38.84;
				else if(urgency==12)	// 12 hours
					return 35.48;
				else if(urgency==24)	// 24 hours
					return 32.12;
				else if(urgency==36)	// 36 hours
					return 28.76;
				else if(urgency==48)	// 48 hours
					return 27.4;
				else if(urgency==3)		// 3 days
					return 25.4;
				else if(urgency==5)		// 5 days
					return 23.84;
				else if(urgency==7)		// 7 days
					return 22.04;
				else if(urgency==9)		// 9 days
					return 20.82;
				else if(urgency==10)	// 10 days
					return 18.68;
				else if(urgency==14)	// 14 days
					return 16.12;
				else if(urgency==21)	// 21 days
					return 14.01;
				else if(urgency==30)	// 30 days
					return 14.01;
				else if(urgency==60)	// 2 months
					return 13.99;	
			} else if(level==5){							// PhD
				if(urgency==6)			// 6 hours
					return 42.2;
				else if(urgency==12)	// 12 hours
					return 38.84;
				else if(urgency==24)	// 24 hours
					return 35.48;
				else if(urgency==36)	// 36 hours
					return 32.12;
				else if(urgency==48)	// 48 hours
					return 30.76;
				else if(urgency==3)		// 3 days
					return 28.76;
				else if(urgency==5)		// 5 days
					return 27.11;
				else if(urgency==7)		// 7 days
					return 25.42;
				else if(urgency==9)		// 9 days
					return 22.04;
				else if(urgency==10)	// 10 days
					return 20.82;
				else if(urgency==14)	// 14 days
					return 18.44;
				else if(urgency==21)	// 21 days
					return 15.54;
				else if(urgency==30)	// 30 days
					return 15.54;
				else if(urgency==60)	// 2 months
					return 15.32;	
			}		
		}		
	}
	return 0;
}

//Discount
function doDiscount() {
$("#discount_check").html("Please wait...");
	$.get("../chk_discount.php",{ total: $(".MMNBGFREWQASCXZSOPJHGVNMTIuOTU").val(),  code: $(".discount_code").val()  } ,function(data){
		if (isNaN (data)) {
		$("#discount_check").html(data);
		} else {
		  	// A valid Number
		  	// do some processing with the number
			if (data > 0) { 
				$(".discount_percent_h").val(data);
				document.getElementById('lblCustomerSavingstext').style.display = 'none';
				doOrderFormCalculation();
			} else {
				alert('discount 0') ;
			}
		}
	});
}
//type of doc
function doTypeOfDocumentCost(tod) {
        return 1;  
}
function doTypeOfDocumentCost2() {
        //return 1;  
	 var theprice =0;
	 var timing = $('#urgency').val();
	 var ac_level = $('#academic_level').val();
	 var doc_typ = $('#doctype_x').val();
	 var sel2 = document.getElementById('academic_level');
	 var txty = sel2.selectedIndex; 	//academic level index
	if((doc_typ  >=8 && doc_typ <= 19) && timing ==60 && txty ==1){
		return  14;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==60 && txty ==2){
		 return 14;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==60 && txty ==3){
		 return 14;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==60 && txty ==4){
		 return 15;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==60 && txty ==5){
		 return 16;
	 }  
	 //1 month
	if((doc_typ  >=8 && doc_typ <= 19) && timing ==30 && txty ==1){
		return  6;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==30 && txty ==2){
		 return 10;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==30 && txty ==3){
		 return 11;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==30 && txty ==4){
		 return 12;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==30 && txty ==5){
		 return 14;
	 }
	 //21 days
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==21 && txty ==1){
		return  7;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==21 && txty ==2){
		 return 12;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==21 && txty ==3){
		 return 16;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==21 && txty ==4){
		 return 17;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==21 && txty ==5){
		 return 18;
	 }
	 //14 days
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==14 && txty ==1){
		return  9;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==14 && txty ==2){
		 return 14;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==14 && txty ==3){
		 return 17;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==14 && txty ==4){
		 return 17;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==14 && txty ==5){
		 return 19;
	 } 
	 //10 days
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==10 && txty ==1){
		return  11;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==10 && txty ==2){
		 return 15;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==10 && txty ==3){
		 return 17;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==10 && txty ==4){
		 return 19;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==10 && txty ==5){
		 return 20;
	 }
	 //7 days
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==7 && txty ==1){
		return  12;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==7 && txty ==2){
		 return 14;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==7 && txty ==3){
		 return 16;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==7 && txty ==4){
		 return 18;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==7 && txty ==5){
		 return 21;
	 }
	 //5 days
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==5 && txty ==1){
		return  15;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==5 && txty ==2){
		 return 15;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==5 && txty ==3){
		 return 18;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==5 && txty ==4){
		 return 18;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==5 && txty ==5){
		 return 25;
	 }
	 //3 days
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==3 && txty ==1){
		return  13;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==3 && txty ==2){
		 return 12;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==3 && txty ==3){
		 return 14;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==3 && txty ==4){
		 return 16;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==3 && txty ==5){
		 return 27;
	 }
	 //48 hrs
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==48 && txty ==1){
		return  11;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==48 && txty ==2){
		 return 9;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==48 && txty ==3){
		 return 11;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==48 && txty ==4){
		 return 13;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==48 && txty ==5){
		 return 19;
	 }
	 //36 hrs 
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==36 && txty ==1){
		return  8;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==36 && txty ==2){
		 return 6;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==36 && txty ==3){
		 return 8;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==36 && txty ==4){
		 return 10;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==36 && txty ==5){
		 return 18;
	 }
	 //24 hrs
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==24 && txty ==1){
		return  5;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==24 && txty ==2){
		 return 3;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==24 && txty ==3){
		 return 5;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==24 && txty ==4){
		 return 7;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==24 && txty ==5){
		 return 10;
	 }
	 //12 hrs
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==12 && txty ==1){
		return  2;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==12 && txty ==2){
		 return -1;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==12 && txty ==3){
		 return 0;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==12 && txty ==4){
		 return 0;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==12 && txty ==5){
		 return 7;
	 }
	 //6 hrs
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==6 && txty ==1){
		return  -1;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==6 && txty ==2){
		 return -3;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==6 && txty ==3){
		 return -3;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==6 && txty ==4){
		 return -2;
	 }
	 if((doc_typ  >=8 && doc_typ <= 19) && timing ==6 && txty ==5){
		 return 5;
	 }
	 //1 t0 7
	 if((doc_typ  >=1 && doc_typ <= 7)){
		 return 0;
	 }
	 //20 t0 28
	 if((doc_typ  >=20 && doc_typ <= 28)){
		 return 0;
	 }
	  //30 t0 34
	 if((doc_typ  >=30 && doc_typ <= 34)){
		 return 0;
	 }
	  //36 t0 38
	 if((doc_typ  >=36 && doc_typ <= 38)){
		 return 0;
	 }
	 //presentation
	  //1 month
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==30 && txty ==1){
		return  -7;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==30 && txty ==2){
		 return -7;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==30 && txty ==3){
		 return -7;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==30 && txty ==4){
		 return -7;
	  	
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==30 && txty ==5){
		 return -8;
	  	
	 }
	  //21 days
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==21 && txty ==1){
		return  -7;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==21 && txty ==2){
		 return -7;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==21 && txty ==3){
		 return -7;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==21 && txty ==4){
		 return -7;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==21 && txty ==5){
		 return -8;
	 }
	  //14 days
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==14 && txty ==1){
		return  -7;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==14 && txty ==2){
		 return -8;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==14 && txty ==3){
		 return -9;
	  	
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==14 && txty ==4){
		 return -9;
	  	
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==14 && txty ==5){
		 return -10;
	 }
	  //10 days
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==10 && txty ==1){
		return  -8;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==10 && txty ==2){
		 return -9;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==10 && txty ==3){
		 return -9;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==10 && txty ==4){
		 return -10;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==10 && txty ==5){
		 return -11;
	 }
	  //9 days
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==9 && txty ==1){
		return  -8;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==9 && txty ==2){
		 return -10;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==9 && txty ==3){
		 return -11;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==9 && txty ==4){
		 return -11;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==9 && txty ==5){
		 return -12;
	 }
	  //7 days
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==7 && txty ==1){
		return  -9;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==7 && txty ==2){
		 return -11;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==7 && txty ==3){
		 return -12;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==7 && txty ==4){
		 return -12;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==7 && txty ==5){
		 return -14;
	 }
	  //5 days
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==5 && txty ==1){
		return  -10;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==5 && txty ==2){
		 return -13;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==5 && txty ==3){
		 return -13;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==5 && txty ==4){
		 return -14;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==5 && txty ==5){
		 return -17;
	 }
	  //3 days
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==3 && txty ==1){
		return  -11;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==3 && txty ==2){
		 return -15;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==3 && txty ==3){
		 return -14;
	  	
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==3 && txty ==4){
		 return -14;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==3 && txty ==5){
		 return -16;
	 }
	  //48 hrs
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==48 && txty ==1){
		return  -12;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==48 && txty ==2){
		 return -17;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==48 && txty ==3){
		 return -16;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==48 && txty ==4){
		 return -16;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==48 && txty ==5){
		 return -18;
	 }
	  //36 hrs
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==36 && txty ==1){
		return  -14;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==36 && txty ==2){
		 return -19;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==36 && txty ==3){
		 return -18;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==36 && txty ==4){
		 return -18;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==36 && txty ==5){
		 return -19;
	 }
	  //24 hrs
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==24 && txty ==1){
		return  -16;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==24 && txty ==2){
		 return -21;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==24 && txty ==3){
		 return -20;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==24 && txty ==4){
		 return -20;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==24 && txty ==5){
		 return -23;
	 }
	  //12 hrs
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==12 && txty ==1){
		return  -18;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==12 && txty ==2){
		 return -24;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==12 && txty ==3){
		 return -24;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==12 && txty ==4){
		 return -26;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==12 && txty ==5){
		 return -24;
	 }
	  //6 hrs
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==6 && txty ==1){
		return  -20;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==6 && txty ==2){
		 return -25;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==6 && txty ==3){
		 return -26;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==6 && txty ==4){
		 return -27;
	 }
	 if((doc_typ  ==29 || doc_typ == 35) && timing ==6 && txty ==5){
		 return -25;
	 }
}
//urgency
function doUrgencyCost(urgency) {
        return 1
}
//academic level
function doAcademicLevelCost(al) {
        return al.options[al.selectedIndex].value;
}

function doSubjectAreaCost(order_category) {
        return 1
}

var pp = [];var po = [];pp[3] = 7.50;po[6] = 9.95;

function doVasPP(vas) {
    var return_sum = 0;
    for (var i = 0; i < vas.length; i++) {
        if ((vas[i].checked == true) && (vas[i].id.indexOf('page') != -1) && (!isNaN(pp[vas[i].value]))) {
            return_sum += pp[vas[i].value];
        }
    }
    return return_sum;
}

function doVasPO(vas) {
    var return_sum = 0;
    for (var i = 0; i < vas.length; i++) {
        if ((vas[i].checked == true) && (vas[i].id.indexOf('order') != -1) && (!isNaN(po[vas[i].value]))) {
            return_sum += po[vas[i].value];
        }
    }
    return return_sum;
}
  var keyStr = "ABCDEFGHIJKLMNOP" +
               "QRSTUVWXYZabcdef" +
               "ghijklmnopqrstuv" +
               "wxyz0123456789+/" +
               "=";

  function encode64(input) {
     input = escape(input);
     var output = "";
     var chr1, chr2, chr3 = "";
     var enc1, enc2, enc3, enc4 = "";
     var i = 0;

     do {
        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);

        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;

        if (isNaN(chr2)) {
           enc3 = enc4 = 64;
        } else if (isNaN(chr3)) {
           enc4 = 64;
        }

        output = output +
           keyStr.charAt(enc1) +
           keyStr.charAt(enc2) +
           keyStr.charAt(enc3) +
           keyStr.charAt(enc4);
        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";
     } while (i < input.length);

     return output;
  }

  function decode64(input) {
     var output = "";
     var chr1, chr2, chr3 = "";
     var enc1, enc2, enc3, enc4 = "";
     var i = 0;

     // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
     var base64test = /[^A-Za-z0-9\+\/\=]/g;
     if (base64test.exec(input)) {
        alert("There were invalid base64 characters in the input text.\n" +
              "Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" +
              "Expect errors in decoding.");
     }
     input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

     do {
        enc1 = keyStr.indexOf(input.charAt(i++));
        enc2 = keyStr.indexOf(input.charAt(i++));
        enc3 = keyStr.indexOf(input.charAt(i++));
        enc4 = keyStr.indexOf(input.charAt(i++));

        chr1 = (enc1 << 2) | (enc2 >> 4);
        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
        chr3 = ((enc3 & 3) << 6) | enc4;

        output = output + String.fromCharCode(chr1);

        if (enc3 != 64) {
           output = output + String.fromCharCode(chr2);
        }
        if (enc4 != 64) {
           output = output + String.fromCharCode(chr3);
        }

        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";

     } while (i < input.length);

     return unescape(output);
  }
  
  function doCurrencyRate(curr) {
  if (curr.options[curr.selectedIndex].value == 1) {
        return 1;   } 
 if (curr.options[curr.selectedIndex].value == 2) {
        return 0.69;    } 
 if (curr.options[curr.selectedIndex].value == 3) {
        return 1.26;    } 
 if (curr.options[curr.selectedIndex].value == 4) {
        return 1.32;    } 
 if (curr.options[curr.selectedIndex].value == 5) {
        return 0.94;    } 
return 0;
}