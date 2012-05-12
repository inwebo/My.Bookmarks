( function($){

        $('#databaseTest').click(function(){
                        $.ajax({
				type: "POST",
				// URL script PHP
				url: JS_PATH_AJAX_DATABASE_TEST,
				data: {
                                        setupRoot: $('#setupRoot').val(),
                                        setupDbUser: $('#setupDbUser').val(),
                                        setupDbPassword: $('#setupDbPassword').val(),
                                        setupDbDatabase: $('#setupDbDatabase').val(),
                                        setupDbServer: $('#setupDbServer').val(),
                                        setupDbPrefix: $('#setupDbPrefix').val(),
                                        },
				dataType: "text",
				beforeSend:function() {
				},
				success:function(data) {
					//data = responseText
					if( data == 'TRUE' ) {
						addMssg('okay','Connexion ok.');
					}
					else {
						addMssg('error','Connexion error');
					}
				},
				error:function() {
                                        addMssg('error','Error 404<br>Please chek path input.');
				}
			});

        });

	$( '#getIt' ).css( 'display', 'none' );
	$( '#continue' ).css( 'display', 'none' );

	$( '#continue' ).click(function() {
		$( location).attr( 'href', $( '#setupRoot' ).val() );
	});

	$( '#setupSave' ).click(function() {
                console.log( $( '#setupRoot' ).val() );
		if( $( '#setupRoot' ).val() == '' ) {
			console.log('test');
		}
		else {
			$.ajax({
				type: "POST",
				// URL script PHP
				url: JS_PATH_AJAX_SETUP_SAVE,
				data: {
                                        setupRoot: $('#setupRoot').val(),
                                        setupUserName: $('#setupUserName').val(),
                                        setupUserPassword: $('#setupUserPassword').val(),
                                        setupDbUser: $('#setupDbUser').val(),
                                        setupDbPassword: $('#setupDbPassword').val(),
                                        setupDbDatabase: $('#setupDbDatabase').val(),
                                        setupDbServer: $('#setupDbServer').val(),
                                        setupDbPrefix: $('#setupDbPrefix').val(),
                                        setupFavicon: $('#setupFavicon option:selected').val(),
                                        setupPublic: $('#setupPublic option:selected').val(),
                                        setupDebug: $('#setupDebug option:selected').val(),
                                        setupTotalUrls: $('#setupTotalUrls option:selected').val(),
                                        setupGa: $('#setupGa').val(),
                                        },
				dataType: "text",
				beforeSend:function() {
					// Image loading
				},
				success:function(data) {
					//data = responseText
                                        //console.log(data);
					if( data == 'TRUE' ) {
						addMssg('okay','Bravo, l\'application s\'est instalée correctement.');
                                                window.location.reload();
                                                
					}
					else {
						addMssg('error','Database connection failed');
					}
				},
				error:function(data) {
                                        //console.log(data);
                                        addMssg('error','Error 404<br>Please chek path input.');
				}
			});
		}
	});

	$( '#configSave' ).click(function() {

			$.ajax({
				type: "POST",
				// URL script PHP
				url: JS_PATH_AJAX_CONFIGURATION_SAVE,
				data: {
                                        setupSiteName: $('#setupSiteName').val(),
                                        setupUserName: $('#setupUserName').val(),
                                        setupUserPassword: $('#setupUserPassword').val(),
                                        setupDbUser: $('#setupDbUser').val(),
                                        setupDbPassword: $('#setupDbPassword').val(),
                                        setupDbDatabase: $('#setupDbDatabase').val(),
                                        setupDbServer: $('#setupDbServer').val(),
                                        setupDbPrefix: $('#setupDbPrefix').val(),
                                        setupFavicon: $('#setupFavicon option:selected').val(),
                                        setupPublic: $('#setupPublic option:selected').val(),
                                        setupDebug: $('#setupDebug option:selected').val(),
                                        setupTotalUrls: $('#setupTotalUrls option:selected').val(),
                                        setupGa: $('#setupGa').val(),
                                        },
				dataType: "text",
				beforeSend:function() {
					// Image loading
				},
				success:function(data) {
					//data = responseText
                                        console.log(data);
					if( data == 'TRUE' ) {
						addMssg('okay','Updated.');
                                                window.location.reload();
					}
					else {
						addMssg('error','Database connection failed');
					}
				},
				error:function(data) {
                                        //console.log(data);
                                        addMssg('error','Error 404<br>Please chek path input.');
				}
			});
		
	});
})(jQuery)