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

    public function bindBool($paramno, $param)
    {
        return $this->bindValue($paramno, $param, \PDO::PARAM_BOOL);
    }

    public function bindInt($paramno, $param)
    {
        return $this->bindValue($paramno, $param, \PDO::PARAM_INT);
    }

    public function bindString($paramno, $param)
    {
        return $this->bindValue($paramno, $param, \PDO::PARAM_STR);
    }

    public function bindFloat($paramno, $param)
    {
        return $this->bindValue($paramno, $param, \PDO::PARAM_STR);
    }

    public function bindDate($paramno, \DateTimeInterface $param)
    {
        $string = $param->format(SqlStandard::DATE_FORMAT);
        return $this->bindValue($paramno, $string, \PDO::PARAM_STR);
    }

    public function bindDateTime($paramno, \DateTimeInterface $param)
    {
        $string = $param->format(SqlStandard::DATE_TIME_FORMAT);
        return $this->bindValue($paramno, $string, \PDO::PARAM_STR);
    }

    public function bindAuto(array $params)
    {
        foreach ($params as $name => $value) {
            if (is_bool($value)) {
                $this->bindBool($name, $value);
                continue;
            };
            if (is_int($value)) {
                $this->bindInt($name, $value);
                continue;
            };
            if ($value instanceof \DateTimeInterface) {
                $this->bindDateTime($name, $value);
                continue;
            };
            $this->bindString($name, $value);
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
