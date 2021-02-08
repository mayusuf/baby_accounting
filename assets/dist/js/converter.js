$(document).ready(function(){

    /**Swapper script for conversion**/
    $(".swapper").on('click', function(){
        var cid = $(this).attr("class").split(" ")[1],
            len = cid.length,
            fcc = cid.substr(0, 1),
            lcc = cid.substr(len - 1, 1),
            sf = fcc + "from" + lcc,
            st = fcc + "to" + lcc,
            cr = "converted_" + cid,
            oc = cid.substr(0, 3) + "f" + lcc,
            tc = cid.substr(0, 3) + "t" + lcc;
        var sfi = $("#"+sf).val(),
            sti = $("#"+st).val(),
            idv = $("#"+cid).val(),
            crv = $("#"+cr).val(),
            ocv = $("#"+oc).text(),
            tcv = $("#"+tc).text();
        $("#" + sf).attr(sf, st);
        $("#" + st).attr(st, sf);
        $("#" + sf).val(sti);
        $("#" + st).val(sfi);
        $("#" + cid).attr(cid, cr);
        $("#" + cr).attr(cr, cid);
        $("#" + cid).attr("disabled", false);
        $("#" + cr).attr("disabled", true);
        $("#" + cid).val(crv);
        $("#" + cr).val(idv);
        $("#" + oc).attr(oc, tc);
        $("#" + tc).attr(tc, oc);
        $("#" + oc).html(tcv);
        $("#" + tc).html(ocv);

    });

    /****Conversion scripts for big screened devices****/

	//Currency conversion
	$("#currencyn").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		currencyn_function();
    	}else{
    		$("#converted_currencyn").val("");
    	}
    });
    $("#cfromn").on('change', function(){
    	if(isNumber($("#currencyn").val()) == true){
    		currencyn_function();
    	}else{
    		$("#converted_currencyn").val("");
    	}
    });
    $("#cton").on('change', function(){
    	if(isNumber($("#currencyn").val()) == true){
    		currencyn_function();
    	}else{
    		$("#converted_currencyn").val("");
    	}
    });
    function currencyn_function(){
        var cfromn = $("#cfromn").val(),
	        cton = $("#cton").val(),
	        currencyn = parseFloat($("#currencyn").val()),
			yql_base_url = "https://query.yahooapis.com/v1/public/yql",
        	yql_query = 'select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20("' + cfromn + cton + '")',
        	yql_query_url = yql_base_url + "?q=" + yql_query + "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys",
        	op_data = 0;
        $.get(yql_query_url, function(data){
            op_data = data.query.results.rate.Rate;
	        var cresultn = op_data * currencyn;
            $('#converted_currencyn').val(cresultn);
        });
    }

    // Length conversion
    $("#lengthn").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		lengthn_function();
    	}else{
    		$("#converted_lengthn").val("");
    	}
    });
    $("#lfromn").on('change', function(){
    	if(isNumber($("#lengthn").val()) == true){
    		lengthn_function();
    	}else{
    		$("#converted_lengthn").val("");
    	}
    });
    $("#lton").on('change', function(){
    	if(isNumber($("#lengthn").val()) == true){
    		lengthn_function();
    	}else{
    		$("#converted_lengthn").val("");
    	}
    });
    function lengthn_function(){
        var lfromn = $("#lfromn").val(),
	        lton = $("#lton").val(),
	        lengthn = parseFloat($("#lengthn").val()),
        	converted_lengthn = [];
    	if(lfromn == "0"){
            converted_lengthn[0] = 1;
            converted_lengthn[1] = 0.01;
            converted_lengthn[2] = 0.00001;
            converted_lengthn[3] = 0.3280839;
            converted_lengthn[4] = 0.39370078;
            converted_lengthn[5] = 0.000006213;
            converted_lengthn[6] = 0.010936132;
        }else if(lfromn == "1"){
            converted_lengthn[0] = 100;
            converted_lengthn[1] = 1;
            converted_lengthn[2] = 0.001;
            converted_lengthn[3] = 3.280839;
            converted_lengthn[4] = 39.370078;
            converted_lengthn[5] = 0.00062137;
            converted_lengthn[6] = 1.0936132;
        }else if(lfromn == "2"){
            converted_lengthn[0] = 100000;
            converted_lengthn[1] = 1000;
            converted_lengthn[2] = 1;
            converted_lengthn[3] = 3280.839;
            converted_lengthn[4] = 39370.078;
            converted_lengthn[5] = 0.6213;
            converted_lengthn[6] = 1093.6132;
        }else if(lfromn == "3"){
            converted_lengthn[0] = 30.48;
            converted_lengthn[1] = 0.3048;
            converted_lengthn[2] = 0.0003048;
            converted_lengthn[3] = 1;
            converted_lengthn[4] = 12;
            converted_lengthn[5] = 0.00018939;
            converted_lengthn[6] = 0.33333;
        }else if(lfromn == "4"){
            converted_lengthn[0] = 2.54;
            converted_lengthn[1] = 0.0254;
            converted_lengthn[2] = 0.0000254;
            converted_lengthn[3] = 0.083333;
            converted_lengthn[4] = 1;
            converted_lengthn[5] = 0.0000157828;
            converted_lengthn[6] = 0.027778;
        }else if(lfromn == "5"){
            converted_lengthn[0] = 160934.4;
            converted_lengthn[1] = 1609.344;
            converted_lengthn[2] = 1.609344;
            converted_lengthn[3] = 5280;
            converted_lengthn[4] = 63360;
            converted_lengthn[5] = 1;
            converted_lengthn[6] = 1760;
        }else if(lfromn == "6"){
            converted_lengthn[0] = 91.44;
            converted_lengthn[1] = 0.9144;
            converted_lengthn[2] = 0.0009144;
            converted_lengthn[3] = 3;
            converted_lengthn[4] = 36;
            converted_lengthn[5] = 0.000568181;
            converted_lengthn[6] = 1;
        }
        var lresultn = converted_lengthn[lton] * lengthn;
        //lresultn = lresultn.toFixed(2);
        $("#converted_lengthn").val(lresultn);
    }

    // Temperature conversion
    $("#temperaturen").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		temperaturen_function();
    	}else{
    		$("#converted_temperaturen").val("");
    	}
    });
    $("#tfromn").on('change', function(){
    	if(isNumber($("#temperaturen").val()) == true){
    		temperaturen_function();
    	}else{
    		$("#converted_temperaturen").val("");
    	}
    });
    $("#tton").on('change', function(){
    	if(isNumber($("#temperaturen").val()) == true){
    		temperaturen_function();
    	}else{
    		$("#converted_temperaturen").val("");
    	}
    });
    function temperaturen_function(){
        var tfromn = $("#tfromn").val(),
	        tton = $("#tton").val(),
	        temperaturen = parseFloat($("#temperaturen").val()),
        	converted_temperaturen = [];
    	if(tfromn == "0"){
            converted_temperaturen[0] = temperaturen;
            converted_temperaturen[1] = (temperaturen * 9 / 5) + 32;
            converted_temperaturen[2] = temperaturen + 273;
        }else if(tfromn == "1"){
    		converted_temperaturen[0] = (temperaturen - 32) * 5 / 9;
    		converted_temperaturen[1] = temperaturen;
    		converted_temperaturen[2] = ((temperaturen - 32) * 5 / 9) + 273;
        }else if(tfromn == "2"){
    		converted_temperaturen[0] = temperaturen - 273;
    		converted_temperaturen[1] = ((temperaturen - 273) * 9 / 5) + 32;
    		converted_temperaturen[2] = temperaturen;
        }
        var tresultn = converted_temperaturen[tton];//.toFixed(2);
        $("#converted_temperaturen").val(tresultn);
    }

    // Area conversion
    $("#arean").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		arean_function();
    	}else{
    		$("#converted_arean").val("");
    	}
    });
    $("#afromn").on('change', function(){
    	if(isNumber($("#arean").val()) == true){
    		arean_function();
    	}else{
    		$("#converted_arean").val("");
    	}
    });
    $("#aton").on('change', function(){
    	if(isNumber($("#arean").val()) == true){
    		arean_function();
    	}else{
    		$("#converted_arean").val("");
    	}
    });
    function arean_function(){
        var afromn = $("#afromn").val(),
	        aton = $("#aton").val(),
	        arean = parseFloat($("#arean").val()),
        	converted_arean = [];
    	if(afromn == "0"){
            converted_arean[0] = 1;
            converted_arean[1] = 0.0001;
            converted_arean[2] = 0.000000024711;
            converted_arean[3] = 0.0010764;
            converted_arean[4] = 0.00000001;
            converted_arean[5] = 0.000000000039;
            converted_arean[6] = 0.0001196;
        }else if(afromn == "1"){
            converted_arean[0] = 10000;
            converted_arean[1] = 1;
            converted_arean[2] = 0.00024711;
            converted_arean[3] = 10.764;
            converted_arean[4] = 0.0001;
            converted_arean[5] = 0.00000039;
            converted_arean[6] = 1.196;
        }else if(afromn == "2"){
            converted_arean[0] = 40468730;
            converted_arean[1] = 4046.873;
            converted_arean[2] = 1;
            converted_arean[3] = 43560;
            converted_arean[4] = 0.4046873;
            converted_arean[5] = 0.0015625;
            converted_arean[6] = 4840;
        }else if(afromn == "3"){
            converted_arean[0] = 929.0304;
            converted_arean[1] = 0.09290304;
            converted_arean[2] = 0.000022956806;
            converted_arean[3] = 1;
            converted_arean[4] = 0.000009290304;
            converted_arean[5] = 0.00000003587;
            converted_arean[6] = 0.11111;
        }else if(afromn == "4"){
            converted_arean[0] = 100000000;
            converted_arean[1] = 10000;
            converted_arean[2] = 2.471054;
            converted_arean[3] = 107639.11;
            converted_arean[4] = 1;
            converted_arean[5] = 0.0038610217;
            converted_arean[6] = 11959.9;
        }else if(afromn == "5"){
            converted_arean[0] = 2589988000;
            converted_arean[1] = 2589988;
            converted_arean[2] = 640;
            converted_arean[3] = 27878400;
            converted_arean[4] = 258.9988;
            converted_arean[5] = 1;
            converted_arean[6] = 3097600;
        }else if(afromn == "6"){
            converted_arean[0] = 8361.2736;
            converted_arean[1] = 0.83612736;
            converted_arean[2] = 0.000206611251;
            converted_arean[3] = 9;
            converted_arean[4] = 0.000083612736;
            converted_arean[5] = 0.000000322831;
            converted_arean[6] = 1;
        }
        var aresultn = converted_arean[aton] * arean;
        // aresultn = aresultn.toFixed(12);
        $("#converted_arean").val(aresultn);
    }

    // Speed conversion
    $("#speedn").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		speedn_function();
    	}else{
    		$("#converted_speedn").val("");
    	}
    });
    $("#sfromn").on('change', function(){
    	if(isNumber($("#speedn").val()) == true){
    		speedn_function();
    	}else{
    		$("#converted_speedn").val("");
    	}
    });
    $("#ston").on('change', function(){
    	if(isNumber($("#speedn").val()) == true){
    		speedn_function();
    	}else{
    		$("#converted_speedn").val("");
    	}
    });
    function speedn_function(){
        var sfromn = $("#sfromn").val(),
	        ston = $("#ston").val(),
	        speedn = parseFloat($("#speedn").val()),
        	converted_speedn = [];
    	if(sfromn == "0"){
            converted_speedn[0] = 1;
            converted_speedn[1] = 3.6;
            converted_speedn[2] = 3.281;
            converted_speedn[3] = 2.2369;
            converted_speedn[4] = 1.9425;  
        }else if(sfromn == "1"){
            converted_speedn[0] = 0.2778;
            converted_speedn[1] = 1;
            converted_speedn[2] = 0.9114;
            converted_speedn[3] = 0.6214;
            converted_speedn[4] = 0.5396;
        }else if(sfromn == "2"){
            converted_speedn[0] = 0.3048;
            converted_speedn[1] = 1.0972;
            converted_speedn[2] = 1;
            converted_speedn[3] = 0.6818;
            converted_speedn[4] = 0.592;
        }else if(sfromn == "3"){
            converted_speedn[0] = 0.447;
            converted_speedn[1] = 1.6094;
            converted_speedn[2] = 1.4668;
            converted_speedn[3] = 1;
            converted_speedn[4] = 0.8684; 
        }else if(sfromn == "4"){
            converted_speedn[0] = 0.5148;
            converted_speedn[1] = 1.8533;
            converted_speedn[2] = 1.6891;
            converted_speedn[3] = 1.1516;
            converted_speedn[4] = 1;
        }
        var sresultn = converted_speedn[ston] * speedn;
        // sresultn = sresultn.toFixed(12);
        $("#converted_speedn").val(sresultn);
    }

    // Mass conversion
    $("#massn").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		massn_function();
    	}else{
    		$("#converted_massn").val("");
    	}
    });
    $("#mfromn").on('change', function(){
    	if(isNumber($("#massn").val()) == true){
    		massn_function();
    	}else{
    		$("#converted_massn").val("");
    	}
    });
    $("#mton").on('change', function(){
    	if(isNumber($("#massn").val()) == true){
    		massn_function();
    	}else{
    		$("#converted_massn").val("");
    	}
    });
    function massn_function(){
        var mfromn = $("#mfromn").val(),
	        mton = $("#mton").val(),
	        massn = parseFloat($("#massn").val()),
        	converted_massn = [];
    	if(mfromn == "0"){
            converted_massn[0] = 1;
            converted_massn[1] = 0.001;
            converted_massn[2] = 0.000001;
            converted_massn[3] = 0.000000001;
            converted_massn[4] = 0.015432358;
            converted_massn[5] = 0.000035273966;
            converted_massn[6] = 0.000002204623;
        }else if(mfromn == "1"){
            converted_massn[0] = 1000;
            converted_massn[1] = 1;
            converted_massn[2] = 0.001;
            converted_massn[3] = 0.000001;
            converted_massn[4] = 15.432358;
            converted_massn[5] = 0.035273966;
            converted_massn[6] = 0.002204623;
        }else if(mfromn == "2"){
            converted_massn[0] = 1000000;
            converted_massn[1] = 1000;
            converted_massn[2] = 1;
            converted_massn[3] = 0.001;
            converted_massn[4] = 15432.358;
            converted_massn[5] = 35.273966;
            converted_massn[6] = 2.204623;
        }else if(mfromn == "3"){
            converted_massn[0] = 1000000000;
            converted_massn[1] = 1000000;
            converted_massn[2] = 1000;
            converted_massn[3] = 1;
            converted_massn[4] = 15.432358;
            converted_massn[5] = 0.035273966;
            converted_massn[6] = 0.002204623;
        }else if(mfromn == "4"){
            converted_massn[0] = 64.891;
            converted_massn[1] = 0.064891;
            converted_massn[2] = 0.000064891;
            converted_massn[3] = 0.000000064891;
            converted_massn[4] = 1;
            converted_massn[5] = 0.002285714;
            converted_massn[6] = 0.000142857;
        }else if(mfromn == "5"){
            converted_massn[0] = 28349.52;
            converted_massn[1] = 28.34952;
            converted_massn[2] = 0.02834952;
            converted_massn[3] = 0.00002834952;
            converted_massn[4] = 437.5;
            converted_massn[5] = 1;
            converted_massn[6] = 0.0625;
        }else if(mfromn == "6"){
            converted_massn[0] = 453592.37;
            converted_massn[1] = 453.59237;
            converted_massn[2] = 0.45359237;
            converted_massn[3] = 0.00045359237;
            converted_massn[4] = 7000;
            converted_massn[5] = 16;
            converted_massn[6] = 1;
        }
        var mresultn = converted_massn[mton] * massn;
        // mresultn = mresultn.toFixed(12);
        $("#converted_massn").val(mresultn);
    }

    // Language conversion
    $("#bhashan").on('keyup', function(){
        if($("#bhashan").val() != ""){
            bhashan_function();
        }
        else{
            $("#converted_bhashan").val("");
        }
    });
    $("#bfromn").on('change', function(){
        if($("#bhashan").val() != ""){
            bhashan_function();
        }
        else{
            $("#converted_bhashan").val("");
        }
    });
    $("#bton").on('change', function(){
        if($("#bhashan").val() != ""){
            bhashan_function();
        }
        else{
            $("#converted_bhashan").val("");
        }
    });
    function bhashan_function(){
        var bfromn = $("#bfromn").val(),
            bton = $("#bton").val(),
            bhashan = $("#bhashan").val();

        $.getJSON("http://mymemory.translated.net/api/get?q="+bhashan+"&langpair="+bfromn+"|"+bton, function(response){
            var converted_bhashan = response.responseData['translatedText'];
            $("#converted_bhashan").val(converted_bhashan);
        });
    }

    /****Conversion scripts for mobile devices****/

	//Currency conversion
	$("#currencym").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		currencym_function();
    	}else{
    		$("#converted_currencym").val("");
    	}
    });
    $("#cfromm").on('change', function(){
    	if(isNumber($("#currencym").val()) == true){
    		currencym_function();
    	}else{
    		$("#converted_currencym").val("");
    	}
    });
    $("#ctom").on('change', function(){
    	if(isNumber($("#currencym").val()) == true){
    		currencym_function();
    	}else{
    		$("#converted_currencym").val("");
    	}
    });
    function currencym_function(){
        var cfromm = $("#cfromm").val(),
	        ctom = $("#ctom").val(),
	        currencym = parseFloat($("#currencym").val()),
			yql_base_url = "https://query.yahooapis.com/v1/public/yql",
        	yql_query = 'select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20("' + cfromm + ctom + '")',
        	yql_query_url = yql_base_url + "?q=" + yql_query + "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys",
        	op_data = 0;
        $.get(yql_query_url, function(data){
            op_data = data.query.results.rate.Rate;
	        var cresultm = op_data * currencym;
            $('#converted_currencym').val(cresultm);
        });
    }

    // Length conversion
    $("#lengthm").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		lengthm_function();
    	}else{
    		$("#converted_lengthm").val("");
    	}
    });
    $("#lfromm").on('change', function(){
    	if(isNumber($("#lengthm").val()) == true){
    		lengthm_function();
    	}else{
    		$("#converted_lengthm").val("");
    	}
    });
    $("#ltom").on('change', function(){
    	if(isNumber($("#lengthm").val()) == true){
    		lengthm_function();
    	}else{
    		$("#converted_lengthm").val("");
    	}
    });
    function lengthm_function(){
        var lfromm = $("#lfromm").val(),
	        ltom = $("#ltom").val(),
	        lengthm = parseFloat($("#lengthm").val()),
        	converted_lengthm = [];
    	if(lfromm == "0"){
            converted_lengthm[0] = 1;
            converted_lengthm[1] = 0.01;
            converted_lengthm[2] = 0.00001;
            converted_lengthm[3] = 0.3280839;
            converted_lengthm[4] = 0.39370078;
            converted_lengthm[5] = 0.000006213;
            converted_lengthm[6] = 0.010936132;
        }else if(lfromm == "1"){
            converted_lengthm[0] = 100;
            converted_lengthm[1] = 1;
            converted_lengthm[2] = 0.001;
            converted_lengthm[3] = 3.280839;
            converted_lengthm[4] = 39.370078;
            converted_lengthm[5] = 0.00062137;
            converted_lengthm[6] = 1.0936132;
        }else if(lfromm == "2"){
            converted_lengthm[0] = 100000;
            converted_lengthm[1] = 1000;
            converted_lengthm[2] = 1;
            converted_lengthm[3] = 3280.839;
            converted_lengthm[4] = 39370.078;
            converted_lengthm[5] = 0.6213;
            converted_lengthm[6] = 1093.6132;
        }else if(lfromm == "3"){
            converted_lengthm[0] = 30.48;
            converted_lengthm[1] = 0.3048;
            converted_lengthm[2] = 0.0003048;
            converted_lengthm[3] = 1;
            converted_lengthm[4] = 12;
            converted_lengthm[5] = 0.00018939;
            converted_lengthm[6] = 0.33333;
        }else if(lfromm == "4"){
            converted_lengthm[0] = 2.54;
            converted_lengthm[1] = 0.0254;
            converted_lengthm[2] = 0.0000254;
            converted_lengthm[3] = 0.083333;
            converted_lengthm[4] = 1;
            converted_lengthm[5] = 0.0000157828;
            converted_lengthm[6] = 0.027778;
        }else if(lfromm == "5"){
            converted_lengthm[0] = 160934.4;
            converted_lengthm[1] = 1609.344;
            converted_lengthm[2] = 1.609344;
            converted_lengthm[3] = 5280;
            converted_lengthm[4] = 63360;
            converted_lengthm[5] = 1;
            converted_lengthm[6] = 1760;
        }else if(lfromm == "6"){
            converted_lengthm[0] = 91.44;
            converted_lengthm[1] = 0.9144;
            converted_lengthm[2] = 0.0009144;
            converted_lengthm[3] = 3;
            converted_lengthm[4] = 36;
            converted_lengthm[5] = 0.000568181;
            converted_lengthm[6] = 1;
        }
        var lresultm = converted_lengthm[ltom] * lengthm;
        //lresultm = lresultm.toFixed(2);
        $("#converted_lengthm").val(lresultm);
    }

    // Temperature conversion
    $("#temperaturem").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		temperaturem_function();
    	}else{
    		$("#converted_temperaturem").val("");
    	}
    });
    $("#tfromm").on('change', function(){
    	if(isNumber($("#temperaturem").val()) == true){
    		temperaturem_function();
    	}else{
    		$("#converted_temperaturem").val("");
    	}
    });
    $("#ttom").on('change', function(){
    	if(isNumber($("#temperaturem").val()) == true){
    		temperaturem_function();
    	}else{
    		$("#converted_temperaturem").val("");
    	}
    });
    function temperaturem_function(){
        var tfromm = $("#tfromm").val(),
	        ttom = $("#ttom").val(),
	        temperaturem = parseFloat($("#temperaturem").val()),
        	converted_temperaturem = [];
    	if(tfromm == "0"){
            converted_temperaturem[0] = temperaturem;
            converted_temperaturem[1] = (temperaturem * 9 / 5) + 32;
            converted_temperaturem[2] = temperaturem + 273;
        }else if(tfromm == "1"){
    		converted_temperaturem[0] = (temperaturem - 32) * 5 / 9;
    		converted_temperaturem[1] = temperaturem;
    		converted_temperaturem[2] = ((temperaturem - 32) * 5 / 9) + 273;
        }else if(tfromm == "2"){
    		converted_temperaturem[0] = temperaturem - 273;
    		converted_temperaturem[1] = ((temperaturem - 273) * 9 / 5) + 32;
    		converted_temperaturem[2] = temperaturem;
        }
        var tresultm = converted_temperaturem[ttom];//.toFixed(2);
        $("#converted_temperaturem").val(tresultm);
    }

    // Area conversion
    $("#aream").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		aream_function();
    	}else{
    		$("#converted_aream").val("");
    	}
    });
    $("#afromm").on('change', function(){
    	if(isNumber($("#aream").val()) == true){
    		aream_function();
    	}else{
    		$("#converted_aream").val("");
    	}
    });
    $("#atom").on('change', function(){
    	if(isNumber($("#aream").val()) == true){
    		aream_function();
    	}else{
    		$("#converted_aream").val("");
    	}
    });
    function aream_function(){
        var afromm = $("#afromm").val(),
	        atom = $("#atom").val(),
	        aream = parseFloat($("#aream").val()),
        	converted_aream = [];
    	if(afromm == "0"){
            converted_aream[0] = 1;
            converted_aream[1] = 0.0001;
            converted_aream[2] = 0.000000024711;
            converted_aream[3] = 0.0010764;
            converted_aream[4] = 0.00000001;
            converted_aream[5] = 0.000000000039;
            converted_aream[6] = 0.0001196;
        }else if(afromm == "1"){
            converted_aream[0] = 10000;
            converted_aream[1] = 1;
            converted_aream[2] = 0.00024711;
            converted_aream[3] = 10.764;
            converted_aream[4] = 0.0001;
            converted_aream[5] = 0.00000039;
            converted_aream[6] = 1.196;
        }else if(afromm == "2"){
            converted_aream[0] = 40468730;
            converted_aream[1] = 4046.873;
            converted_aream[2] = 1;
            converted_aream[3] = 43560;
            converted_aream[4] = 0.4046873;
            converted_aream[5] = 0.0015625;
            converted_aream[6] = 4840;
        }else if(afromm == "3"){
            converted_aream[0] = 929.0304;
            converted_aream[1] = 0.09290304;
            converted_aream[2] = 0.000022956806;
            converted_aream[3] = 1;
            converted_aream[4] = 0.000009290304;
            converted_aream[5] = 0.00000003587;
            converted_aream[6] = 0.11111;
        }else if(afromm == "4"){
            converted_aream[0] = 100000000;
            converted_aream[1] = 10000;
            converted_aream[2] = 2.471054;
            converted_aream[3] = 107639.11;
            converted_aream[4] = 1;
            converted_aream[5] = 0.0038610217;
            converted_aream[6] = 11959.9;
        }else if(afromm == "5"){
            converted_aream[0] = 2589988000;
            converted_aream[1] = 2589988;
            converted_aream[2] = 640;
            converted_aream[3] = 27878400;
            converted_aream[4] = 258.9988;
            converted_aream[5] = 1;
            converted_aream[6] = 3097600;
        }else if(afromm == "6"){
            converted_aream[0] = 8361.2736;
            converted_aream[1] = 0.83612736;
            converted_aream[2] = 0.000206611251;
            converted_aream[3] = 9;
            converted_aream[4] = 0.000083612736;
            converted_aream[5] = 0.000000322831;
            converted_aream[6] = 1;
        }
        var aresultm = converted_aream[atom] * aream;
        // aresultm = aresultm.toFixed(12);
        $("#converted_aream").val(aresultm);
    }

    // Speed conversion
    $("#speedm").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		speedm_function();
    	}else{
    		$("#converted_speedm").val("");
    	}
    });
    $("#sfromm").on('change', function(){
    	if(isNumber($("#speedm").val()) == true){
    		speedm_function();
    	}else{
    		$("#converted_speedm").val("");
    	}
    });
    $("#stom").on('change', function(){
    	if(isNumber($("#speedm").val()) == true){
    		speedm_function();
    	}else{
    		$("#converted_speedm").val("");
    	}
    });
    function speedm_function(){
        var sfromm = $("#sfromm").val(),
	        stom = $("#stom").val(),
	        speedm = parseFloat($("#speedm").val()),
        	converted_speedm = [];
    	if(sfromm == "0"){
            converted_speedm[0] = 1;
            converted_speedm[1] = 3.6;
            converted_speedm[2] = 3.281;
            converted_speedm[3] = 2.2369;
            converted_speedm[4] = 1.9425;  
        }else if(sfromm == "1"){
            converted_speedm[0] = 0.2778;
            converted_speedm[1] = 1;
            converted_speedm[2] = 0.9114;
            converted_speedm[3] = 0.6214;
            converted_speedm[4] = 0.5396;
        }else if(sfromm == "2"){
            converted_speedm[0] = 0.3048;
            converted_speedm[1] = 1.0972;
            converted_speedm[2] = 1;
            converted_speedm[3] = 0.6818;
            converted_speedm[4] = 0.592;
        }else if(sfromm == "3"){
            converted_speedm[0] = 0.447;
            converted_speedm[1] = 1.6094;
            converted_speedm[2] = 1.4668;
            converted_speedm[3] = 1;
            converted_speedm[4] = 0.8684; 
        }else if(sfromm == "4"){
            converted_speedm[0] = 0.5148;
            converted_speedm[1] = 1.8533;
            converted_speedm[2] = 1.6891;
            converted_speedm[3] = 1.1516;
            converted_speedm[4] = 1;
        }
        var sresultm = converted_speedm[stom] * speedm;
        // sresultm = sresultm.toFixed(12);
        $("#converted_speedm").val(sresultm);
    }

    // Mass conversion
    $("#massm").on('keyup', function(){
    	if(isNumber($(this).val()) == true){
    		massm_function();
    	}else{
    		$("#converted_massm").val("");
    	}
    });
    $("#mfromm").on('change', function(){
    	if(isNumber($("#massm").val()) == true){
    		massm_function();
    	}else{
    		$("#converted_massm").val("");
    	}
    });
    $("#mtom").on('change', function(){
    	if(isNumber($("#massm").val()) == true){
    		massm_function();
    	}else{
    		$("#converted_massm").val("");
    	}
    });
    function massm_function(){
        var mfromm = $("#mfromm").val(),
	        mtom = $("#mtom").val(),
	        massm = parseFloat($("#massm").val()),
        	converted_massm = [];
    	if(mfromm == "0"){
            converted_massm[0] = 1;
            converted_massm[1] = 0.001;
            converted_massm[2] = 0.000001;
            converted_massm[3] = 0.000000001;
            converted_massm[4] = 0.015432358;
            converted_massm[5] = 0.000035273966;
            converted_massm[6] = 0.000002204623;
        }else if(mfromm == "1"){
            converted_massm[0] = 1000;
            converted_massm[1] = 1;
            converted_massm[2] = 0.001;
            converted_massm[3] = 0.000001;
            converted_massm[4] = 15.432358;
            converted_massm[5] = 0.035273966;
            converted_massm[6] = 0.002204623;
        }else if(mfromm == "2"){
            converted_massm[0] = 1000000;
            converted_massm[1] = 1000;
            converted_massm[2] = 1;
            converted_massm[3] = 0.001;
            converted_massm[4] = 15432.358;
            converted_massm[5] = 35.273966;
            converted_massm[6] = 2.204623;
        }else if(mfromm == "3"){
            converted_massm[0] = 1000000000;
            converted_massm[1] = 1000000;
            converted_massm[2] = 1000;
            converted_massm[3] = 1;
            converted_massm[4] = 15.432358;
            converted_massm[5] = 0.035273966;
            converted_massm[6] = 0.002204623;
        }else if(mfromm == "4"){
            converted_massm[0] = 64.891;
            converted_massm[1] = 0.064891;
            converted_massm[2] = 0.000064891;
            converted_massm[3] = 0.000000064891;
            converted_massm[4] = 1;
            converted_massm[5] = 0.002285714;
            converted_massm[6] = 0.000142857;
        }else if(mfromm == "5"){
            converted_massm[0] = 28349.52;
            converted_massm[1] = 28.34952;
            converted_massm[2] = 0.02834952;
            converted_massm[3] = 0.00002834952;
            converted_massm[4] = 437.5;
            converted_massm[5] = 1;
            converted_massm[6] = 0.0625;
        }else if(mfromm == "6"){
            converted_massm[0] = 453592.37;
            converted_massm[1] = 453.59237;
            converted_massm[2] = 0.45359237;
            converted_massm[3] = 0.00045359237;
            converted_massm[4] = 7000;
            converted_massm[5] = 16;
            converted_massm[6] = 1;
        }
        var mresultm = converted_massm[mtom] * massm;
        // mresultm = mresultm.toFixed(12);
        $("#converted_massm").val(mresultm);
    }    

    // Language conversion
    $("#bhasham").on('keyup', function(){
        if($("#bhasham").val() != ""){
            bhasham_function();
        }
        else{
            $("#converted_bhasham").val("");
        }
    });
    $("#bfromm").on('change', function(){
        if($("#bhasham").val() != ""){
            bhasham_function();
        }
        else{
            $("#converted_bhasham").val("");
        }
    });
    $("#btom").on('change', function(){
        if($("#bhasham").val() != ""){
            bhasham_function();
        }
        else{
            $("#converted_bhasham").val("");
        }
    });
    function bhasham_function(){
        var bfromm = $("#bfromm").val(),
            btom = $("#btom").val(),
            bhasham = $("#bhasham").val();

        $.getJSON("http://mymemory.translated.net/api/get?q="+bhasham+"&langpair="+bfromm+"|"+btom, function(response){
            var converted_bhasham = response.responseData['translatedText'];
            $("#converted_bhasham").val(converted_bhasham);
        });
    }

    // Function to check input is number or not
    function isNumber(number) {
        var pattern = new RegExp(/^[-+]?[0-9]\d*(\.\d+)?$/);
        return pattern.test(number);
    }

});