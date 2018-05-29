<?php

/* @var $this yii\web\View */
//use voskobovich\liqpay\widgets\PaymentWidget;
$this->title = strip_tags($title);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


use Yii;
use yii\base\InvalidParamException;
use yii\base\Widget;
use yii\base\Component;
use yii\base\Model;


/**
 * Class PaymentForm
 * @package voskobovich\liqpay\forms
 */
class PaymentForm extends Model
{
    const SUBSCRIBE_PERIODICITY_MONTH = 'month';
    const SUBSCRIBE_PERIODICITY_YEAR = 'year';

    const CURRENCY_USD = 'USD';
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_RUB = 'RUB';
    const CURRENCY_UAH = 'UAH';

    const TYPE_BUY = 'buy';
    const TYPE_DONATE = 'donate';

    const PAY_WAY_CARD = 'card';
    const PAY_WAY_LIQPAY = 'liqpay';
    const PAY_WAY_DELAYED = 'delayed';
    const PAY_WAY_INVOICE = 'invoice';
    const PAY_WAY_PRIVAT24 = 'privat24';

    const LANGUAGE_RU = 'ru';
    const LANGUAGE_EN = 'en';

    public $version;
    public $public_key;
    public $amount;
    public $currency;
    public $description;
    public $order_id;
    public $recurringbytoken;
    public $type;
    public $subscribe;
    public $subscribe_date_start;
    public $subscribe_periodicity;
    public $product_url;
    public $server_url;
    public $result_url;
    public $pay_way;
    public $language;
    public $sandbox;

    /**
     * @return string
     */
    public function formName()
    {
        return '';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['version', 'public_key', 'amount', 'currency', 'description', 'order_id'], 'required'],
            ['amount', 'number'],
            [['description', 'product_url'], 'string'],
            ['order_id', 'string', 'max' => 255],
            [['server_url', 'result_url'], 'string', 'max' => 510],
            ['currency', 'in', 'range' => array_keys(self::getCurrencyItems())],
            ['type', 'in', 'range' => array_keys(self::getTypeItems())],
            [['recurringbytoken', 'subscribe', 'sandbox'], 'boolean'],
            ['subscribe_date_start', 'date', 'format' => 'php:Y-m-d H:i:s'],
            ['subscribe_periodicity', 'in', 'range' => array_keys(self::getSubscribePeriodicityItems())],
            ['pay_way', 'in', 'range' => array_keys(self::getPayWayItems())],
            ['language', 'in', 'range' => array_keys(self::getLanguageItems())],
        ];
    }

    /**
     * @param null $key
     * @return array|null
     */
    public function getCurrencyItems($key = null)
    {
        $items = [
            self::CURRENCY_USD => 'USD',
            self::CURRENCY_EUR => 'EUR',
            self::CURRENCY_RUB => 'RUB',
            self::CURRENCY_UAH => 'UAH',
        ];

        if (!is_null($key)) {
            return isset($items[$key]) ? $items[$key] : null;
        }

        return $items;
    }

    /**
     * @param null $key
     * @return array|null
     */
    public function getTypeItems($key = null)
    {
        $items = [
            self::TYPE_BUY => 'Buy',
            self::TYPE_DONATE => 'Donate',
        ];

        if (!is_null($key)) {
            return isset($items[$key]) ? $items[$key] : null;
        }

        return $items;
    }

    /**
     * @param null $key
     * @return array|null
     */
    public function getSubscribePeriodicityItems($key = null)
    {
        $items = [
            self::SUBSCRIBE_PERIODICITY_MONTH => 'Month',
            self::SUBSCRIBE_PERIODICITY_YEAR => 'Year',
        ];

        if (!is_null($key)) {
            return isset($items[$key]) ? $items[$key] : null;
        }

        return $items;
    }

    /**
     * @param null $key
     * @return array|null
     */
    public function getPayWayItems($key = null)
    {
        $items = [
            self::PAY_WAY_CARD => 'Card',
            self::PAY_WAY_LIQPAY => 'LiqPay',
            self::PAY_WAY_DELAYED => 'Delayed',
            self::PAY_WAY_INVOICE => 'Invoice',
            self::PAY_WAY_PRIVAT24 => 'Privat24',
        ];

        if (!is_null($key)) {
            return isset($items[$key]) ? $items[$key] : null;
        }

        return $items;
    }

    /**
     * @param null $key
     * @return array|null
     */
    public function getLanguageItems($key = null)
    {
        $items = [
            self::LANGUAGE_RU => 'RU',
            self::LANGUAGE_EN => 'EN',
        ];

        if (!is_null($key)) {
            return isset($items[$key]) ? $items[$key] : null;
        }

        return $items;
    }

    /**
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public function getData()
    {
        $liqPay = $_SESSION['liqpay'];
        return $liqPay->getData($this->getAttributes());
    }

    /**
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public function getSignature()
    {
        $liqPay = $_SESSION['liqpay'];
        return $liqPay->getSignature($this->getAttributes());
    }
}

/**
 * Class LiqPay
 * @package voskobovich\liqpay
 */
