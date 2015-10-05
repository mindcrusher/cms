$(function(){
    var showOptionsButton = $('#show-options');
    var showOptionsText = showOptionsButton.text();
    var hideOptionsText = showOptionsButton.attr('data-toggle-text');
    var opts = $('.modifications');
    var calcButton = $('#calc');
    var preloader = $("#preloader");
    var ajaxResult = $('#ajaxResult');
    var modeSelect = $('input[name=mode]');
    
    modeSelect.change(function(){
        calcButton.removeAttr('disabled');
    });
    
    showOptionsButton.click(function(){
        if(calcButton.attr('disabled')) {
            alert("Пожалуйста, вначале выберите базовый тариф!");
            return false;
        }
        opts.toggle(100);
        $(this).text(function(i, text){
            if(text === showOptionsText) {
                text = hideOptionsText;
                location.hash = 'options';
            } else {
                text = showOptionsText;
                location.hash = '';
            }
            return text;
        });
    });
    
    calcButton.click(function(){
        preloader.removeClass('hide');
        ajaxResult.addClass('hide');
        
        data = $('#calcForm').serialize();
        $.ajax({
            type: "POST",
            url: '/calc/',
            data: data,
            success: function(response){
                console.log(response.message);
                ajaxResult.html(response.message);
                $('#success').removeClass('hide');
                ajaxResult.removeClass('hide');
                preloader.addClass('hide');
                
                location.hash = 'ajaxResult';
            },
            dataType: 'json'
        });
        return false;
    });
});