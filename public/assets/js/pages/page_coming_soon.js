var PageComingSoon = function () {
    return {
      //Coming Soon
      initPageComingSoon: function () {
			var newYear = new Date();
			newYear = new Date(newYear.getFullYear(), 5 - 1, 4);
			$('#defaultCountdown').countdown({until: newYear})
        }
    };
}();
