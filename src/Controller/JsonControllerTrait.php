<?php

/**
 * JSON request/responses pretty much all need to be set up the same way.
 * This trait will automatically inject the RequestHandler component
 * and set the viewClass to 'Json' so that we can use the set(_serialize)
 * to response with a formatted JSON response (from our controller actions)
 * without having to do stupid amounts of extra work to turn variables into
 * JSON.
 *
 * @usage To JSONifiy a controllers reactions, just add this trait to it
 */

namespace JsonApi\Controller;

trait JsonControllerTrait
{

    /**
     * Initialize the settings we want for all API classes (at least ones that use this Trait)
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        # load the RequestHandler component
        $this->loadComponent('RequestHandler');

        # this class will only response to JSON
        $this->viewClass = 'Json';
    }
}
