var MouseWheel = function () {

    return {

        initMouseWheel: function () {
            jQuery('.slider-snap').noUiSlider({
                start: [ 1000, 600000 ],
                snap: true,
                connect: true,
                range: {
                    'min': 1,
                    '5%':  30000,
                    '10%': 60000,
                    '15%': 90000,
                    '20%': 120000,
                    '25%': 150000,
                    '30%': 180000,
                    '35%': 210000,
                    '40%': 240000,
                    '50%': 300000,
                    '60%': 360000,
                    '70%': 420000,
                    '80%': 480000,
                    '90%': 540000,
                    'max': 600000
                }
            });
            jQuery('.slider-snap').Link('lower').to(jQuery('.slider-snap-value-lower'));
            jQuery('.slider-snap').Link('upper').to(jQuery('.slider-snap-value-upper'));
        }

    };

}();        