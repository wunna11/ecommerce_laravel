<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $product_id)
    {
        $storedItem = [
            'quantity' => 0,
            'product_id' => 0,
            'name' => $item->name,
            'price' => $item->price,
            'image' => $item->image,
            'item' => $item,
        ];

        if ($this->items) {
            if (array_key_exists($product_id, $this->items)) {
                $storedItem = $this->items[$product_id];
            }
        }

        $storedItem['quantity']++;
        $storedItem['product_id'] = $product_id;
        $storedItem['name'] = $item->name;
        $storedItem['price'] = $item->price;
        $storedItem['image'] = $item->image;
        $this->totalQty++;
        $this->totalPrice += $item->price;
        $this->items[$product_id] = $storedItem;
    }

    public function updateQty($id, $quantity)
    {
        $this->totalQty -= $this->items[$id]['quantity'];
        $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['quantity'];
        $this->items[$id]['quantity'] = $quantity;
        $this->totalQty += $quantity;
        $this->totalPrice += $this->items[$id]['price'] * $quantity;
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['quantity'];
        $this->totalPrice = $this->items[$id]['price'] * $this->items[$id]['quantity'];
        unset($this->items[$id]);
    }
}
