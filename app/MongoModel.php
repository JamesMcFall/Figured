<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/**
 * Base Model
 * This class extends the MongoDB Eloquent model functionality to automate
 * adding and updating of the created/lastUpdated dates.
 */
class MongoModel extends Eloquent
{

    /**
     * Save
     * Override the default save behaviour to add created and lastUpdated fields
     * that are automatically set.
     *
     * @param  <array> $options
     * @return <boolean>
     */
    public function save(array $options = []) {

        $now = new \DateTime("now");

        # Creating a record for the first time
        if (is_null($this->id)) {
            $this->created = $now->format("Y-m-d H:i:s");
        }

        $this->lastUpdated = $now->format("Y-m-d H:i:s");

        return parent::save($options);
    }

}
