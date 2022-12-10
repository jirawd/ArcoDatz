<?php
 namespace App;
 use Session;
class Cart {
    public $groomings = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    //public $pet_id = 0;

    //App/Cart.php
    public function __construct($oldCart) {
        if($oldCart) {
            $this->groomings = $oldCart->groomings;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            //$this->pet_id = $oldCart->pet_id;
        }
    }
    public function add($grooming, $id){
        //dd($this->items);
        $storedItem = ['qty'=>0, 'price'=>$grooming->price, 'grooming'=> $grooming];
        if ($this->groomings){
            if (array_key_exists($id, $this->groomings)){
                $storedItem = $this->groomings[$id];
            }
        }
        $storedItem['qty'] += $grooming->qty;
        $storedItem['qty']++;
        $storedItem['price'] = $grooming->price;
        //$storedItem['pet_id'] = $request->input('pet_id');
        $this->groomings[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $grooming->price;
    }

    public function removeItem($id){
        $this->totalPrice -= $this->groomings[$id]['price'];
        unset($this->groomings[$id]);
    }
}