(function () {
    var $expandable = $('.expandable');
    var $expand = $('#expandButton');

    $expand.click(function(){
        var displayState = $expandable.css('display');
        var isShown = $expand.css('display') == 'none' ? false : true;

        if(displayState == 'none') {
            $expandable.css('display', 'block');
        } else {
            $expandable.css('display', 'none');
        }
    });

    document.getElementById('expandButton').addEventListener('DOMAttrModified', function(e){
        if (e.attrName === 'style') {
            console.log('prevValue: ' + e.prevValue, 'newValue: ' + e.newValue);
        }
    }, false);

    document.documentElement.style.display = 'block';

    var $form = $('#comment-form');
    var $showForm = $('#make-comment');

    $showForm.click(function(){
        $form.css('display', 'block');
        $showForm.css('display', 'none');
    });

})();