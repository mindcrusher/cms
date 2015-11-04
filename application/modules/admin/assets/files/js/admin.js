/**
 * Created by Ivan on 04.11.2015.
 */

$('.remove-product-link').click(function(){
    if(!confirm('Действительно хотите удалить товар из категории?')) {
        return false;
    }
});
