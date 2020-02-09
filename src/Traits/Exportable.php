<?php 

namespace furkankadioglu\eFatura\Traits;

trait Exportable {

    /**
     * Export all variables
     *
     * @return array
     */
    public function export()
    {
        return get_object_vars($this);
    }
}