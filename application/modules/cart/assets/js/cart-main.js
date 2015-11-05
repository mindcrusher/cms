
var MainCartStateView = Backbone.View.extend({
    el: $('.cart__main-state'),
    template: $('#cart__main-template-state').html(),

    initialize: function(){
        this.render();
    },
    render: function() {
        var templ = _.template(this.template);
        render = templ(cartStateModel.toJSON());
        this.$el.html(render);
    }
});

var MainItemView = Backbone.View.extend({
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
        this.model.save(this.model.toJSON(), {success: function(ui,xhr){
            cartStateModel.set(xhr);
        }});
    },

    decrease : function() {
        this.model.decrease();
        this.model.save(this.model.toJSON(), {success: function(ui,xhr){
            cartStateModel.set(xhr);
        }});
    }
});

var MainCartItemsView = Backbone.View.extend({
    el: $('.cart__main-items'),
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


$(function() {
    var MainCartStatus = new MainCartStateView();
    var MainCartItems = new MainCartItemsView();
    MainCartStatus.listenTo(cartStateModel, 'all', function() {
        MainCartItems.collection.set(cartStateModel.getPositions());
        MainCartItems.render();
        this.render();
    });
});