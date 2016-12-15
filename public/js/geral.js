var Geral = {
	init: function() {
		Geral.activeMaskDate();
		Geral.activeMaskDateTime();
		Geral.activeMaskTime();
		Geral.activeMaskPhone();

		if ($('.confirm-delete').length) {
			$('.confirm-delete').click(Geral.confirmDelete);
		}
	},
	activeMaskDate: function() {
		var $input = $('.mask-date');
		
		if ($input.length > 0) {
			$input.each(function(){
				$input.mask('00/00/0000 00:00');
			});
		}
	},
	activeMaskDateTime: function() {
		var $input = $('.mask-date-time');
		
		if ($input.length > 0) {
			$input.each(function(){
				$input.mask('00/00/0000 00:00');
			});
		}
	},
	activeMaskTime: function() {
		var $input = $('.mask-time');
		
		if ($input.length > 0) {
			$input.each(function(){
				$input.mask('00:00');
			});
		}
	},
	activeMaskPhone: function() {
		var $input = $('.mask-phone-number');
		
		/*if ($input.length > 0) {
			$input.each(function(){
				$input.mask('(00) 0000-0000');
			});
		} else if ($input.length > 8) {
			$input.each(function(){
				$input.mask('(00) 0 0000-0000');
			});
		}*/
		
		$input.mask("(99) 9999-9999?9")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
            if(phone.length > 10) {  
                element.mask("(99) 99999-999?9");  
            } else {  
                element.mask("(99) 9999-9999?9");  
            }  
        });
	},
	confirmDelete: function() {
		var $url = $(this).attr('data-ref');

		alertify.confirm(
			'Confirmação de Exclusão',
			'Você tem certeza de que quer excluir o registro?',
			function(){
				window.location.href = $url;				
			}, 
			function(){ 
				alertify.error('Cancelado')
			}
		);
	}
};
$(Geral.init);