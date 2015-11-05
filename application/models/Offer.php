<?php

namespace app\models;

use yz\shoppingcart;

class Offer extends ProductOffer implements shoppingcart\CartPositionInterface
{
    use shoppingcart\CartPositionTrait;
    
    public $cid;
    public $quantity;
    
    public function rules()
    {
        return [
            [['cid','quantity'], 'safe'],
        ];
    }
    
    public function save($runValidation = true, $attributeNames = NULL)
    {
        return false;
    }
    
    public function fields()
    {
        return [
            'id' => function( $model ){
                return $model->getId();
            },
            'price' => function( $model ){
                return $model->getPrice();
            },
            'cost' => function( $model ){
                return $model->getCost();
            },
            'title' => function( $model ){
                return $model->getName();
            },
            'quantity' => function( $model ){
                return $model->getQuantity();
            },
        ];
    }
    
    public function getName()
    {
        return $this->product->title . ' "' . $this->title . '"';
    }
    
    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }
}