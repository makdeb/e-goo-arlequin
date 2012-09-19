/*
	функция trigger()
	запускаеться после загрузки документа
*/

function trigger() {
	
	//отменяем кликабельность логотипа
	
	$('#header').find('#logo').click(function(){
		return false;
	});
		
	// реализуем слайд-шоу	
		
	$("#circles a").click(function(){
		
		$('#circles a').removeClass('active');
		
		var largePath = $(this).attr("href");
	
		$("#body #slider img").attr({ src: largePath });
		
		$(this).addClass('active');

		return false;
		});
		
	//	еффекты наведения на иконки соц. сетей
		
	$(".social").hover(function(){
		
		var $lo = $(this).attr("id");
		$img = 'url(/bonfire/themes/sports/images/'+$lo+'_29.png)';
		var back = {
			background: $img
		}
		$(this).css(back);
		if (document.attachEvent) {
			DD_belatedPNG.fix('#'+$lo); 
		};		
	  },function(){
	  	
		$(this).css({
			background: 'none'
			
	  });
	  });
	
	// ссs стилизация кнопки выбора тарифа при наведении
						   
	$('.buy').hover(function(){
		  $(this).addClass("active");
    }, function() {
         	$(this).removeClass("active");
    });

	// выпадающея детализация кнопки выбора тарифа
	
   	$(".buy").toggle(function(){
		$(this).next().stop(true,true)
			.animate({ opacity: 'show',top: "0"}, "slow")
	},function(){
		$(this).next().stop(true,true)
			.animate({ opacity: 'hide', top: "-85"}, "fast")
	}); 
		
	// ссs стилизация футера
		
	var foo_bor = {
			borderWidth: '0'
		}
	$('#one').find('span:first').css(foo_bor);
	$('#one').find('span:last').css(foo_bor);
	$('#two').find('span:first').css(foo_bor);
	$('#two').find('span:last').css(foo_bor);
		
	//реализуем слайд-шоу
	// инициализация слайд-шоу
/*	
	 var slider = $('#slider').bxSlider( {controls: false, auto: true, pause: 7000, onAfterSlide:function(currentSlide){ $('#circles a').removeClass('active');
	 	$('#circles a:eq('+currentSlide+')').addClass('active');
	 } } );
	 
	// управление стрелками
	
	 $('#go-prev').click(function(){
    	slider.goToPreviousSlide();
		slider.startShow();
		
		$('#circles a').removeClass('active');
		
		var $i = slider.getCurrentSlide();
		$("#circles a:eq("+$i+")").addClass('active');
    	
		return false;
  	});

  	 $('#go-next').click(function(){
    	slider.goToNextSlide();
		slider.startShow();
		
		$('#circles a').removeClass('active');
		
		var $i = slider.getCurrentSlide();
		$("#circles a:eq("+$i+")").addClass('active');
		
    	return false;
 	});
*/		
	// управление нижними маркерами	
	
	$("#circles a:eq(0)").click(function(){
	/*	
		slider.goToFirstSlide();
		slider.startShow();
	*/		
		$('#circles a').removeClass('active');
		
		$(this).addClass('active');

		return false;
		});
	
	$("#circles a:eq(1)").click(function(){
	/*	
		slider.goToSlide(1);
		slider.startShow();
	*/	
		$('#circles a').removeClass('active');
		
		$(this).addClass('active');

		return false;
		});
	
	$("#circles a:eq(2)").click(function(){
	/*	
		slider.goToLastSlide()
		slider.startShow();
	*/	
		$('#circles a').removeClass('active');
		
		$(this).addClass('active');

		return false;
		});	

		
}

$id = false;
$(document).ready(trigger);



// функция автоматизации слайд-шоу
function slider($id) {
	$('#circles a').removeClass('active');
	var largePath = $("#circles a:eq("+$id+")").attr("href");
	$("#body #slider img").attr({ src: largePath });
	$("#circles a:eq("+$id+")").addClass('active');
	
}

//запуск слайд-шоу с интервалом 15 секунд
$interval = setInterval(function(){ switch($id) {case 0: $id = $id+1; break; case 1: $id = $id+1; break; default: $id = 0; break; }; slider($id) },7000);
// запуск функции trigger()
$(document).ready(trigger);

