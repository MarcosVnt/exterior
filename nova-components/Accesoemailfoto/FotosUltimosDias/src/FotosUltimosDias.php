<?php

namespace Vnt\FotosUltimosDias;

use Laravel\Nova\ResourceTool;

class FotosUltimosDias extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Fotosultimosdias';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'fotosultimosdias';
    }

    public function setTitle($title)
    {
        $this->withMeta(['title' => $title]);

        return $this;
    }

    public function usingModel(string $model)
    {
        $this->withMeta(['model' => $model]);

        return $this;
    }

    public function groupBy($columns = [])
    {
        $this->withMeta(['group_by' => $columns]);

        return $this;
    }

    public function selectColumns($columns = [])
    {
        $this->withMeta(['select_columns' => $columns]);

        return $this;
    }

    public function usingWhereCondition($data)
    {
        $this->withMeta(['using_where' => $data]);

        return $this;
    }




}
