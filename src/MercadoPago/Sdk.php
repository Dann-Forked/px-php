<?php
namespace MercadoPago;

/**
 * MercadoPagoSdk Class Doc Comment
 *
 * @package MercadoPago
 */
class SDK
{

    /**
     * @var Config
     */
    protected static $_config;
    /**
     * @var Manager
     */
    protected static $_manager;

    /**
     * @var
     */
    protected static $_restClient;

    /**
     * MercadoPagoSdk constructor.
     */
    public static function initialize()
    {
        self::$_restClient = new RestClient();
        self::$_config = new Config(null, self::$_restClient);
        self::$_restClient->setHttpParam('address', self::$_config->get('base_url'));
        self::$_manager = new Manager(self::$_restClient, self::$_config);
        Entity::setManager(self::$_manager);
    }
    
    public static function configure($data=[])
    {
      self::initialize();
      self::$_config->configure($data);
    }

    /**
     * @return Config
     */
    public static function config()
    {
      return self::$_config;
    }
    
    public static function addCustomTrackingParam($key, $value)
    {
      self::$_manager->addCustomTrackingParam($key, $value);
    }
    
    
    // Publishing generic functions 
    
    public static function get($uri, $options=[])
    {
      if ($token = self::$_config->get('ACCESS_TOKEN')) {
        $uri = $uri . "?access_token=" . $token;
      } 
      return self::$_restClient->get($uri, $options);
    }
    
    public static function post($uri, $options=[])
    {
      if ($token = self::$_config->get('ACCESS_TOKEN')) {
        $uri = $uri . "?access_token=" . $token;
      }
      return self::$_restClient->post($uri, $options);
    }
    
    public static function put($uri, $options=[])
    {
      if ($token = self::$_config->get('ACCESS_TOKEN')) {
        $uri = $uri . "?access_token=" . $token;
      }
      return self::$_restClient->put($uri, $options);
    }
    
    public static function delete($uri, $options=[])
    {
      if ($token = self::$_config->get('ACCESS_TOKEN')) {
        $uri = $uri . "?access_token=" . $token;
      }
      return self::$_restClient->deleted($uri, $options);
    }

}

