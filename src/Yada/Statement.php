<?php

namespace Yada;

class Statement extends \PDOStatement
{
    public function bindColumn($column, &$param, $type = null, $maxlen = null, $driverdata = null)
    {
        if (!parent::bindColumn($column, $param, $type, $maxlen, $driverdata)) {
            throw new \Exception('Cannot bind column');
        };

        return $this;
    }

    public function bindParam($paramno, &$param, $type = null, $maxlen = null, $driverdata = null)
    {
        if (!parent::bindParam($paramno, $param, $type, $maxlen, $driverdata)) {
            throw new \Exception('Cannot bind param');
        };

        return $this;
    }

    public function bindValue($paramno, $param, $type = null)
    {
        if (!parent::bindValue($paramno, $param, $type)) {
            throw new \Exception('Cannot bin value');
        };

        return $this;
    }

    public function closeCursor()
    {
        if (!parent::closeCursor()) {
            throw new \Exception('Cannot close cursor');
        };

        return $this;
    }

    public function execute($params = null)
    {
        if (!parent::execute($params)) {
            throw new \Exception('Cannot execute statement');
        };

        return $this;
    }

    public function setFetchMode($mode, $params = null)
    {
        if (!parent::setFetchMode($mode, $params)) {
            throw new \Exception('Cannot set fetch mode');
        };

        return $this;
    }
}