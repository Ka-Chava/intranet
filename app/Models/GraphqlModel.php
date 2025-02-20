<?php

namespace App\Models;

abstract class GraphqlModel
{
    protected array $raw = [];

    public function __construct($params = []) {
        $this->raw = $params;
    }

    public function __set( $name , $value ) {

        $name = explode('_', $name);
        foreach($name as $k => $n) {
            $name[$k] = ucfirst($n);
        }
        $method = 'set' . implode('', $name);

        if( method_exists( $this , $method ) )
            return $this->$method( $value );
        else
            throw new \Exception( 'Can\'t set property ' . $name );
    }

    public function __get($name) {

        $name = explode('_', $name);
        foreach($name as $k => $n) {
            $name[$k] = ucfirst($n);
        }
        $method = 'get' . implode('', $name);

        if(method_exists( $this , $method)) {
            return $this->$method();
        }
        else {
            throw new \Exception( 'Can\'t get property ' . $name );
        }
    }
    public function __isset( $name )
    {
        return method_exists( $this , 'get' . ucfirst( $name  ) )
            || method_exists( $this , 'set' . ucfirst( $name  ) );
    }
}
