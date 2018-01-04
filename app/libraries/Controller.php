<?php

/*
* Base Controller
* Loads the models and views
*/

class Controller {
    // Load model
    public function model($model) {
        // Require model file
        require_once '../app/models/'. $model. '.php';

        // Instantiate the model
        return new $model();

    }

    // load view
    public function view($view, $data = []) {
        // check for the view file
        if(file_exists('../app/views/'. $view. '.php')) {
            // if exists require
            require_once '../app/views/'. $view. '.php';
        } else {
            // view does not exist
            die('View does not exist');
        }
    }
}