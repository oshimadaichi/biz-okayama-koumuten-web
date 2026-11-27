jQuery(document).ready(function($){

	/*
	 * カテゴリ ラジオボタン化
	 */
	(function(){
		var str = "#race_typechecklist,#activity_typechecklist,#media_typechecklist";
		var $target = $(str).find("li input[type=checkbox]");
		$target.each(function(){
			$(this).replaceWith($(this).clone().attr("type","radio"));

        });
        if(typeof $('#media_typechecklist li input:checked').val() === "undefined"){
            $('#media_typechecklist li:first-child input').prop('checked', true);
        }

        //言語切り替え acf:tablesの表示切り替え
        var competitionResultsEn = $('#competitionResultsEn').closest('.postbox');
        var competitionResultsJa = $('#competitionResultsJa').closest('.postbox');

        competitionResultsEn.hide(); //en
        competitionResultsJa.hide(); //ja

        //$('#acf-group_5d551a32a2d0b').hide();
        //$('#acf-group_58cbb7240abc2').hide(); //ja

        $(window).on('load', function(){
            if($('.qtranxs-lang-switch-en').hasClass('active')){
                competitionResultsEn.show(); //en
            }else if($('.qtranxs-lang-switch-ja').hasClass('active')){
                competitionResultsJa.show(); //ja
            }
        });
        $(document).on('click', '.qtranxs-lang-switch-en', function(){
            competitionResultsEn.show(); //en
            competitionResultsJa.hide(); //ja
        });
        $(document).on('click', '.qtranxs-lang-switch-ja', function(){
            competitionResultsEn.hide(); //en
            competitionResultsJa.show(); //ja
        });
    })();




});