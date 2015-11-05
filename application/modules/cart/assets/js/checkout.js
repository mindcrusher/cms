/**
 * Created by Ivan on 27.06.2015.
 */
$('#checkoutform-formatted_address').focusout(function(){
    var address = $(this).val();

    $.ajax({
        dataType: "json",
        url: "https://geocode-maps.yandex.ru/1.x/",
        data: {
            geocode : address,
            format : 'json'
        },
        success: function(xhr){
            $('#checkoutform-formatted_address').val((xhr.response.GeoObjectCollection.featureMember[0].GeoObject.metaDataProperty.GeocoderMetaData.text));
        }
    });
});