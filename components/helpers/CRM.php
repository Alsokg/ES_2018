<?php

namespace app\components\helpers;

class CRM {
    private static $requstObject;
    private static $isInit = false;
    
    private static function init() {
        if (self::$isInit == true) {
            unset(self::$requstObject);
        }
        self::$requstObject = new \stdClass();
        self::$isInit = true;
    }
    
    public static function setOrderData($data) {
        self::init();
        self::$requstObject->title = $data["guid"];
        self::$requstObject->total = $data["total"];
        
        self::$requstObject->client_attributes = new \stdClass();
        self::$requstObject->client_attributes->person = $data["name"];
        self::$requstObject->client_attributes->email = $data["email"];
        self::$requstObject->client_attributes->phones = array($data["phone"]);
        
        self::$requstObject->jobs_attributes = array();
        //loop over products
        foreach ($data['products'] as $product)
        self::$requstObject->jobs_attributes[0] = new \stdClass();
        self::$requstObject->jobs_attributes[0]->amount = $product["qty1"];
        self::$requstObject->jobs_attributes[0]->product_attributes = new \stdClass();
        self::$requstObject->jobs_attributes[0]->product_attributes->sku = $product["name"];
        self::$requstObject->jobs_attributes[0]->product_attributes->title = $product["name_txt"];
        self::$requstObject->jobs_attributes[0]->product_attributes->price = $product["price"];
        
        self::$requstObject->custom_fields = array();
        self::$requstObject->custom_fields[0] = new \stdClass();
        self::$requstObject->custom_fields[0]->name = "Сумма зі знижкою";
        self::$requstObject->custom_fields[0]->value = $data["total"];
        
        self::$requstObject->custom_fields[1] = new \stdClass();
        self::$requstObject->custom_fields[1]->name = "Тип оплати";
        self::$requstObject->custom_fields[1]->value = $data["paid"];
        
        $i= 2;
        //use iffset for unneccacary fields
        if (array_key_exists('shipping', $data)) {
            self::$requstObject->custom_fields[$i] = new \stdClass();
            self::$requstObject->custom_fields[$i]->name = "Доставка";
            self::$requstObject->custom_fields[$i]->value = $data["shipping"];
            $i++;
        }
        
        if (array_key_exists('promo-code', $data)) {
            self::$requstObject->custom_fields[$i] = new \stdClass();
            self::$requstObject->custom_fields[$i]->name = "Promo";
            self::$requstObject->custom_fields[$i]->value = $data["promo-code"];
        }
        
        $data_string = json_encode(self::$requstObject);                                                                                   
                                                                                                                     
$ch = curl_init('https://api.keepincrm.com/v1/agreements');

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-Auth-Token: ujHDmbVg8XU73PWA7UB7cdD2',
    'Content-Type: application/json')                                                                       
);                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);
        
    }
    
    public static function printObject() {
        print_r(self::$requstObject);
    }
    
}
?>