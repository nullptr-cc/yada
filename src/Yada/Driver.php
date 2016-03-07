<?php

namespace Yada;

use PDO;

class Driver
{
    protected $pdo_args;
    protected $driver;
    protected $deferred_attrs = [];

    public function __construct($dsn, $username = '', $password = '', array $options = [])
    {
        $this->pdo_args = [$dsn, $username, $password, $options];
    }

    public function __call($method, $args)
    {
        return $this->driver()->{$method}(...$args);
    }

    public function beginTransaction()
    {
        $this->driver()->beginTransaction();
        return $this;
    }

    public function commit()
    {
        $this->driver()->commit();
        return $this;
    }

    public function rollBack()
    {
        $this->driver()->rollBack();
        return $this;
    }

    public function setAttribute($attr, $value)
    {
        if ($this->driver) {
            $this->driver->setAttribute($attr, $value);
        } else {
            $this->deferred_attrs[$attr] = $value;
        };

        return $this;
    }

    protected function driver()
    {
        if (!$this->driver) {
            $this->driver = $this->createPDO();
        };

        return $this->driver;
    }

    protected function createPDO()
    {
        $pdo = new PDO(...$this->pdo_args);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_STATEMENT_CLASS, [Statement::class]);

        foreach ($this->deferred_attrs as $attr => $value) {
            $pdo->setAttribute($attr, $value);
        };

        return $pdo;
    }
}
