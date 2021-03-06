(function($) {
    $(document).ready(function () {

        var currentMessageIndex = 0;
        function animateMessages(messages, currentMessageIndex) {

            $('#entry-text').animate({
                left: '-1250px'
            }, {
                duration: 500,
                queue: true,
                specialEasing: {
                    left: "easeInOutQuart"
                },
                complete: function() {
                    $('#entry-text').css({'left':'1600px'});
                    $('#entry-text').html('<h1>' + messages[currentMessageIndex] + '</h1>');
                    $('#entry-text').animate({
                        left: '15px'
                    }, {
                        duration: 500,
                        queue: true,
                        specialEasing: {
                            left: "easeInOutQuart"
                        },
                        complete: function() {
                            currentMessageIndex = (currentMessageIndex + 1) % messages.length
                            setTimeout(function() {animateMessages(messages, currentMessageIndex)},2500);
                        }
                    });
                }
            });

        }
        if ($('#entry-text').length){
            animateMessages(messages, currentMessageIndex);
        }
    });
}(jQuery));
