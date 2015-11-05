var Item = Backbone.Model.extend({

    idAttribute: "id",
    url : function() {
        id = typeof(this.id) != 'undefined' ? this.id + '/' : '';
        return cartUrl + id;
    },

    increase : function() {
        var qty = parseInt(this.get('quantity'));
        this.set('quantity', qty + 1);
    },

    decrease : function() {
        var qty = parseInt(this.get('quantity'));
        this.set('quantity', qty > 1 ? qty - 1 : 1 );
    },

    parse: function(data){
        return data;
    },

    defaults: {
        cid : 1,
        title: 'Товар',
        price: 0,
        quantity: 1,
        photo: "/img/noimage.jpg"
    }
});

var Product = Backbone.Model.extend({
    idAttribute: "id",
    url : function() {
        return '/catalog/api/product/' + this.id;
    },

    defaults: {
        id : '0',
        title : '',
        offers : []
    }
});

var CartState = Backbone.Model.extend({
    default: {
        cost : 0,
        count : 0,
        positions: ''
    },

    getPositions: function() {
        return this.get('positions');
    }
});

var cartStateModel = new CartState(cartState);

var CartStateView = Backbone.View.extend({
    el: $('.cart__widget-state'),
    template: $('#cart__widget-template-state').html(),

    initialize: function(){
        this.render();
    },
    render: function() {
        var templ = _.template(this.template);
        render = templ(cartStateModel.toJSON());
        this.$el.html(render);
    }
});

var cartItemsCollection = Backbone.Collection.extend({
    model : Item
});

var cartCollection = new cartItemsCollection( cartStateModel.getPositions() );

var ItemView = Backbone.View.extend({
    tagName: "div",
    className: "item-wrap",
    template: $("#cart__widget-template-item").html(),

    events: {
        'click .cart__control-increase': 'increase',
        'click .cart__control-decrease': 'decrease',
        'click .cart__control-delete': 'delete',
        'change .cart__control-qty': 'change'
    },

    render: function() {
        var templ = _.template(this.template);
        this.$el.html(templ(this.model.toJSON()));
        return this;
    },

    delete : function () {
        this.model.destroy({success: function(ui,xhr){
            cartStateModel.set(xhr);
        }});
        this.el.remove();
    },

    increase : function() {
        this.model.increase();
        this.model.save(this.model.toJSON(), {patch: true, success: function(ui,xhr){
            cartStateModel.set(xhr);
        }});
    },

    decrease : function() {
        this.model.decrease();
        this.model.save(this.model.toJSON(), {patch: true, success: function(ui,xhr){
            cartStateModel.set(xhr);
        }});
    }
});

var cartItemsView = Backbone.View.extend({
    el: $('.cart__widget-items'),
    initialize: function() {
        this.collection = cartCollection;
        this.render();
    },
    render: function() {
        this.$el.html('');
        this.collection.each(function(item) {
            this.renderItem(item);
        }, this);
    },
    renderItem: function(item) {
        var itemView = new ItemView({ model: item });
        this.$el.append(itemView.render().el);
    }
});

var dialogOffer = Backbone.View.extend({
    model: Product,
    el: $("#modalAlert .modal-body"),
    template: $('#dialog-offers').html(),
    events: {
        'click .cart__widget-select': 'select'
    },

    select: function(model) {
        addToCart( { cid : $(model.currentTarget).attr('data-offer_id') } );
        return false;
    },

    initialize: function() {
        this.render();
    },
    render: function() {

        console.log('render bb modal');
        $('.modal-header #header').text(this.model.get('title'));
        var template = _.template( this.template );
        this.$el.html( template(this.model.toJSON()) );
    }
});


$(function() {
    var cartStatus = new CartStateView();
    var cartItems = new cartItemsView();
    cartStatus.listenTo(cartStateModel, 'all', function() {
        cartItems.collection.set(cartStateModel.getPositions());
        cartItems.render();
        this.render();
    });
	
	$('.cart__widget').mouseover(function(){
		$('.cart__widget-info').show();
	}).mouseout(function(){
		$('.cart__widget-info').hide();
	});

    $('.cart__widget-control-add').click(function(){
        addToCart({cid : $(this).attr('data-offer_id')});
        return false;
    });

    addToCart = function(params) {
        console.log(params);
        params.quantity = parseInt(params.quantity) < 1 ? 1 : params.quantity;
        var cModel = new Item(params);
        cModel.save(params, {
            success: function(model, response){
                cartStateModel.set(response);
            }
        });
        
        return false;
    };

    $('.cart__widget-control-dialog').click(function(){
        var product_id = $(this).attr('data-id');

        $('#modalAlert .modal-header h2').html("Выберите товар");
        var product = new Product({id: product_id});
        product.fetch({success: function(model, response, options){
            DialogOffer = new dialogOffer( {model : model} );
        }});


        return true;
    });
});