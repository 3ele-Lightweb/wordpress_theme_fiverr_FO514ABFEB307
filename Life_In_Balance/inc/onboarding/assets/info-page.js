
;(function($) {

	$('.life_in_balance-tab-nav a').on('click',function (e) {
		e.preventDefault();
		$(this).addClass('active').siblings().removeClass('active');
	});

	$('.life_in_balance-tab-nav .begin').on('click',function (e) {		
		$('.life_in_balance-tab-wrapper .begin').addClass('show').siblings().removeClass('show');
	});	
	$('.life_in_balance-tab-nav .actions, .life_in_balance-tab .actions').on('click',function (e) {		
		e.preventDefault();
		$('.life_in_balance-tab-wrapper .actions').addClass('show').siblings().removeClass('show');

		$('.life_in_balance-tab-nav a.actions').addClass('active').siblings().removeClass('active');

	});	
	$('.life_in_balance-tab-nav .support').on('click',function (e) {		
		$('.life_in_balance-tab-wrapper .support').addClass('show').siblings().removeClass('show');
	});	
	$('.life_in_balance-tab-nav .table').on('click',function (e) {		
		$('.life_in_balance-tab-wrapper .table').addClass('show').siblings().removeClass('show');
	});	

})(jQuery);