class LiqPay extends Component
{
    public $public_key;
    public $private_key;
    public $version = 3;
    public $debug = false;
    public $sandbox = false;
    public $language = 'ru';
    public $server_url;
    public $result_url;
    public $paymentName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->public_key)) {
            throw new InvalidParamException('Param "public_key" can not be empty.');
        }

        if (empty($this->private_key)) {
            throw new InvalidParamException('Param "private_key" can not be empty.');
        }
    }

    /**
     * @param $params
     * @return PaymentForm
     */
    public function buildForm($params)
    {
        $model = new PaymentForm();
        $model->load($params, '');
        $model->public_key = $this->public_key;
        $model->version = $this->version;
        $model->sandbox = $this->sandbox;
        $model->language = $this->language;
        $model->server_url = $this->server_url;
        $model->result_url = $this->result_url;

        return $model;
    }

    /**
     * @param $params
     * @return string
     */
    public function getData($params)
    {
        return base64_encode(json_encode($params));
    }

    /**
     * @param $params
     * @return string
     */
    public function getSignature($params)
    {
        $data = $this->getData($params);
        return base64_encode(sha1($this->private_key . $data . $this->private_key, 1));
    }
}

/**
 * Class PaymentWidget
 * @package voskobovich\liqpay\widgets
 */
class PaymentWidget extends Widget
{
    /**
     * LiqPay payment params
     * See doc: https://www.liqpay.com/ru/doc/liq_buy
     * @var array
     */
    public $data;

    /**
     * Enable auto submit form
     * @var bool
     */
    public $autoSubmit = true;

    /**
     * Amount milliseconds sleep before submit form.
     * Of course, if auto submit enable.
     * @var int
     */
    public $autoSubmitTimeout = 0;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->data)) {
            throw new InvalidParamException('Param "data" can not be empty.');
        } elseif (!is_array($this->data)) {
            throw new InvalidParamException('Param "data" must be an array.');
        }
    }

    /**
     * @return string|void
     */
    public function run()
    {
        /** @var \voskobovich\liqpay\LiqPay $liqPay */
        $liqPay = Yii::CreateObject(['class' => 'LiqPay',
                              'public_key' => 'i65178062569',
                              'private_key' => 'dVLfgSSyOYH8naKRYiunnHhgzbbao1jYz7RqzET3',
                              'server_url' => 'https://englishstudent.net/liqpay/response',
                              'result_url' => 'https://englishstudent.net/liqpay/result']);
$_SESSION['liqpay'] = $liqPay;
        $model = $liqPay->buildForm($this->data);
        $model->validate();

        return $this->render('paymentForm', [
            'model' => $model,
            'autoSubmit' => $this->autoSubmit,
            'autoSubmitTimeout' => $this->autoSubmitTimeout
        ]);
    }
}

?>
<div class="site-wrapper">
    <div class="screen screen-1 success">
        <div class="mom-bg" style="background-image: url(../../img/bg-1-min.jpg)"></div>
        <div class="info-mom title-main">
            <div class="header">
                <?= Yii::t('yii', 'liqpay_title') ?>
            </div>
            <div class="description">
                <?= Yii::t('yii', 'liqpay_description') ?>
            </div>
        </div>
    </div>
    
    
    <?php
if (isset($_SESSION['price']) && isset($_SESSION['name0']) && isset($_SESSION['guid'])) {
    $myData = array();
    $myData['amount'] = $_SESSION['price'];
    $myData['currency'] = 'UAH';
    $myData['order_id'] = $_SESSION['guid'];
    $myData['description'] = 'Оплата English Student';
    $myData['sender_first_name'] = $_SESSION['name0'];
?>
<?=PaymentWidget::widget([
    'data' => $myData,
]);
}
?>