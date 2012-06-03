$(window).load(function() {
	if (JS_CONFIG_PHP_VERSION && JS_CONFIG_PHP_PDO && JS_CONFIG_PHP_SplFileInfo && JS_CONFIG_PHP_DIRECTORY_ITERATOR && JS_CONFIG_APACHE_MULTIVIEWS) {
		JS_PATH_AJAX_CONFIGURATION_SAVE = 'js/ajax/configuration-save.php';
		JS_PATH_AJAX_SETUP_SAVE = 'js/ajax/setup-save.php';
		JS_PATH_AJAX_DATABASE_TEST = 'js/ajax/database-test.php'
		$("#configSave").show();
	}
	
	step = 0;
	
	$('#configSave').unbind('click').click(function(){
		$('#tabs ul li').eq(step).removeClass('active');
		$('#tabs ul li span.iconic').eq(step).removeClass('x').addClass('check').addClass('darkGreen');
		$('#tabs ul li').eq(step+1).addClass('active');
		
		$('#tabs div').eq(step).hide();
		$('#tabs div').eq(step+1).show();
		
		step++;
		console.log(step);
		$("#configSave").hide(); 
		if(step == 2 ) {
			$("#configSave").show(); 
		}
		else if( step == 3 ) {
			$("#configSave").show();
		}
		else if( step == 4 ) {
			$("#configSave").show();
			$("#configSave").unbind('click').live('click',function () {
				setupSave();
				step++;
				console.log(step);
			});
			$("#configSave").hide();
			
		}
	});
	
	$('#setupUserPassword').keyup(function(){
		$("#configSave").show();
	});
	
});

(function($) {

	$('#databaseTest').click(function() {
		$.ajax({
			type : "POST",
			// URL script PHP
			url : JS_PATH_AJAX_DATABASE_TEST,
			data : {
				setupRoot       : $('#setupRoot').val(),
				setupDbUser     : $('#setupDbUser').val(),
				setupDbPassword : $('#setupDbPassword').val(),
				setupDbDatabase : $('#setupDbDatabase').val(),
				setupDbServer   : $('#setupDbServer').val(),
				setupDbPrefix   : $('#setupDbPrefix').val(),
			},
			dataType : "text",
			beforeSend : function() {
			},
			success : function(data) {
				//data = responseText
				if (data == 'TRUE') {
					$("#configSave").show();
				} else {
					//addMssg('error','Connexion error');
				}
			},
			error : function() {
				//addMssg('error', 'Error 404<br>Please chek path input.');
			}
		});

	});
/*
	$('#continue').css('display', 'none');

	$('#continue').click(function() {
		$(location).attr('href', $('#setupRoot').val());
	});
*/
	setupSave = function() {
		console.log($('#setupRoot').val());
		if ($('#setupRoot').val() == '') {
			console.log('test');
		} else {
			$.ajax({
				type : "POST",
				// URL script PHP
				url : JS_PATH_AJAX_SETUP_SAVE,
				data : {
					setupRoot         : $('#setupRoot').val(),
					setupUserName     : $('#setupUserName').val(),
					setupUserPassword : $('#setupUserPassword').val(),
					setupDbUser       : $('#setupDbUser').val(),
					setupDbPassword   : $('#setupDbPassword').val(),
					setupDbDatabase   : $('#setupDbDatabase').val(),
					setupDbServer     : $('#setupDbServer').val(),
					setupDbPrefix     : $('#setupDbPrefix').val(),
					setupFavicon      : $('#setupFavicon option:selected').val(),
					setupPublic       : $('#setupPublic option:selected').val(),
					setupDebug        : $('#setupDebug option:selected').val(),
					setupTotalUrls    : $('#setupTotalUrls option:selected').val(),
					setupGa           : $('#setupGa').val(),
				},
				dataType : "text",
				beforeSend : function() {
					// Image loading
				},
				success : function(data) {
					//data = responseText
					console.log(data);
					if (data == 'TRUE') {
						//addMssg('okay','Bravo, l\'application s\'est instalée correctement.');
						//window.location.reload();
						//step++;

					} else {
						//addMssg('error','Database connection failed');
					}
				},
				error : function(data) {
					//console.log(data);
					//addMssg('error', 'Error 404<br>Please chek path input.');
				}
			});
		}
	}

	$('#configSave').click(function() {

		$.ajax({
			type : "POST",
			// URL script PHP
			url : JS_PATH_AJAX_CONFIGURATION_SAVE,
			data : {
				setupSiteName : $('#setupSiteName').val(),
				setupUserName : $('#setupUserName').val(),
				setupUserPassword : $('#setupUserPassword').val(),
				setupDbUser : $('#setupDbUser').val(),
				setupDbPassword : $('#setupDbPassword').val(),
				setupDbDatabase : $('#setupDbDatabase').val(),
				setupDbServer : $('#setupDbServer').val(),
				setupDbPrefix : $('#setupDbPrefix').val(),
				setupFavicon : $('#setupFavicon option:selected').val(),
				setupPublic : $('#setupPublic option:selected').val(),
				setupDebug : $('#setupDebug option:selected').val(),
				setupTotalUrls : $('#setupTotalUrls option:selected').val(),
				setupGa : $('#setupGa').val(),
			},
			dataType : "text",
			beforeSend : function() {
				// Image loading
			},
			success : function(data) {
				//data = responseText
				console.log(data);
				if (data == 'TRUE') {
					//addMssg('okay','Updated.');
					//window.location.reload();
				} else {
					//addMssg('error','Database connection failed');
				}
			},
			error : function(data) {
				//console.log(data);
				//addMssg('error', 'Error 404<br>Please chek path input.');
			}
		});
	});
})(jQuery); 