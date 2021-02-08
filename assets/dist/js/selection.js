$(document).ready(function(){

	jQuery.expr[':'].Contains = function(a,i,m){
    	return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
    };

	$("html, body").on("click", function(event){
        var seldiv = $(".seldiv"),
            filter = $(".filter");
        filter.val("");
        $(".optlist").find("li").show();
        if (!filter.is(event.target)){
	        $(".seadiv").hide();
	        if (seldiv.is(event.target)){
                var sdid = event.target.id;
	            $("#" + sdid).next().show();
                $(".filter").focus();
	        }
	    }
    });

    $(".filter").on("change keyup", function(){
        var filter = $(this).val(),
            list = $(this).siblings("ul");

        if(filter){
            $(list).find("a:not(:Contains(" + filter + "))").parent().hide();
            $(list).find("a:Contains(" + filter + ")").parent().show();
        }else{
          $(list).find("li").show();
        }
        return false;
    });

    $(".optlist").on("mousedown", function(event) {
        event.preventDefault();
    }).on("click", "li", function() {
        $(this).parents(".seadiv").siblings("div").html(this.textContent).blur();
        $(this).parents(".seadiv").siblings("input").val($(this).attr("class")).trigger('change');
    });

});