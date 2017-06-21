$(document).ready(function() {
	jQuery(document).on("submit", '#ajaxform', function () {
        var form = $(this);
		var error = false;
        
		form.find('input[type="text"]').each( function(){
			if ($(this).val() == '') {
				alert('Заполните поле "'+$(this).attr('data-notice')+'"!');
				error = true;
			}
		});
        
		if (!error) {
			var data = form.serialize();
			$.ajax({
			   type: 'POST',
			   url: '/ajax/sendform.php',
			   dataType: 'json',
			   data: data,
		       beforeSend: function(data) {
		            form.find('input[type="submit"]').attr('disabled', 'disabled');
		          },
		       success: function(data){
		       		if (data['error']) {
		       			alert(data['error']);
		       		} else {
		       			$('.vspl').show(500);
						$('#vspl').show(500);
		       		}
		         },
		       error:  function(xhr, str){
	                alert('Возникла ошибка: ' + xhr.responseCode);
	            }
			});
		}
		return false;
	});
});
$(document).ready(function() {
	$("#callback-form").submit(function(){

		var name = $(this).find('input[name="name"]');
		var phone = $(this).find('input[name="phone"]');
        var country = $(this).find('input[name="country"]');
		var m_error = $('div#mf_error');
		var j = 0;

		m_error.empty();
		m_error.prepend('<div class="message message_error"><span>Не заполненны обязательные поля</span></div>');

		if(!name.val()){
			name.addClass("error_input");
			j++;
		}else{
			name.removeClass();
			name.addClass("good_input");
		}

		if(!phone.val()){
			phone.addClass("error_input");
			j++;
		}else{
			phone.removeClass();
			phone.addClass("good_input");
		}

		if (j > 0) {
			m_error.show(500);
            return false;
        } else {
            
			m_error.empty();
            $("#loading").show();
            
            $.ajax({
                type: 'POST',
                url: '/ajax/ajax.php',
                dataType: 'json',
                data: {
					name: name.val(),
					phone: phone.val(),
                    country: country.val()
                },
                beforeSend: function(data) {
                    $(this).find('input[type="submit"]').attr('disabled', 'disabled');
                },
                success: function(data){
                    $("#loading").hide();
                    if (data['error']) {
                        m_error.hide();
                        m_error.prepend('<div class="message message_error"><span>' + data.error + '</span></div>').show(500);
		       		} else {
                        $('div .fmore').empty();
                        $('div .fmore').prepend('<div class="message_success"><span>Сообщение успешно отправленно.</span><br /><p>Наш менеджер свяжется с Вами в ближайшее время.</p></div>').show(500);
				    }
                },
                error:  function(xhr, str){
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
			});
            
            /*if (data['error']) {
                alert(data['error']);
            } else {
                $('.vspl').show(500);
                $('#vspl').show(500);
            }*/
		}
		return false;
	});
});